<?php


    namespace Models;


    use Framework\Models;
    use Models\DAO\CategorieDAO;
    use Models\DAO\DifficulteDAO;
    use Models\DAO\RecetteDAO;

    class RecetteModel extends Models
    {

        protected $_recette;
        protected $_description;
        protected $_categorie;
        protected $_difficulte;
        protected $_nbPersonnes;

        function __construct($params) {
            $this->init($params);
        }

        private function init($params) {
            $this->_errors = [];
            $this->_required_members = ['recette','description','categorie','difficulte','nbPersonnes'];
            $this->_allowedMembers = [
                'recette'=>true,
                'description'=>true,
                'categorie'=>true,
                'difficulte'=>true,
                'nbPersonnes'=>true
            ];
            Utils::hydrate($this, $params);
            try {
                if (!$this->hasErrors()) {
                    $this->validate();
                }
            } catch (\InvalidArgumentException $e) {
                $this->_errors[] = $e->getMessage();
            } catch (\Exception $e) {
                $this->_errors[] = $e->getMessage();
            }

        }

        protected function validate() {
            if ($this->areRequiredFieldsEmpty()) {
                throw new \Exception('certains champs requis sont vides');
            }
        }

        /**
         * @param $categorie
         *
         * @throws \Exception
         */
        public function setCategorie($categorie) {
            $categorieDAO = new CategorieDAO();
            if (is_numeric($categorie) && $categorieDAO->categorieExists($categorie)) {
                $this->_categorie = $categorie;
            } else {
                throw new \Exception('La catégorie est incorrect');
            }
        }

        /**
         * @param mixed $description
         */
        public function setDescription($description) {
            $this->_description = $description;
        }

        /**
         * @param $difficulte
         *
         * @throws \Exception
         */
        public function setDifficulte($difficulte) {
            $dao = new DifficulteDAO();
            if (is_numeric($difficulte) && $dao->difficulteExists($difficulte)) {
                $this->_difficulte = $difficulte;
            } else {
                throw new \Exception('La difficulté est incorrect');
            }

        }

        /**
         * @param $recette
         *
         * @throws \Exception
         */
        public function setRecette($recette) {
            if (!empty($recette)) {
                $this->_recette = $recette;
            } else {
                throw new \Exception('Le titre de la recette ne peut être vide');
            }

        }

        /**
         * @param $nbPersonne
         *
         * @throws \Exception
         */
        public function setNbPersonnes($nbPersonne) {
            if (is_numeric($nbPersonne)) {
                $this->_nbPersonnes = $nbPersonne;
            } else {
                throw new \Exception('Le nombre de personnes doit être numérique');
            }

        }

        public function save() {
            if (!$this->hasErrors()) {
                try {
                    $dao = new RecetteDAO();
                    $dao->create($this);
                } catch (\Exception $e) {
                    die($e->getMessage());
                }

            }
        }

        /**
         * @return mixed
         */
        public function getCategorie() {
            return $this->_categorie;
        }

        /**
         * @return mixed
         */
        public function getDescription() {
            return $this->_description;
        }

        /**
         * @return mixed
         */
        public function getDifficulte() {
            return $this->_difficulte;
        }

        /**
         * @return mixed
         */
        public function getNbPersonnes() {
            return $this->_nbPersonnes;
        }

        /**
         * @return mixed
         */
        public function getRecette() {
            return $this->_recette;
        }


    }