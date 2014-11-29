<?php
    namespace Models\DAO;

    use Framework\WebApplication;
    use Models;

    abstract class DAO
    {
        /**
         * @var PDO
         */
        protected $_db;

        public function __construct() {
            $this->_db = WebApplication::getApplication()->getConfig()['dataBase'];
        }

        /**
         * @param $sql
         * @param $params
         *
         * @return array|bool
         */
        public function executeQuery($sql, $params){
            $ret = false;
            try {
                $pdoStatement = $this->_db->prepare($sql);
                $success = $pdoStatement->execute($params);

                if(strtok($sql, " ") == "SELECT"){
                    $ret = $pdoStatement->fetchAll();
                } else {
                    $ret =  $success;
                }

            } catch(\PDOException $e){
                die($e->getMessage());
            }

            return $ret;
        }


    }