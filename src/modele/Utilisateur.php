<?php 
    class Utilisateur {
        private $_pseudo;
        private $_mail;
        private $_mdp;
        private $_nom;
        private $_prenom;
        private $_naissance;
        private $_adresse;
        private $_codePostal;
        private $_ville;
        private $_role;
        private $_supprime;
        
        /**
         * @return mixed
         */
        public function getPseudo()
        {
            return $this->_pseudo;
        }
    
        /**
         * @return mixed
         */
        public function getMail()
        {
            return $this->_mail;
        }
    
        /**
         * @return mixed
         */
        public function getMdp()
        {
            return $this->_mdp;
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
        public function getPrenom()
        {
            return $this->_prenom;
        }
    
        /**
         * @return mixed
         */
        public function getNaissance()
        {
            return $this->_naissance;
        }
    
        /**
         * @return mixed
         */
        public function getAdresse()
        {
            return $this->_adresse;
        }
    
        /**
         * @return mixed
         */
        public function getCodePostal()
        {
            return $this->_codePostal;
        }
    
        /**
         * @return mixed
         */
        public function getVille()
        {
            return $this->_ville;
        }
    
        /**
         * @return mixed
         */
        public function getRole()
        {
            return $this->_role;
        }
    
        /**
         * @return mixed
         */
        public function getSupprime()
        {
            return $this->_supprime;
        }
    
        /**
         * @param mixed $_pseudo
         */
        public function setPseudo($_pseudo)
        {
            $this->_pseudo = $_pseudo;
        }
    
        /**
         * @param mixed $_mail
         */
        public function setMail($_mail)
        {
            $this->_mail = $_mail;
        }
    
        /**
         * @param mixed $_mdp
         */
        public function setMdp($_mdp)
        {
            $this->_mdp = $_mdp;
        }
    
        /**
         * @param mixed $_nom
         */
        public function setNom($_nom)
        {
            $this->_nom = $_nom;
        }
    
        /**
         * @param mixed $_prenom
         */
        public function setPrenom($_prenom)
        {
            $this->_prenom = $_prenom;
        }
    
        /**
         * @param mixed $_naissance
         */
        public function setNaissance($_naissance)
        {
            $this->_naissance = $_naissance;
        }
    
        /**
         * @param mixed $_adresse
         */
        public function setAdresse($_adresse)
        {
            $this->_adresse = $_adresse;
        }
    
        /**
         * @param mixed $_codePostal
         */
        public function setCodePostal($_codePostal)
        {
            $this->_codePostal = $_codePostal;
        }
    
        /**
         * @param mixed $_ville
         */
        public function setVille($_ville)
        {
            $this->_ville = $_ville;
        }
    
        /**
         * @param mixed $_role
         */
        public function setRole($_role)
        {
            $this->_role = $_role;
        }
    
        /**
         * @param mixed $_supprime
         */
        public function setSupprime($_supprime)
        {
            $this->_supprime = $_supprime;
        }
    }
?>