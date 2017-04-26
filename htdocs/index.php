<?php
/**
 * Bootstrap the framework.
 */
// Where are all the files? Booth are needed by Anax.
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));
define("ANAX_APP_PATH", ANAX_INSTALL_PATH);

// Include essentials
require ANAX_INSTALL_PATH . "/config/error_reporting.php";

// Get the autoloader by using composers version.
require ANAX_INSTALL_PATH . "/vendor/autoload.php";

// Add all resources to $app.
$app = new \Vinter\App\App();
$app->request = new \Anax\Request\Request();
$app->response = new \Anax\Response\Response();
$app->url = new \Anax\Url\Url();
$app->router = new \Anax\Route\RouterInjectable();
$app->view = new \Anax\View\ViewContainer();
$app->navbar = new \Vinter\Navbar\Navbar();
$app->session = new \Vinter\Session\Session();
$app->db = new \Vinter\Database\DatabaseConfigure();
$app->queryLogin = new \Vinter\Database\QueryLogin();
$app->queryContent = new \Vinter\Database\QueryContent();
$app->helpers = new \Vinter\Helpers\Helpers();
$app->user = new \Vinter\User\User();
$app->cookie = new \Vinter\Cookie\Cookie();
$app->textfilter = new \Vinter\Textfilter\Textfilter();

// Inject $app into the view container for use in view files.
$app->view->setApp($app);

// Update view configuration with values from config file.
$app->view->configure("view.php");

// Init the object of the request class.
$app->request->init();

// Init the url-object with default values from the request object.
$app->url->setSiteUrl($app->request->getSiteUrl());
$app->url->setBaseUrl($app->request->getBaseUrl());
$app->url->setStaticSiteUrl($app->request->getSiteUrl());
$app->url->setStaticBaseUrl($app->request->getBaseUrl());
$app->url->setScriptName($app->request->getScriptName());

// Update url configuration with values from config file.
$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();


// Start session
$app->session->start();
$loggedIn = $app->session->get("admin")
    ?: $app->session->get("user");

// Setup navbar
$app->navbar->configure("navbar.php");
$app->navbar->setCurrentRoute($app->request->getRoute());
$app->navbar->setUrlCreator([$app->url, "create"]);
$app->navbar->setLoggedIn($loggedIn);
$admin = $app->session->has("admin") ? true : false;
$app->navbar->setAdmin($admin);

// Configure database
$app->db->configure("database.php");
$app->db->setDefaultsFromConfiguration();
$app->db->connect();

// Setup query objects
$app->queryLogin->setDatabaseObj($app->db);
$app->queryContent->setDatabaseObj($app->db);

// Setup user
if ($app->session->has("user")) {
    $app->user->setQueryObj($app->queryLogin);
    $app->user->fetchInfo($loggedIn);
}

// Load the routes
require ANAX_INSTALL_PATH . "/config/route.php";

// Leave to router to match incoming request to routes
$app->router->handle($app->request->getRoute());
