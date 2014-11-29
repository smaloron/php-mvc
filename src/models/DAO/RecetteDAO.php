<?php

    namespace Models\DAO;

    use Models\RecetteModel;

    class RecetteDAO extends DAO
    {

        const SELECT_ALL_SQL = "SELECT * FROM vue_recettes";
        CONST SELECT_BY_CATEGORIE_SQL = "SELECT * FROM recettes WHERE categorie_id=:categorie";
        const CREATE_SQL = "INSERT INTO recettes (recette, description, categorie_id, difficulte_id, nb_personnes)
                            VALUES (:recette, :description, :categorie, :difficulte, :nbPersonnes)";

        public function getAll() {
            $recordSet = $this->executeQuery(self::SELECT_ALL_SQL, []);

            return $recordSet;
        }

        public function getByCategorie($categorie) {
            $recordSet = $this->executeQuery(self::SELECT_BY_CATEGORIE_SQL, ['categorie' => $categorie]);

            return $recordSet;
        }

        public function create(RecetteModel $recette){
            $params = $recette->toArray();
            return $this->executeQuery(self::CREATE_SQL, $params);
        }





} 