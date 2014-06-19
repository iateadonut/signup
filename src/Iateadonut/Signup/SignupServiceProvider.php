<?php namespace Iateadonut\Signup;

use Illuminate\Support\ServiceProvider;

class SignupServiceProvider extends ServiceProvider {

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
		$this->package('iateadonut/signup');
		require ( __DIR__ . '/../../routes.php' );
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['signup'] = $this->app->share(function($app)
		{
			return new Signup();		
		});
		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('signup');
	}

}
