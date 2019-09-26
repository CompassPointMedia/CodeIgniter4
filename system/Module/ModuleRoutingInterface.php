<?php namespace CodeIgniter\Module;

interface ModuleRoutingInterface
{
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
     * @param array $module
     * @return bool
     */
    public function isMyUri(string $HTTPVerb, string $uri, array $module = []) : bool;
}