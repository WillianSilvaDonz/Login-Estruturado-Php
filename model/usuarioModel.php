<?php 
    include_once '../config/conexao.php';
    class Usuario {

        private $id;
        private $nome;
        private $email;
        private $senha;
        private $perfil;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function setNome($nome){
            $this->nome = $nome;
            return $this;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setEmail($email){
            $this->email = $email;
            return $this;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setSenha($senha){
            $this->senha = $senha;
            return $this;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function getSaveSenha(){
            return password_hash($this->senha, PASSWORD_DEFAULT);
        }

        public function getPerfil(){
            return $this->perfil;
        }

        public function setPerfil($perfil){
            $this->perfil = $perfil;
            return $this;
        }
    }
?>