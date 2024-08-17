<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        return JobResource::collection(Job::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric',
        ]);

        $job = Auth::user()->jobs()->create($validated);

        return new JobResource($job);
    }

    public function show(Job $job)
    {
        return new JobResource($job);
    }

    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'company' => 'string|max:255',
            'location' => 'string|max:255',
            'salary' => 'numeric',
        ]);

        $job->update($validated);

        return new JobResource($job);
    }

    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);

        $job->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $query = Job::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $jobs = $query->get();

        return JobResource::collection($jobs);
    }

}
