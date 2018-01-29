<?php
    class Produit {
        private $_idProduit;
        private $_nom;
        private $_prix;
        private $_promotion;
        private $_stock;
        private $_description;
        private $_categorie;
        private $_etat;
        
        /**
         * @return mixed
         */
        public function getIdProduit()
        {
            return $this->_idProduit;
        }
    
        /**
         * @return mixed
         */
        public function getNom()
        {
            return $this->_nom;
        }
    
        /**
         * @return mixed
         */
        public function getPrix()
        {
            return $this->_prix;
        }
    
        /**
         * @return mixed
         */
        public function getPromotion()
        {
            return $this->_promotion;
        }
    
        /**
         * @return mixed
         */
        public function getStock()
        {
            return $this->_stock;
        }
    
        /**
         * @return mixed
         */
        public function getDescription()
        {
            return $this->_description;
        }
    
        /**
         * @return mixed
         */
        public function getCategorie()
        {
            return $this->_categorie;
        }
    
        /**
         * @return mixed
         */
        public function getEtat()
        {
            return $this->_etat;
        }
    
        /**
         * @param mixed $_idProduit
         */
        public function setIdProduit($_idProduit)
        {
            $this->_idProduit = $_idProduit;
        }
    
        /**
         * @param mixed $_nom
         */
        public function setNom($_nom)
        {
            $this->_nom = $_nom;
        }
    
        /**
         * @param mixed $_prix
         */
        public function setPrix($_prix)
        {
            $this->_prix = $_prix;
        }
    
        /**
         * @param mixed $_promotion
         */
        public function setPromotion($_promotion)
        {
            $this->_promotion = $_promotion;
        }
    
        /**
         * @param mixed $_stock
         */
        public function setStock($_stock)
        {
            $this->_stock = $_stock;
        }
    
        /**
         * @param mixed $_description
         */
        public function setDescription($_description)
        {
            $this->_description = $_description;
        }
    
        /**
         * @param mixed $_categorie
         */
        public function setCategorie($_categorie)
        {
            $this->_categorie = $_categorie;
        }
    
        /**
         * @param mixed $_etat
         */
        public function setEtat($_etat)
        {
            $this->_etat = $_etat;
        }
    }
?>