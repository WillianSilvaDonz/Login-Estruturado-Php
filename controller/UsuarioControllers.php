<?php 
    include_once('../dao/usuarioDAO.php');
    class UsuarioController{

        public $usuarioDao;

        public function __construct(){
            $this->usuarioDao = new UsuarioDAO();
        }

        public function lista(){
            if(!isset($_COOKIE['lembreCard'])){
                header('Location: login.php');
            }
            $retorno = $this->usuarioDao->getAll();
            return $retorno;
        }

        public function getUsuario($codigo){
            if(!isset($_COOKIE['lembreCard'])){
                header('Location: login.php');
            }
            $erro = array();
            if($codigo > 0){
                $dados = $this->usuarioDao->getUsuario($codigo);
                if($dados){
                    return $dados;
                }else{
                    $erro["todo"] = "Nenhum Usuario Encontrado!";
                    return $erro;
                }
            }
        }

        public function store($post){
            try{
                $this->usuarioDao->load($post);
                $erro = $this->usuarioDao->validate($post);
                
                if(count($erro) <= 0 && $this->usuarioDao->save()){
                    if(isset($post['id'])){
                        header('Location: lista.php');
                    }else{
                        header('Location: login.php');
                    }
                }else{
                    if(isset($post['id'])){
                        return $this->getUsuario(intval($post['id']));
                    }
                    $_SESSION['erro'] = $erro;
                    //header('Location: login.php');
                }
            }catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function verificarLogin($post){
            try{
                $this->usuarioDao->load($post);
                $dados = $this->usuarioDao->validLogin();
                
                if(is_array($dados) && isset($dados['todo'])){
                    $_SESSION['erro'] = $dados;
                }else if(isset($dados->id)){
                    if(isset($post['lembre'])){
                        setcookie("lembreCard", $dados->id, time()+432000);
                    }else{
                        setcookie("lembreCard", $dados->id, time()+300);
                    }
                    header('Location: lista.php');
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public function logout(){
            if(!isset($_COOKIE['lembreCard'])){
                header('Location: login.php');
            }else{
                unset($_COOKIE['lembreCard']);
                setcookie('lembreCard', '', time()-3600);
                header('Location: login.php');
            }
        }
    }
?>