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
    private $loggedIn;
    private $admin = false;

    /**
     * Get HTML for the navbar.
     * @return string as HTML with the navbar.
     */
    public function getHTML()
    {
        $config = $this->config["config"];
        $items = $this->config["items"];
        $itemsRight = $this->config["items-right"];
        $html = "<ul class='{$config['navbar-left-class']}'>";
        foreach ($items as $item) {
            $active = $item["route"] == $this->currentRoute
                ? "active" : "";
            $route = call_user_func($this->urlCreator, $item["route"]);
            $html .= "<li class='{$active}'>";
            $html .= "<a href='{$route}'>{$item['text']}</a></li>";
        }
        $html .= "</ul>";
        $html .= "<ul class='{$config['navbar-right-class']}'>";
        foreach ($itemsRight as $item) {
            $active = $item["route"] == $this->currentRoute
                ? "active" : "";
            $route = call_user_func($this->urlCreator, $item["route"]);
            $html .= "<li class='{$active}'>";
            // Check if user is logged in or not
            if ($item['route'] === "login" && $this->loggedIn) {
                if ($this->admin) {
                    $route = call_user_func($this->urlCreator, "admin");
                } else {
                    $route = call_user_func($this->urlCreator, "profile");
                }
                $html .= "<a href='{$route}'>{$this->loggedIn}</a></li>";
            } else {
                $html .= "<a href='{$route}'>{$item['text']}</a></li>";
            }
        }
        $html .= "</ul>";

        return $html;
    }

    /**
     * Sets the current route.
     * @param string $route the current route.
     * @return void
     */
    public function setCurrentRoute($route)
    {
        $this->currentRoute = $route;
    }

    /**
     * Sets the callable to use for creating routes.
     * @param callable $urlCreate to create framework urls.
     * @return void
     */
    public function setUrlCreator($urlCreate)
    {
        $this->urlCreator = $urlCreate;
    }

    /**
     * Set whether a user is logged in or not
     * @param $loggedIn bool Is a user logged in?
     * @return void
     */
    public function setLoggedIn($loggedIn)
    {
        $this->loggedIn = $loggedIn;
    }
    /**
     * Set wheter an admin is logged in
     * @param $admin bool Is an admin logged in?
     * @return void
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }
}
