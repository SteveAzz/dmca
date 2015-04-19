<?php

use Laracasts\TestDummy\Factory as TestDummy;

trait RegistersUsers
{
    protected function register(array $overrides)
    {
        $fields = $this->getRegisterFields($overrides);

        return $this->visit('auth/register')
            ->andSubmitForm('Register', $fields);
    }

    /**
     * @param array $overrides
     * @return array
     */
    protected function getRegisterFields(array $overrides)
    {
        $user = TestDummy::attributesFor('App\User', $overrides);

        return $user += ['password_confirmation' => $user['password']];

    }
}