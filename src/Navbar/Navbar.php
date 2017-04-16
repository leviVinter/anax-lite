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
        $config = $this->config;
        $html = "<ul class='" .
                $config["config"]["navbar-left-class"] .
                "'>";
        foreach ($config["items"] as $item) {
            $html .= "<li";
            if ($item["route"] == $this->currentRoute) {
                $html .= " class='active'";
            }
            $html .= "><a href='" . $item["route"] . "'>" .
                     $item["text"] . "</a></li>";
        }
        $html .= "</ul>";
        return $html;
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
}
