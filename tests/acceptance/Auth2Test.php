<?php

use Laracasts\Integrated\Extensions\Selenium;

class Auth2Test extends Selenium
{

    /** @test */
    public function it_visits_the_registration_page()
    {
        $this->visit('auth/regiser')
            ->wait(5000);
    }
}