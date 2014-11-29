<?php

    namespace Framework;

    /**
     * Class HttpRequest
     * @package Framework
     *          Cette classe représente une requête http
     *          Elle peuple les différentes collections (POST, GET ...)
     *          et fournit des méthodes pour interroger les variables d'environnement
     *
     */
    class HttpRequest
    {

        /**
         * @var HttpCollection
         */
        private $_post;
        /**
         * @var HttpCollection
         */
        private $_get;
        /**
         * @var HttpCollection
         */
        private $_session;
        /**
         * @var HttpCollection
         */
        private $_cookie;

        /**
         * @var string
         */
        private $_url;
        /**
         * @var array
         */
        private $_path;
        /**
         * @var string
         */
        private $_host;

        function __construct() {
            $this->_post    = new HttpCollection($_POST, 'POST');
            $this->_get     = new HttpCollection($_GET, 'GET');
            $this->_session = new HttpCollection($_SESSION, 'SESSION');
            $this->_cookie  = new HttpCollection($_COOKIE, 'COOKIE');

            $this->_url  = $_REQUEST['url'];
            $this->_host = $_SERVER['HTTP_HOST'];
            $this->_path = $this->setPath($this->_url);
        }

        public function getURL() {
            return $this->_url;
        }

        public function getHost() {
            return $this->_host;
        }

        public function getMethod() {
            return $_SERVER['REQUEST_METHOD'];
        }

        public function getUrlParameters() {
            return $this->_get;
        }

        public function getPost() {
            return $this->_post;
        }

        public function getSession() {
            return $this->_session;
        }

        public function getCookie() {
            return $this->_cookie;
        }

        /**
         * retourne le chemin de l'url sous forme de tableau
         *
         * @param $url
         *
         * @return array
         *
         */
        private function setPath($url) {
            $path = trim($url, '/');
            return explode('/', $path);
        }

        public function getPath() {
            return $this->_path;
        }


    }