<?php 
    class Panier {
        private $_utilisateur;
        private $_produit;
        private $_quantite;
        private $_nom;
        private $_description;
        private $_prix;
        private $_promotion;
        
        /**
         * @return mixed
         */
        public function getUtilisateur()
        {
            return $this->_utilisateur;
        }
    
        /**
         * @return mixed
         */
        public function getProduit()
        {
            return $this->_produit;
        }
    
        /**
         * @return mixed
         */
        public function getQuantite()
        {
            return $this->_quantite;
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
        public function getDescription()
        {
            return $this->_description;
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
         * @param mixed $_utilisateur
         */
        public function setUtilisateur($_utilisateur)
        {
            $this->_utilisateur = $_utilisateur;
        }
    
        /**
         * @param mixed $_produit
         */
        public function setProduit($_produit)
        {
            $this->_produit = $_produit;
        }
    
        /**
         * @param mixed $_quantite
         */
        public function setQuantite($_quantite)
        {
            $this->_quantite = $_quantite;
        }
    
        /**
         * @param mixed $_nom
         */
        public function setNom($_nom)
        {
            $this->_nom = $_nom;
        }
    
        /**
         * @param mixed $_description
         */
        public function setDescription($_description)
        {
            $this->_description = $_description;
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
    }
?>