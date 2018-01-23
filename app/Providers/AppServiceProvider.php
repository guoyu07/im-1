<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->_repositoryBoot();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function _repositoryBoot()
    {
        $repositories = File::files(app_path('Repositories'), true);
        foreach ($repositories as $file) {
            $repository = File::name($file);
            if ($repository == 'BaseRepository') continue;
            $Repository = "App\Repositories\\" . $repository;
            $Model = "App\Models\\" . str_ireplace('Repository', '', $repository);
            $this->app->bind($Repository, function () use ($Repository, $Model){
                return new $Repository(new $Model);
            });

        }
    }
}
