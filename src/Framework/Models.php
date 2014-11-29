<?php

namespace Framework;

abstract class Models {

    protected $_errors;

    protected $_allowedMembers;

    protected $_required_members;

    /**********************************************************
     * ERRORS
     **********************************************************/
    public function addError($error){
        $this->_errors[] = $error;
    }
    /**
     * @return array
     */
    public function getErrors() {
        return $this->_errors;
    }

    /**
     * @return bool
     */
    public function hasErrors() {
        return count($this->_errors) > 0;
    }

    public function toArray(){
        $members =  get_object_vars($this);
        foreach ($members as $key => $value) {
            $members[ltrim($key, '_')] = $value;
        }
        $members = array_intersect_key($members, $this->_allowedMembers);
        return $members;
    }

    protected abstract function validate();

    protected function areRequiredFieldsEmpty() {
        $empty = false;
        foreach($this->_required_members as $member){
            $method = 'get'.ucfirst($member);
            $value = $this->$method();
            $empty = $empty && empty($value);
        }
        return $empty;
    }

} 