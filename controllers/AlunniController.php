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
     * Metodo per la ricerca dell'alunno per nome
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

    function json_alunni(Request $request, Response $response, $args){
        $classe = new Classe();
        $response->getBody()->write(json_encode($classe->getArray()));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }

    function json_findByName(Request $request, Response $response, $args){
        $params = isset($_GET['nome'])?$_GET:null;
        $nome = isset($args['nome'])?$args['nome']:$params['nome'];
        $classe = new Classe();
        $data['Alunno'] = $classe->findByName($nome);
        $response->getBody()->write(json_encode($data));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }


    function methodPost(Request $request, Response $response, $args){
        $post_data = json_decode($request->getBody()->getContents(), true);
        //var_dump($post_data);
        $classe = new Classe();
        $alunno = new Alunno($post_data["nome"], $post_data["cognome"], $post_data["eta"]);
        $classe->addAlunno($alunno);
        $response->getBody()->write(json_encode($classe->getArray()));
        return $response->withHeader("Content-type", "application/json")->withStatus(201);
    }

    function methodPut(Request $request, Response $response, $args){
        $put_data = json_decode($request->getBody()->getContents(), true);
        $classe = new Classe();
        $alunno = new Alunno($put_data["nome"], $put_data["cognome"], $put_data["eta"]);
        $alunno_modificato = $classe->modifyAlunno($alunno, $args["id"]);
        if(!is_null($alunno_modificato)){
            $response->getBody()->write(json_encode($classe->getArray()));
            return $response->withHeader("Content-type", "application/json")->withStatus(201);
        }
        else{
            $response->getBody()->write(json_encode(["Modifica" => "False"]));
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
    }

    function methodDelete(Request $request, Response $response, $args){
        $classe = new Classe();
        $eliminato = $classe->deleteAlunno($args["id"]);
        if($eliminato){
            $response->getBody()->write(json_encode($classe));
            return $response->withHeader("Content-type", "application/json")->withStatus(202);
        }
        else{
            $response->getBody()->write(json_encode(["Cancellazione" => "False"]));
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
    }
}