<?php


namespace Controllers;

use Framework\Controller;
use Framework\View;

class DefaultController extends Controller{

    public function indexAction(){
        $data = ['message' => 'test'];
        $view = new View('accueil');
        $view->render($data);
    }

} 