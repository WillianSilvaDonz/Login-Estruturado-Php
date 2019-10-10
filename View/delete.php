<?php 
    include('../controller/UsuarioControllers.php');
    if(isset($_GET['id'])){
        $telas = new UsuarioController();
        $dados = $telas->delete($_GET['id']);
    }
?>