<?php

namespace CodeIgniter\Module;

/**
 * Class ModuleRoutingEngine
 * @package CodeIgniter\Module
 *
 * Created by Samuel Fullman <samuel.fullman@gmail.com>
 */
class ModuleRoutingEngine
{

    /**
     * @var $modules null
     */
    private $routingModules;

    /**
     * @var $routes null
     */
    private $routes;

    /**
     * The following 6 properties are currently set in CodeIgniter4 in Router::checkRoutes()
     * and need to be provided by the client ::isMyUri() method

    detectedLocale : empty (or set if detected)

    controller : \App\Controllers\Modules\SampleVendorCMS

    method : renderArticle

    params : Array(
        [0] => (array) article from db
        [1] => (int) responseid (say there is a user response we want to highlight)
    )

    matchedRoute: Array(
        [0] => ([0-9]+)   (again, this could be anything with Module Routing)
        [1] => \App\Controllers\Modules\SampleVendorCMS::renderArticle
    )

    matchedRouteOptions : Array()

     */
    public $detectedLocale = null;

    public $controller = null;

    public $method = null;

    public $params = null;

    public $matchedRoute = null;

    public $matchedRouteOptions = null;

    public $controllerConstructor = null;


    public function __construct($modules, $routes)
    {

        // set routingModules from Config\Modules
        $this->routingModules = $modules->routingModules;

        // this may or may not be needed in this class;
        // Module Routing is independent of declared routes
        $this->routes = $routes;
    }

    /**
     * @param $HTTPVerb
     * @param $uri
     * @return bool
     * @throws \ErrorException
     */
    public function runThrough($HTTPVerb, $uri)
    {
        $uriClaimed = 0;

        foreach($this->routingModules as $module)
        {
            if(isset($module['active']) && $module['active'] === false)
            {
                // Allows config to inactivate modules
                continue;
            }

            $class = $module['class'];
            $routeInspect = new $class();

            if(empty(class_implements($routeInspect)['CodeIgniter\Module\ModuleRoutingInterface']))
            {
                throw new \ErrorException('Declared routing module ' . $module['class'] . ' does not correctly implement interface \CodeIgniter\Module\ModuleRoutingInterface.php');
            }

            if($routeInspect->isMyUri($HTTPVerb, $uri, $module))
            {
                //@todo: we may want to get the first match but in CMS debugging mode continue through the list and see if there are any conflicts, and either exit or log the incident

                $this->detectedLocale = $routeInspect->detectedLocale;

                $this->controller = $routeInspect->controller;

                $this->method = $routeInspect->method;

                $this->params = $routeInspect->params;

                $this->matchedRoute = $routeInspect->matchedRoute;

                $this->matchedRouteOptions = $routeInspect->matchedRouteOptions;

                if (! empty($routeInspect->controllerConstructor))
                {
                    //@todo: allow user-defined helper function to assemble controllerConstructor vars returned
                    $this->controllerConstructor = array_merge(
                        $this->controllerConstructor ?? [],
                        [$routeInspect->controllerConstructor]
                    );
                }

                if (! empty($module['exclusive']))
                {
                    // Revert to only this module's input for constructor.
                    $this->controllerConstructor = isset($routeInspect->controllerConstructor) && ! is_null($routeInspect->controllerConstructor) ? $routeInspect->controllerConstructor : null;
                    return true;
                }

                $uriClaimed++;
            }

            $routeInspect = null;
        }
        return $uriClaimed ? true : false;

    }
}