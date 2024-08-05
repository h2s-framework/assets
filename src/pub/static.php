<?php
declare(strict_types=1);


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(file_exists($GLOBALS['_composer_autoload_path'])){
    require $GLOBALS['_composer_autoload_path'];
}else{
    die("APPLICATION AUTOLOADER NOT FOUND!");
}

$projectRoot = dirname(dirname($GLOBALS['_composer_autoload_path']));

\Siarko\Api\State\Scope\ScopeProviderRegistry::setScope('static');
$bootstrap = new Siarko\Bootstrap\Bootstrap($projectRoot);
$bootstrap->run(\Siarko\Assets\App\StaticContentApp::class);
