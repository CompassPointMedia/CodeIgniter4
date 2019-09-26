<?php namespace Config;

// Cannot extend BaseConfig or looping resources occurs.
class Modules
{
	/*
	 |--------------------------------------------------------------------------
	 | Auto-Discovery Enabled?
	 |--------------------------------------------------------------------------
	 |
	 | If true, then auto-discovery will happen across all elements listed in
	 | $activeExplorers below. If false, no auto-discovery will happen at all,
	 | giving a slight performance boost.
	 */
	public $enabled = true;

	/*
	 |--------------------------------------------------------------------------
	 | Auto-Discovery Within Composer Packages Enabled?
	 |--------------------------------------------------------------------------
	 |
	 | If true, then auto-discovery will happen across all namespaces loaded
	 | by Composer, as well as the namespaces configured locally.
	 */
	public $discoverInComposer = true;

	/*
	|--------------------------------------------------------------------------
	| Auto-discover Rules
	|--------------------------------------------------------------------------
	|
	| Lists the aliases of all discovery classes that will be active
	| and used during the current application request. If it is not
	| listed here, only the base application elements will be used.
	*/
	public $activeExplorers = [
		'events',
		'registrars',
		'routes',
		'services',
	];

	/**
	 * Should the application auto-discover the requested resources.
	 *
	 * Valid values are:
	 *  - events
	 *  - registrars
	 *  - routes
	 *  - services
	 *
	 * @param string $alias
	 *
	 * @return boolean
	 */
	public function shouldDiscover(string $alias)
	{
		if (! $this->enabled)
		{
			return false;
		}

		$alias = strtolower($alias);

		return in_array($alias, $this->activeExplorers);
	}
    /*
    |--------------------------------------------------------------------------
    | Modules with Routing Authority (Module Routing Engine)
    |--------------------------------------------------------------------------
    |
    | This system, instead of taking routes and naming controller/method,
    | allows the modules listed below to inspect and "claim" a URI as its own.
    | For example, a site may have a standard page controller as well as an
    | extensive CMS/article plugin.  Pages might include /about-us, /contact-us,
    | etc. while articles might include /how-to-train-your-dragon/2019/08 or
    | /why-i-am-frustrated-with-star-wars.  The site developer may NOT want to
    | preface the articles with /articles/ and so Module Routing allows the module
    | that produced the URI (the articles) to claim it.
    | Now it's no longer a matter of regex routes but simply the module claiming
    | the $uri as its own.
    |
    | Obviously you can't have an article title and a page resolve to the same
    | value, but a little preventative coding on the creation end would avoid
    | the prefix `/articles` being needed - why have part of a url you don't
    | really need?
    */
    /**
     * Whether or not to utilize the Module Routing feature, false turns it off.
     *
     * @var bool $useModuleRouting
     */
    public $useModuleRouting = true;

    public $routingModules = [
        // modules get to review URIs in the order they are declared here
        [
            'active' => true,
            'name' => 'Sample Module Routing temp-stored in Controllers/Modules',
            'class' => \App\Controllers\Modules\SampleModuleRouting::class,

        ]
    ];

}
