<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApplicationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function the_home_page_loads_properly()
    {
        $this->visit('/')
            ->seeStatusCode(200)
            ->see(trans('pages.application.title'));
    }

    /** @test */
    public function the_login_page_shows_properly() {
        $this->visit('/login')
            ->seeStatusCode(200)
            ->see(trans('pages.login.username'))
            ->see(trans('pages.login.password'));
    }

    /** @test */
    public function the_register_page_shows_properly() {
        $this->visit('/register')
            ->seeStatusCode(200)
            ->see(trans('pages.register.username'))
            ->see(trans('pages.register.password'));
    }
}
