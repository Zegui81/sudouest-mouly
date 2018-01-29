<?php
    class Categorie {
        private $_code;
        private $_nom;
        
        /**
         * @return mixed
         */
        public function getCode()
        {
            return $this->_code;
        }
    
        /**
         * @return mixed
         */
        public function getNom()
        {
            return $this->_nom;
        }
    
        /**
         * @param mixed $_code
         */
        public function setCode($_code)
        {
            $this->_code = $_code;
        }
    
        /**
         * @param mixed $_nom
         */
        public function setNom($_nom)
        {
            $this->_nom = $_nom;
        }
    }
?>