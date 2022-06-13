<?php

namespace Config;

use CodeIgniter\Modules\Modules as BaseModules;

class Modules extends BaseModules
{
    /**
     * --------------------------------------------------------------------------
     * Enable Auto-Discovery?
     * --------------------------------------------------------------------------
     *
     * If true, then auto-discovery will happen across all elements listed in
     * $aliases below. If false, no auto-discovery will happen at all,
     * giving a slight performance boost.
     *
     * @var bool
     */
    public $enabled = true;

    /**
     * --------------------------------------------------------------------------
     * Enable Auto-Discovery Within Composer Packages?
     * --------------------------------------------------------------------------
     *
     * If true, then auto-discovery will happen across all namespaces loaded
     * by Composer, as well as the namespaces configured locally.
     *
     * @var bool
     */
    public $discoverInComposer = true;

    /**
     * --------------------------------------------------------------------------
     * Auto-Discovery Rules
     * --------------------------------------------------------------------------
     *
     * Aliases list of all discovery classes that will be active and used during
     * the current application request.
     *
     * If it is not listed, only the base application elements will be used.
     *
     * @var string[]
     */
    public $aliases = [
        'events',
        'filters',
        'registrars',
        'routes',
        'services',
    ];

    /**
     * --------------------------------------------------------------------------
     * Modules with Routing Authority (Module Routing Engine)
     * --------------------------------------------------------------------------
     *
     * This system, instead of taking routes and naming controller/method,
     * allows the modules listed below to inspect and "claim" a URI as its own.
     * For example, a site may have a standard page controller as well as an
     * extensive CMS/article plugin.  Pages might include /about-us, /contact-us,
     * etc. while articles might include /how-to-train-your-dragon/2019/08 or
     * /why-i-am-frustrated-with-star-wars.  It would make sense to declare the
     * pages module first if present, and then the articles module.  Obviously you
     * can't have an article title and a page resolve to the same value, but
     * a little preventative coding would avoid needing a prefix `/articles` all the
     * time - why have part of a URL you don't really need?
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
            'class' => \App\Controllers\Modules\SamplePrimaryModuleRouting::class,

        ],[
            'active' => true,
            'name' => 'CMS/Article Module, handles articles stored in database',
            'class' => \App\Controllers\Modules\SampleVendorCMS::class,

        ]
    ];


}
