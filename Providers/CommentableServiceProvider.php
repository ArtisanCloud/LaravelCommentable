<?php

namespace ArtisanCloud\Commentable\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CommentableService\Contracts\CommentableServiceContract;


/**
 * Class CommentableServiceProvider
 * @package App\Providers
 */
class CommentableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        // Load the config file and merge it with the user's (should it get published)
        include_once(__DIR__.'/../config/constant.php');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // config framework router
        $this->configRouter();

        // load translation resource
//        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'todoable');

        if ($this->app->runningInConsole()) {
            // publish config file

            // register artisan command
            if (!class_exists('CreateCommentableTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_comment_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_comment_table.php'),
                    // you can add any number of migrations here
                ], ['ArtisanCloud', 'Commentable-Migration']);
            }
        }
    }

    public function configRouter()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

    }
}
