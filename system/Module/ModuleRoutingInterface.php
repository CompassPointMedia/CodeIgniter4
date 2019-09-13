<?php namespace CodeIgniter\Module;

interface ModuleRoutingInterface
{
    /**
     * Whether or not we need a database to figure out if this is mine
     * @var bool
     * @return boolean
     */
    public function usesDb() : bool;

    /**
     * Main call function; looks at URI and determines the following:
     *  - is this from my system
     * @todo: work on these
     *  - what is the status of the resource (default active, or deleted, or moved)
     *  - page-level authorization required for the resource
     *  - ideally whether the current user matches this authorization
     *
     * Also sets:
     *  controller
     *  method
     *  detectedLocale
     *  params
     *  matchedRoute
     *  matchedRouteOptions
     *
     * @param string $HTTPVerb
     * @param string $uri
     * @return bool
     */
    public function isMyUri(string $HTTPVerb, string $uri) : bool;
}