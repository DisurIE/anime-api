<?php

declare(strict_types=1);

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\seed;

uses(Tests\TestCase::class);
uses(RefreshDatabase::class);

it('has user page', function () {

    seed(UserSeeder::class);
    $response = $this->get('api/users');

    $response->assertStatus(200);
    $this->assertCount(1, $response->json('data'));
});
