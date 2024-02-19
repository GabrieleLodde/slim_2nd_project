<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController extends AbstractController{

    /**
     * Metodo per l'accesso alla home page
     * @link /alunni
     * @method GET
     */

    function index(Request $request, Response $response, $args){

        $classe = new Classe();
        $view = new AlunniPage();
        $view->setData($classe);
        
        $mainPage = new MainPage();
        $mainPage->set("body", $view->render());
        $response->getBody()->write($mainPage->render());
        return $response;
    }

    /**
     * Metodo per l'accesso alla home page
     * @link /alunni/search[/{nome:[\w\d]+}]
     * @method GET
     */

     function findByName(Request $request, Response $response, $args){
        $params = isset($_GET['nome'])?$_GET:null;
        $nome = isset($args['nome'])?$args['nome']:$params['nome'];

        $classe = new Classe();
        $data['Alunno'] = $classe->findByName($nome);

        $view = new AlunnoPage();
        $view->setData($data);
        $mainPage = new MainPage();
        $mainPage->set("body", $view->render());
        $response->getBody()->write($mainPage->render());
        return $response;
    }
}