<?php 
    include_once('../dao/usuarioDAO.php');
    class StartupController{

        public $usuarioDao;

        public function __construct(){
            $this->usuarioDao = new UsuarioDAO();
        }

        public function index(){
            if(isset($_COOKIE['lembreCard'])){
                header('Location: lista.php');
            }
            $store = $this->usuarioDao->getAll();
            if(count($store) <= 0){
                header('Location: cadastro.php');
            }else{
                header('Location: login.php');
            }
        }

        public function login($page){
            if(isset($_COOKIE['lembreCard'])){
                header('Location: lista.php');
            }
            $store = $this->usuarioDao->getAll();
            
            if($store && count($store) > 0){
                if($page != "login"){
                    header('Location: login.php');
                }
            }else{
                if($page != "cadastro"){
                    header('Location: cadastro.php');
                }
            }
        }
    }
?>