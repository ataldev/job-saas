<?php

namespace Tests\Unit;

use App\Models\Job;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class JobTest extends TestCase
{
    /** @test */
    public function user_needs_to_be_authenticated_to_view_all_jobs(): void
    {
        $response = $this->get(route('jobs.index'));

        $response->assertStatus(302)
            ->assertRedirect(route('login'));
    }
    /** @test */
    public function user_can_view_all_jobs(): void
    {
        $this->actAsUser();

        $jobs = Job::factory()->count(3)->create();

        $response = $this->get(route('jobs.index'));

        $response->assertStatus(200)
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('Jobs/Index')
                    ->has('jobs', $jobs->count())
                    ->where('jobs', $jobs->map->only('id', 'title'))
            );
    }

    /** @test */
    public function user_can_view_job(): void
    {
        $this->actAsUser();

        $job = Job::factory()->create();

        $response = $this->get(route('jobs.show', $job));

        $response->assertStatus(200)
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('Jobs/Show')
                    ->where('job', $job->only('id', 'title'))
            );
    }

    /** @test */
    public function user_can_create_a_job(): void
    {
        $this->actAsUser();

        $response = $this->post(route('jobs.store'), [
            'title' => 'Job Title',
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('jobs.index'));

        $this->assertDatabaseHas('jobs', [
            'title' => 'Job Title',
        ]);
    }

    /** @test */
    public function user_can_update_a_job(): void
    {
        $this->actAsUser();

        $job = Job::factory()->create();

        $response = $this->patch(route('jobs.update', $job), [
            'title' => 'Job Title Updated',
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('jobs.index'));

        $this->assertDatabaseHas('jobs', [
            'title' => 'Job Title Updated',
        ]);
    }

    /** @test */
    public function user_can_delete_a_job(): void
    {
        $this->actAsUser();

        $job = Job::factory()->create();

        $this->delete(route('jobs.destroy', $job));

        $this->assertDatabaseMissing('jobs', [
            'id' => $job->id,
        ]);
    }
}