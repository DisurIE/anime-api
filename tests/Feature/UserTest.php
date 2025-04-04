<?php

declare(strict_types=1);

use App\Framework\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(Tests\TestCase::class);
uses(RefreshDatabase::class);

it('has user page', function () {
    $user = User::factory()->create();

    $response = actingAs($user)->get('api/users');

    $response->assertStatus(200);
});
