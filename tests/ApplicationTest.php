<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use PetNecro\Profile;
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
        $this->actingAs($this->user = $this->createUser($attributes));

        return $this->user;
    }

    /**
     * @param array $attributes
     * @return User
     */
    protected function createUser(array $attributes = [])
    {
        /** @var User $user */
        $user = factory(User::class)->create($attributes);
        $user->profile()->create(factory(Profile::class)->make(['user_id' => $user->id])->toArray());

        return $user->load('profile');
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
            ->see(trans('pages.register.username'))
            ->see(trans('pages.register.email'))
            ->see(trans('pages.register.password'));

        $this->login();

        $this->visit('/register')
            ->dontSee(trans('pages.register.email'))
            ->seePageIs('/');
    }
}
