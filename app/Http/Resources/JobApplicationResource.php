<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'job' => new JobResource($this->job),
            'user' => $this->user->only('id', 'name', 'email'),
            'cover_letter' => $this->cover_letter,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
