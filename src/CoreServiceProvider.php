<?php namespace JetCMS\Core;

use Storage;
use View;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

use Illuminate\Contracts\Debug\ExceptionHandler;
use JetCMS\Core\Exceptions\Handler;

class CoreServiceProvider extends ServiceProvider {

	/**
	 * Define Service Providers from our dependencies
	 */
	protected $parent_providers = [
		\Mews\Purifier\PurifierServiceProvider::class,
		\Baum\Providers\BaumServiceProvider::class,
		\Intervention\Image\ImageServiceProvider::class,
		\Roumen\Sitemap\SitemapServiceProvider::class,
		\Roumen\Feed\FeedServiceProvider::class,
		\Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class,
		\GrahamCampbell\Markdown\MarkdownServiceProvider::class
	];

	/**
	 * Define aliases to register
	 */
	protected $aliases = [
		'Image' 	=> \Intervention\Image\Facades\Image::class,
		'Purifier' 	=> \Mews\Purifier\Facades\Purifier::class,
		'Feed' 		=> \Roumen\Feed\Facades\Feed::class,
		'SEO'       => \Artesaos\SEOTools\Facades\SEOTools::class,
		'Setting'   => \Grimthorr\LaravelUserSettings\Facade::class,
		'Carbon'    => \Carbon\Carbon::class,
		'Markdown' 	=> \GrahamCampbell\Markdown\Facades\Markdown::class
	];

	protected function publishConfig($dir,$name){
		$config_file = $dir . '/../config/'.$name.'.php';

		$this->mergeConfigFrom($config_file, 'jetcms.'.$name);

		$this->publishes([
			$config_file => config_path('/jetcms/'.$name.'.php')
		], 'config');

	}

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app->singleton(
			ExceptionHandler::class,
			Handler::class
		);

		$this->loadViewsFrom(__DIR__.'/../views', 'jetcms.core');

		$this->publishConfig(__DIR__,'core');

		$this->publishes([
			__DIR__.'/../publish' => base_path()
		]);

		include __DIR__.'/../helpers.php';
		include __DIR__.'/../routes.php';
	}

	/**
	 * Register the application services. 
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerParentProviders();
		$this->registerAliases();
	}

	/**
	 * Register Dependency Providers
	 */
	protected function registerParentProviders()
	{
		foreach ($this->parent_providers as $parentProviderClass)
		{
			$this->app->register($parentProviderClass);
		}
	}

	/**
	 * Register the aliases from this module.
	 */
	protected function registerAliases()
	{
		$loader = AliasLoader::getInstance();
		foreach ($this->aliases as $aliasName => $aliasClass) {
			$loader->alias($aliasName, $aliasClass);
		}
	}
        
}