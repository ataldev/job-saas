<?php

namespace App\DataTransferObjects;

use App\Http\Requests\JobRequest;

class JobDto
{
    public function __construct(
        public readonly string $title,
    ) {
    }

    public static function fromRequest(JobRequest $request)
    {
        $validated = $request->validated();
        return new self(
            title: $validated['title'],
        );
    }
}