<?php

    namespace Framework;
    /**
     * Class View
     * @package Framework
     *          Cette classe représente une vue.
     *
     */
    class View
    {

        private $_viewFile;
        private $_layoutFile = 'layout';
        private $_viewPath;
        /**
         * @var WebApplication
         */
        private $_app;

        public function __construct($viewFile) {
            $this->_viewFile = $viewFile . '.php';
            $this->_viewPath = $this->getViewPath();
            $this->_app      = WebApplication::getApplication();
        }

        /**
         * @return string
         * Retourne le chemin où sont stockées les vues
         */
        private function getViewPath() {
            $path = ROOT_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR;
            return $path;
        }

        public function setLayout($layoutFile) {
            $this->_layoutFile = $layoutFile;
        }

        /**
         * @param array $data
         * Affiche le rendu html de la vue encapsulée dans un layout
         */
        public function render(array $data = []) {
            try {
                $data['baseUrl'] = 'http://'.$this->_app->getHost().'/';
                //Récupération du contenu html de la vue
                $viewConcent         = $this->renderPartial($this->_viewPath . $this->_viewFile, $data);

                //Application du layout à la vue
                $layoutPath          = $this->getViewPath() . 'layouts/' . $this->_layoutFile . '.php';
                $data['viewContent'] = $viewConcent;
                $data['siteTitle']   = $this->_app->getConfig()['siteTitle'];

                $response            = $this->renderPartial($layoutPath, $data);

                //Affichage de la vue complète
                echo $response;
                exit(0);

            } catch (\Exception $e) {
                die($e->getMessage());
            }
        }

        /**
         * @param string $file
         * @param array $data
         *
         * @return string
         * @throws \Exception
         *
         * Calcul un rendu partiel sur une vue ou un layout
         */
        private function renderPartial($file, $data) {
            //$content = '';
            if (file_exists($file)) {

                //Mise à disposition des données pour la vue
                extract($data);

                //Mise en cache du rendu html de la vue
                ob_start();
                include $file;
                $content = ob_get_clean();
            } else {
                throw new \Exception ("Le fichier " . $file . " n'existe pas");
            }
            //Retourne le contenu html calculé de la vue
            return $content;
        }


    }