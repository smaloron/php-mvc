<?php
namespace Models\DAO;


class DifficulteDAO extends DAO{
    const SELECT_ALL_SQL = "SELECT * FROM difficulte;";
    const SELECT_BY_ID_SQL = "SELECT * FROM difficulte WHERE difficulte_id=:id;";

    public function getAll() {
        $recordSet = $this->executeQuery(self::SELECT_ALL_SQL, []);
        return $recordSet;
    }

    public function getById($id) {
        $recordSet = $this->executeQuery(self::SELECT_BY_ID_SQL, ['id' => $id]);
        return $recordSet;
    }

    public function difficulteExists($id){
        return count($this->getById($id))>0;
    }




} 