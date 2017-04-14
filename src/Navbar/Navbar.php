<?php

namespace Vinter\Navbar;

/**
 * Navbar to generate HTML för a navbar from a configuration array.
 */
class Navbar implements \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait;

    private $currentRoute;
    private $urlCreator;

    /**
     * Get HTML for the navbar.
     *
     * @return string as HTML with the navbar.
     */
    public function getHTML()
    {
        ;
    }

    /**
     * Sets the current route.
     *
     * @param string $route the current route.
     *
     * @return void
     */
    public function setCurrentRoute($route)
    {
        $this->currentRoute = $route;
    }

    /**
     * Get the current route.
     * @return string
     */
    public function getCurrentRoute()
    {
        return $this->currentRoute;
    }

    /**
     * Sets the callable to use for creating routes.
     *
     * @param callable $urlCreate to create framework urls.
     *
     * @return void
     */
    public function setUrlCreator($urlCreate)
    {
        $this->urlCreator = $urlCreate;
    }

    /**
     * Get url
     * @param string $path Name of the route to get the url for.
     * @return string
     */
    public function getUrl($path)
    {
        $url = call_user_func($this->urlCreator, $path);
        return $url;
    }

    /**
     * Get configure array
     * @return []
     */
    public function getConfig()
    {
        return $this->config;
    }
}
