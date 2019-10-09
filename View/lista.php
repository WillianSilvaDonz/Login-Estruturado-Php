<?php 
    include('../controller/UsuarioControllers.php'); 
    $telas = new UsuarioController();
    $dados = $telas->lista();
    $usuario = $telas->getUsuario($_COOKIE['lembreCard']);
    include('header.php'); 
?>
<div class="container">
    <div class="row">
        <div class="col-8 text-left">
            <img class="mb-4" src="/assets/img/logo-trans-nova.png" alt="Brazilian Teste" height="72">
        </div>
        <div class="col-4 text-right" style="display: flex;align-items: center;" >
            <span class="text-white font-weight-bold" style="margin-left: 60%;"><?php echo "Bem Vindo ".$usuario->nome; ?></span>
        </div>
        <br/>
        <br/>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class='col-4'>
                    <a href="editar.php" class="btn btn-success float-left"><i class="fas fa-plus-circle"></i> Novo</a>
                </div>
                <div class='col-4'>
                    <h1 class="text-white text-center">Listar Usuarios</h1>
                </div>
                <div class='col-4'>
                    <a href="logout.php" class="btn btn-danger float-right"><i class="fas fa-plus-circle"></i> Sair</a>
                </div>
            </div>
            <table class="table table-striped text-white">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Perfil</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php if($dados){ ?>
                    <?php foreach($dados as $key => $value){ ?>
                        <tr>
                            <td scope="col"><?php echo $value->id; ?></td>
                            <td scope="col"><?php echo $value->nome; ?></td>
                            <td scope="col"><?php echo $value->email; ?></td>
                            <td scope="col"><?php echo ucfirst($value->perfil); ?></td>
                            <td scope="col">
                                <a href="editar.php?codigo=<?php echo $value->id; ?>" class="btn btn-info" >
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr>
                        <td colspan="4">Nenhum Resultado</td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>