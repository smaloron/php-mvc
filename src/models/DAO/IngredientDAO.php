<?php
namespace Models\DAO;


class IngredientDAO extends DAO{
    const SELECT_ALL_SQL = "SELECT * FROM ingredients;";
    const SELECT_BY_ID_SQL = "SELECT * FROM ingredients WHERE id=:id;";

    public function getAll() {
        $recordSet = $this->executeQuery(self::SELECT_ALL_SQL, []);
        return $recordSet;
    }

    public function getById($id) {
        $recordSet = $this->executeQuery(self::SELECT_BY_ID_SQL, ['id' => $id]);
        return $recordSet;
    }




} 