<?php
/**
 * Created by PhpStorm.
 * User: seb
 * Date: 07/11/2014
 * Time: 13:44
 */

namespace Models;


use Framework\Models;

class categorieModel extends Models{

    protected $_id;
    protected $_categorie;

    function __construct($params) {
        $this->_required_members = ['categorie'];
        $this->init($params);
    }

    private function init($params){
        $this->_errors = [];
        Utils::hydrate($this, $params);
        try {
            if(! $this->hasErrors()){
                $this->validate();
            }
        } catch (\InvalidArgumentException $e) {
            $this->_errors[] = $e->getMessage();
        } catch (\Exception $e) {
            $this->_errors[] = $e->getMessage();
        }

    }

    protected function validate() {
        if ($this->areRequiredFieldsEmpty()) {
            throw new \Exception('certains champs requis sont vides');
        }
    }

    public function setCategorie($categorie) {
        if(! empty($categorie)){
            $this->_categorie = $categorie;
        }else {
            throw new \Exception ('La catégorie ne peut être vide');
        }
    }


}