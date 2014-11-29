<?php
    namespace Framework;

    class Router
    {
        private $_controller = 'Default';
        private $_action = 'index';
        private $_actionParams = [];
        private $_path;
        private $_controllersPath;

        public function __construct(HttpRequest $request) {
            $this->_path= $request->getPath();
            $this->_controllersPath = ROOT_PATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR;
            $this->dispatch();
        }

        private function setController(){
            if(count($this->_path)>0 && ! empty($this->_path[0])){
                $controllerFile = $this->_controllersPath.ucfirst($this->_path[0]).'Controller.php';
                if(file_exists($controllerFile)){
                    $this->_controller = $this->_path[0];
                    array_shift($this->_path);
                }
            }

        }

        private function setAction(){
            if(count($this->_path)>0 && ! empty($this->_path[0]) ){
                $this->_action = $this->_path[0];
                array_shift($this->_path);
            }

        }

        private function setParameters(){
            if(count($this->_path)>0 && ! empty($this->_path[0])){
                $this->_actionParams = $this->_path;
            }
        }

        private function dispatch(){
            $this->setController();
            $this->setAction();
            $this->setParameters();
        }


        public function getController(){
            return ucfirst($this->_controller).'Controller';
        }

        public function getAction(){
            return $this->_action.'Action';
        }

        public function getParams(){
            return $this->_actionParams;
        }



    }