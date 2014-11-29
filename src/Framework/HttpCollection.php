<?php
    namespace Framework;
    session_start();

    /**
     * Class Collection
     * @package Framework
     *          Cette classe représente une collection telle que POST ou GET, elle sécurise les variables
     *          et fournit des fonctions de base pour manipuler cette collection.
     */
    class HttpCollection
    {
        /**
         * @var array
         */
        private $_collection = [];
        private $_collectionName;

        public function __construct($collection, $collectionName) {
            if (is_array($collection)) {
                $this->_collection     = $this->sanitizeCollection($collection);
                $this->_collectionName = $collectionName;
            }

        }

        /**
         * Sécurise les valeurs de la collection
         * @param $collection
         *
         * @return array
         */
        private function sanitizeCollection($collection) {
            return array_map(function ($value) {
                $value = filter_var($value, FILTER_SANITIZE_STRING);
                return $value;
            }, $collection);
        }

        public function getCollection() {
            return $this->_collection;
        }

        public function getData($key) {
            if ($this->hasKey($key)) {
                return $this->_collection[$key];
            } else {
                return null;
                //throw new \Exception('La clef ' . $key . ' est absente de la collection ' . $this->_collectionName);
            }
        }

        /**
         * Test si la collection possède une clef particulière
         * @param $key
         *
         * @return bool
         */
        public function hasKey($key) {
            return array_key_exists($key, $this->_collection);
        }

        /**
         * Test si la collection contient une série de clefs
         * @param array $keys
         *
         * @return bool
         */
        public function hasKeys(array $keys) {
            $found = true;

            foreach ($keys as $key) {
                $found = $this->hasKey($key);
            }
            return $found;
        }

        /**
         * Test si la collection contient des données
         * @return bool
         */
        public function hasData() {
            return count($this->_collection) > 0;
        }

        /**
         * Ajoute une paire clef/valeur à la collection
         * @param $key
         * @param $value
         */
        public function add($key, $value) {
            $value                              = filter_var($value, FILTER_SANITIZE_STRING);
            $this->_collection[$key]            = $value;
            $httpCollectionName                 = "_" . $this->_collectionName;
            $GLOBALS[$httpCollectionName][$key] = $value;
        }

    }