<?php

namespace App\Services\Job;

use App\DataTransferObjects\JobDto;
use App\Models\Job;

class JobService
{
    function store(JobDto $dto): Job
    {
        return Job::create([
            'title' => $dto->title,
        ]);
    }

    function update(Job $job, JobDto $dto): Job
    {
        $job->update([
            'title' => $dto->title,
        ]);
        return $job;
    }

    function destroy(Job $job): void
    {
        $job->delete();
    }
}