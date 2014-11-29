<?php

    namespace Framework;
    /**
     * Class WebApplication
     * @package Framework
     *          Cette classe représente une application, c'est elle qui est appelée par le fichier index.php
     */

    class WebApplication
    {

        /**
         * @var \Framework\Webapplication
         */
        private static $_instance = null;
        /**
         * @var string
         */
        private $_rootPath;

        private $_ApplicationPath;

        /**
         * @var array
         */
        private $_config;
        /**
         * @var \Framework\HttpRequest
         */
        private $_httpRequest;
        /**
         * @var \Framework\HttpResponse
         */
        private $_httpResponse;

        private $_currentController;

        private $_action;

        private $_actionParameters;

        /**
         * Singleton donc constructeur privé pour éviter une instanciation abusive
         */
        private function __construct() {
            $this->_httpRequest = new HttpRequest();
            $this->_httpResponse = new HttpResponse();
        }
        /**
         * @return WebApplication
         * Singleton, ne retourne qu'une seule et unique instance
         */
        public static function getApplication() {
            if (!isset(self::$_instance) || !(self::$_instance instanceof WebApplication)) {
                self::$_instance = new WebApplication();
            }
            return self::$_instance;
        }

        /**
         * Lancement de l'application
         */
        public function run($config = []){
            try {
                //Chargement de la configuration de l'application
                if(DEBUG) $GLOBALS['logger']->debug(__FILE__." - Chargement de la configuration de l'application");
                $this->_config = $config;


                //Lancement du routeur
                if(DEBUG) $GLOBALS['logger']->debug(__FILE__." - Lancement du routeur");
                $router = new Router($this->_httpRequest);
                $this->_currentController = $router->getController();
                $this->_action = $router->getAction();
                $this->_actionParameters = $router->getParams();

                //throw new \Exception('test');

                //Lancement du controlleur
                if(DEBUG) $GLOBALS['logger']->debug(__FILE__." - Lancement du controlleur");
                $this->launchController();


            } catch (\Exception $e){
                $GLOBALS['logger']->error(__FILE__." ". $e->getMessage());
                $this->_httpResponse->sendError($e->getMessage());
            }
        }

        private function launchController(){
            $controllerInstance = $this->getControllerInstance();
            $controllerInstance->execute();
        }

        private function getControllerInstance(){
            $className = '\\Controllers\\' . $this->_currentController;
            if (!class_exists($className)) {
                throw new \Exception ("La classe " . $className . " n'existe pas");
            }

            $this->testActionSignature($className);

            return new $className($this->_action);
        }

        private function testActionSignature($className){
            $r = new \ReflectionMethod($className, $this->_action);
            if($r->getNumberOfRequiredParameters() > count($this->_actionParameters)){
                throw new \Exception('Le nombre de paramètres attendu est supérieur au nombre de paramètres passés dans la route');
            }
        }

        public function getRequest(){
            return $this->_httpRequest;
        }

        public function getCurrentController(){
            return $this->_currentController;
        }

        public function getConfig(){
            return $this->_config;
        }

        public function getHost(){
            return $this->_httpRequest->getHost();
        }

    }