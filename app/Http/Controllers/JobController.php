<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\JobDto;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Services\Job\JobService;

class JobController extends Controller
{
    public function __construct(
        protected JobService $jobService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobCollection::make(Job::all());
        return inertia('Jobs/Index', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Jobs/Save');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $this->jobService->store(JobDto::fromRequest($request));
        return to_route('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $job = JobResource::make($job);
        return inertia('Jobs/Show', [
            'job' => $job,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return inertia('Jobs/Save', [
            'job' => $job,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $job)
    {
        $this->jobService->update($job, JobDto::fromRequest($request));
        return to_route('jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $this->jobService->destroy($job);
    }
}