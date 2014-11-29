<?php
namespace Models\DAO;


class CategorieDAO extends DAO{
    const SELECT_ALL_SQL = "SELECT * FROM categories;";
    const SELECT_BY_ID_SQL = "SELECT * FROM categories WHERE categorie_id=:id;";

    public function getAll() {
        $recordSet = $this->executeQuery(self::SELECT_ALL_SQL, []);
        return $recordSet;
    }

    public function getById($id) {
        $recordSet = $this->executeQuery(self::SELECT_BY_ID_SQL, ['id' => $id]);
        return $recordSet;
    }

    public function categorieExists($id){
        return count($this->getById($id))>0;
    }




} 