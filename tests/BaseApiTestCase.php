<?php

namespace Tests;

use App\Models\User;

class BaseApiTestCase extends TestCase
{
    public User $authUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authUser = User::factory()->create();
        $this->actingAs($this->authUser);
    }
}
