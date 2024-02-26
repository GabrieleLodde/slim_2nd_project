<?php
use Slim\Factory\AppFactory;
define("BASE_PATH",__DIR__);
require __DIR__ . '/vendor/autoload.php';


function autoload($className){
    $paths=['/','/controllers','/views','/models'];
    foreach($paths as $path){
        $file = __DIR__.$path."/$className.php";
        if(file_exists($file))
        {
            require_once($file);
            break;
        }
    }
}

spl_autoload_register("autoload");

$app = AppFactory::create();
$app->get('/', 'HomeController:index');
$app->get('/alunni', 'AlunniController:index');
$app->get('/alunni/search[/{nome}]', 'AlunniController:findByName');
$app->get('/json/alunni', 'AlunniController:json_alunni');
$app->get('/json/alunni/{nome}', 'AlunniController:json_findByName');
$app->run();