<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use PetNecro\User;

class ApplicationTest extends TestCase
{
    use DatabaseMigrations;

    /** @var User */
    protected $user;

    /** @test */
    public function the_home_page_loads_properly()
    {
        $this->visit('/')
            ->seeStatusCode(200)
            ->see(trans('pages.application.title'))
            ->seePageIs('/');
    }

    /** @test */
    public function the_layout_does_not_show_login_register_links_if_logged_in()
    {
        $this->login();

        $this->visit('/')
            ->seeStatusCode(200)
            ->see($this->user->name)
            ->see(trans('pages.navbar.logout'))
            ->dontSee(trans('pages.navbar.register'));
    }

    /**
     * @param array $attributes
     * @return User
     */
    protected function login(array $attributes = [])
    {
        $this->actingAs($this->user = $user = $this->createUser($attributes));

        return $user;
    }

    /**
     * @param array $attributes
     * @return User
     */
    protected function createUser(array $attributes = [])
    {
        return factory(User::class)->create($attributes);
    }

    /** @test */
    public function the_login_page_shows_properly()
    {
        $this->visit('/login')
            ->seeStatusCode(200)
            ->see(trans('pages.login.email'))// E-mail field
            ->see(trans('pages.login.password')); // Password field

        $this->login();

        $this->visit('/login')
            ->dontSee(trans('pages.login.email'))
            ->seePageIs('/');
    }

    /** @test */
    public function the_register_page_shows_properly()
    {
        $this->visit('/register')
            ->seeStatusCode(200)
            ->see("Email")
            ->see("Password");

        $this->login();

        $this->visit('/register')
            ->dontSee("Email")
            ->seePageIs('/');
    }
}
