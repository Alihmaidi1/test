<?php

namespace App\Providers;

use App\repo\classes\image;
use App\repo\classes\invertory;
use Illuminate\Support\ServiceProvider;
use App\repo\interfaces\productinterface;
use App\repo\classes\product;
use App\repo\classes\unit;
use App\repo\classes\user;
use App\repo\interfaces\imageinterface;
use App\repo\interfaces\invertoryinterface;
use App\repo\interfaces\unitinterface;
use App\repo\interfaces\userinterface;

class repoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {


        $this->app->bind(productinterface::class,product::class);
        $this->app->bind(unitinterface::class,unit::class);
        $this->app->bind(invertoryinterface::class,invertory::class);
        $this->app->bind(userinterface::class,user::class);
        $this->app->bind(imageinterface::class,image::class);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
