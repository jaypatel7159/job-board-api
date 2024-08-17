<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobApplicationResource;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function apply(Request $request, Job $job)
    {
        $validatedData = $request->validate([
            'cover_letter' => 'required|string',
            // other validations like resume, etc.
        ]);

        $application = new JobApplication();
        $application->user_id = Auth::id(); // Set the user ID to the currently authenticated user
        $application->cover_letter = $validatedData['cover_letter'];
        $application->job_id = $job->id;

        // Save the application
        $application->save();

        return response()->json(['message' => 'Application submitted successfully.'], 201);
    }

    public function index(Job $job)
    {
        // Ensure that only the user who posted the job or an admin can view the applications
        if (Auth::id() !== $job->user_id && !Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized access.'], 403);
        }

        // Retrieve all applications for the specified job
        $applications = $job->applications()->with('user')->get();

        return response()->json($applications, 200);
    }
}
