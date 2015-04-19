<?php

use Laracasts\TestDummy\Factory as TestDummy;

class UserTest extends TestCase
{

    /** @test */
    public function it_visits_register_page()
    {
        $this->visit('auth/register')
            ->andSeePageIs('auth/register');
    }

    /** @test */
    public function it_register_a_user()
    {
        $credentials = ['email' => 'foo@example.com'];

        $this->register($credentials)
            ->verifyInDatabase('users', $credentials)
            ->seePageIs('/notices/create');
    }

    /** @test */
    public function it_notifies_a_user_of_registration_errors()
    {
        $this->createUser($overrides = ['email' => 'foo@example.com']);

        $this->register($overrides)
            ->andSee('The email has already been taken.')
            ->andSeePageIs('auth/register');
    }

    private function createUser(array $overrides = [])
    {
        return TestDummy::create('App\User', $overrides);
    }
}