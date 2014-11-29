<?php
    namespace Framework;



    /**
     * Class Controller
     * @package Framework
     *          Cette classe fournit les services de base du controleur.
     *          Elle permet d'exécuter une action, de communiquer avec l'application
     *          et de récupérer les collections de la requête http
     */

    abstract class Controller
    {
        /**
         * @var WebApplication
         */
        protected  $_application;
        /**
         * @var string
         */
        protected  $_appPath;
        /**
         * @var string
         */
        protected  $_action;

        protected $_actionParameters = [];
        /**
         * @var string
         */
        protected  $_view;

        protected $_request;


        /**
         * @param      $action
         *
         * @throws \Exception
         * @internal param bool $requireAuthentification
         *
         */
        function __construct($action, $actionParameters = []) {

            $this->_application = WebApplication::getApplication();
            $this->_request = $this->_application->getRequest();
            $this->_action      = $action;
            $this->_actionParameters = $actionParameters;

            //$this->_requireAuthentification = $requireAuthentification;

            if (!method_exists($this, $action)) {
                throw new \Exception ("La méthode " . $action . " n'existe pas");
            }
        }

        /**
         * Execute une action du controleur
         */
        public function execute() {
            call_user_func([$this, $this->_action], $this->_actionParameters);
        }

        protected function getPostData(){
            return $this->_request->getPost()->getCollection();
        }

        protected function getUrlData(){
            return $this->_request->getUrlParameters()->getCollection();
        }
        protected function getSessionData(){
            return $this->_request->getSession()->getCollection();
        }



    }