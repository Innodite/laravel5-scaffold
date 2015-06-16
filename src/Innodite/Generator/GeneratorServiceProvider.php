<?php namespace Innodite\Generator;

use Illuminate\Support\ServiceProvider;
use Innodite\Generator\Commands\APIGeneratorCommand;
use Innodite\Generator\Commands\PublishBaseControllerCommand;
use Innodite\Generator\Commands\ScaffoldAPIGeneratorCommand;
use Innodite\Generator\Commands\ScaffoldGeneratorCommand;

class GeneratorServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$configPath = __DIR__ . '/../../../config/generator.php';
		$this->publishes([$configPath => config_path('generator.php')], 'config');
		$this->publishes([
			__DIR__ . '/../../../views' => base_path('resources/views'),
		], 'config');
		$this->publishes([
			__DIR__ . '/Templates' => base_path('resources/api-generator-templates'),
		], 'templates');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('innodite.generator.api', function ($app)
		{
			return new APIGeneratorCommand();
		});

		$this->app->singleton('innodite.generator.scaffold', function ($app)
		{
			return new ScaffoldGeneratorCommand();
		});

		$this->app->singleton('innodite.generator.scaffold_api', function ($app)
		{
			return new ScaffoldAPIGeneratorCommand();
		});

		$this->app->singleton('innodite.generator.publish.base_controller', function ($app)
		{
			return new PublishBaseControllerCommand();
		});

		$this->commands(['innodite.generator.api', 'innodite.generator.scaffold', 'innodite.generator.scaffold_api', 'innodite.generator.publish.base_controller']);
	}
}
