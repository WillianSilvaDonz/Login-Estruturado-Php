<?php 
    include('../controller/UsuarioControllers.php');
    if(isset($_POST['nome'])){
        $telas = new UsuarioController();
        $_POST['perfil'] = "admin";
        $telas->store($_POST);
    }else{
        include('../controller/StartupControllers.php'); 
        $telas = new StartupController();
        $telas->login("cadastro");
    }
    include('header.php'); 
?>
<form class="form-signin" method="POST" >
    <img class="mb-4" src="/assets/img/logo-trans-nova.png" alt="Brazilian Teste" width="100%" height="72">
    <h1 class="h3 mb-3 font-weight-normal text-center text-white">Cadastra - Se</h1>
    <?php echo isset($_SESSION['erro']['todo']) ? '<h4 class="text-danger">'.$_SESSION['erro']['todo'].'</h4>' : ''; ?>
    <label for="inputEmail" class="sr-only">Nome</label>
    <input type="text" id="inputEmail" class="form-control" name="nome" placeholder="Nome" autofocus="" required="" >
    <?php echo isset($_SESSION['erro']['nome']) ? '<span class="text-danger">'.$_SESSION['erro']['nome'].'</span>' : ''; ?>
    <label for="inputEmail" class="sr-only">E-mail</label>
    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="E-mail" autofocus="" required="" >
    <?php echo isset($_SESSION['erro']['email']) ? '<span class="text-danger">'.$_SESSION['erro']['email'].'</span>' : ''; ?>
    <label for="inputPassword" class="sr-only">Senha</label>
    <input type="password" id="inputPassword" class="form-control" name="senha" placeholder="Senha" required="" >
    <?php echo isset($_SESSION['erro']['senha']) ? '<span class="text-danger">'.$_SESSION['erro']['senha'].'</span>' : ''; ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>
    <p class="mt-5 mb-3 text-muted">© 2019-2019</p>
</form>

<?php include('footer.php'); ?>