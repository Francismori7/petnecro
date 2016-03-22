<?php

namespace PetNecro\Providers;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Illuminate\Support\ServiceProvider;
use \Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsEmail', 'components.form.email', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsPassword', 'components.form.password', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('fr_CA');
        });
    }
}
