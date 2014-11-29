<?php
    namespace Models;

    use Models\DAO;

    class Utils {

        /**
         * @param       $object
         * @param array $params
         */
        public static function hydrate($object, array $params){
            foreach($params as $key => $val){
                $methodName = 'set'.ucfirst($key);
                try{
                    if(method_exists($object,$methodName)){
                        $object->$methodName($val);
                    }
                } catch(\InvalidArgumentException $e){
                    $object->addError($e->getMessage());
                }
            }

        }



        public static function isDate($str) {
            $valid =false;
            if (substr_count($str, '/') == 2) {
                list($d, $m, $y) = explode('/', $str);
                $valid = checkdate($m, $d, sprintf('%04u', $y));
            }

            return $valid;
        }

        public static function isValidMd5($md5 ='') {
            return strlen($md5) == 32 && ctype_xdigit($md5);
        }

    }