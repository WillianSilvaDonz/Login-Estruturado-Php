<?php 
    if(isset($_POST['email'])){
        include('../controller/UsuarioControllers.php'); 
        $telas = new UsuarioController();
        $telas->verificarLogin($_POST);
    }else{
        include('../controller/StartupControllers.php'); 
        $telas = new StartupController();
        $telas->login("login");
        
    }
    include('header.php'); 
?>
<form class="form-signin" method="POST" >
    <img class="mb-4" src="/assets/img/logo-trans-nova.png" alt="Brazilian Teste" width="100%" height="72">
    <h1 class="h3 mb-3 font-weight-normal text-center text-white">Credenciais</h1>
    <?php echo isset($_SESSION['erro']['todo']) ? '<h4 class="text-danger">'.$_SESSION['erro']['todo'].'</h4>' : ''; ?>
    <label for="inputEmail" class="sr-only">E-mail</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="E-mail" value="<?php echo (isset($_POST['email'])? $_POST['email'] : "" ); ?>" name="email" autofocus="" >
    <label for="inputPassword" class="sr-only">Senha</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Senha" value="<?php echo (isset($_POST['senha'])? $_POST['senha'] : "" ); ?>" name="senha" >
    <div class="checkbox mb-3">
        <label class="text-white">
            <input type="checkbox" name="lembre" <?php echo (isset($_POST['lembre'])? "checked" : "" ); ?> value="lembre"> Lembre - Me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
    <p class="mt-5 mb-3 text-muted">© 2019-2019</p>
</form>

<?php include('footer.php'); ?>
