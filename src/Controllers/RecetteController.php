<?php
/**
 * Created by PhpStorm.
 * User: seb
 * Date: 07/11/2014
 * Time: 12:54
 */

namespace Controllers;


use Framework\Controller;
use Framework\View;
use Models\DAO\CategorieDAO;
use Models\DAO\DifficulteDAO;
use Models\DAO\RecetteDAO;
use Models\RecetteModel;

class RecetteController extends Controller{

    public function newAction(){
        $data = [];
        if($this->_application->getRequest()->getMethod()=="POST"){
            $recette = new RecetteModel($this->getPostData());
            if(! $recette->hasErrors()){
                $recette->save();
                $location = 'location:http://'.$this->_application->getHost().'/recette/showAll';
                header($location);
                exit(0);
            } else {
                $data['errors'] = $recette->getErrors();
            }

        } else {
            $categorieDAO = new CategorieDAO();
            $data['listeCategorie'] = $categorieDAO->getAll();

            $difficulteDAO = new DifficulteDAO();
            $data['listeDifficulte'] = $difficulteDAO->getAll();

            $view = new View('recettes/new');
            $view->render($data);
        }
    }

    public function showAllAction(){
        $dao = new RecetteDAO();
        $data['recettes'] = $dao->getAll();

        $view = new View('recettes/showAll');
        $view->render($data);

    }

    public function searchAction(){
        $categorieDAO = new CategorieDAO();
        $data['listeCategorie'] = $categorieDAO->getAll();

        $view = new View('recettes/search');
        $view->render($data);

    }

} 