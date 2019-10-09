<?php 
    include('../controller/UsuarioControllers.php');
    if(isset($_POST['nome'])){
        $telas = new UsuarioController();
        $dados = $telas->store($_POST);
    }else{
        
        $telas = new UsuarioController();
        $dados = $telas->getUsuario(isset($_GET['codigo'])? $_GET['codigo'] : 0);
    }
    include('header.php'); 
?>
<form class="form-signin" method="POST" >
    <img class="mb-4" src="/assets/img/logo-trans-nova.png" alt="Brazilian Teste" width="100%" height="72">
    <h1 class="h3 mb-3 font-weight-normal text-center text-white">Editar</h1>
    <?php echo isset($dados) && is_array($dados) ? '<h4 class="text-danger">'.$dados['todo'].'</h4>' : ''; ?>
    <label for="inputEmail" class="sr-only">Nome</label>
    <input type="hidden" value="<?php echo isset($dados->id)? $dados->id : ''; ?>" name="id">
    <input type="text" id="inputEmail" class="form-control" name="nome" value="<?php echo isset($dados->nome)? $dados->nome : ''; ?>" placeholder="Nome" autofocus="" required="" >
    <?php echo isset($_SESSION['erro']['nome']) ? '<span class="text-danger">'.$_SESSION['erro']['nome'].'</span>' : ''; ?>
    <label for="inputEmail" class="sr-only">E-mail</label>
    <input type="email" id="inputEmail" class="form-control" name="email" value="<?php echo isset($dados->email)? $dados->email : ''; ?>" placeholder="E-mail" autofocus="" required="" >
    <?php echo isset($_SESSION['erro']['email']) ? '<span class="text-danger">'.$_SESSION['erro']['email'].'</span>' : ''; ?>
    <label for="inputPassword" class="sr-only">Perfil</label>
    <select name="perfil" class="custom-select form-control">
        <option <?php echo isset($dados->perfil) && $dados->perfil == "" ? 'selected' : ''; ?> >Selecione Perfil</option>
        <option <?php echo isset($dados->perfil) && $dados->perfil == "admin" ? 'selected' : ''; ?> value="admin">Admin</option>
        <option <?php echo isset($dados->perfil) && $dados->perfil == "usuario" ? 'selected' : ''; ?> value="usuario">Usuario</option>
    </select>
    <label for="inputPassword" class="sr-only">Senha</label>
    <input type="password" id="inputPassword" class="form-control" name="senha" placeholder="Senha" >
    <?php echo isset($_SESSION['erro']['senha']) ? '<span class="text-danger">'.$_SESSION['erro']['senha'].'</span>' : ''; ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Salvar</button>
    <a href="lista.php" class="btn btn-lg btn-warning btn-block">Voltar</a>
    <p class="mt-5 mb-3 text-muted">© 2019-2019</p>
</form>
<?php include('footer.php'); ?>