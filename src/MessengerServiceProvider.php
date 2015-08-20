<?php namespace Jakjr\Messenger;

use Illuminate\Support\ServiceProvider;

class MessengerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__.'/views', 'messenger');

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/messenger'),
            __DIR__.'/config/messenger.php' => config_path('messenger.php'),
        ]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('messenger', function(){
            return new Messenger();
        });

        $this->mergeConfigFrom(
            __DIR__ . '/config/messenger.php', 'messenger'
        );
	}


}
