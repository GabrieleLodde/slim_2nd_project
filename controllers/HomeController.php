<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include __DIR__ .'/../views/Home.php';
require_once ("./Classe.php");

class HomeController{

    /**
     * Metodo per l'accesso alla home page
     * @method GET
     */

    function home(Request $request, Response $response, $args){

        $classe = new Classe();
        $view = new Home();
        $view->setData($classe);

        $response->getBody()->write($view->render());
        return $response;
    }
}