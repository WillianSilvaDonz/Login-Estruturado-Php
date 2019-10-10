<?php
include_once('../model/usuarioModel.php');
 
class UsuarioDAO {

    public $banco;
    public $usuario;

    public function __construct(){
        $this->banco = new conexao();
        $this->banco = $this->banco->con;
        $this->usuario = new Usuario();
    }

    public function save(){
        $this->banco->beginTransaction();
        try{
            if($this->usuario->getId() > 0){
                $filtroSenha = $this->usuario->getSenha() == "" ? " " : ", senha = :senha";
                $stmt = $this->banco->prepare("
                    UPDATE usuarios 
                        SET nome = :nome, 
                        email = :email,
                        perfil = :perfil
                        ".$filtroSenha." 
                        WHERE id = :id"); 
            }else{
                $stmt = $this->banco->prepare('INSERT INTO usuarios (nome, email, perfil, senha) VALUES (:nome, :email, :perfil, :senha)'); 
            }
            $stmt->bindValue(':nome', $this->usuario->getNome());
            $stmt->bindValue(':email', $this->usuario->getEmail());
            $stmt->bindValue(':perfil', $this->usuario->getPerfil());
            if($this->usuario->getSenha() != ""){
                $stmt->bindValue(':senha', $this->usuario->getSaveSenha());
            }
            if($this->usuario->getId() > 0){
                $stmt->bindValue(':id', $this->usuario->getId());
            }
            $stmt->execute();
            
            $this->banco->commit();
            return true;
        } catch (Exception $e) {
            $this->banco->rollback();
            echo $e->getMessage();
            exit();
        }
    }

    public function update($id){
        $this->banco->beginTransaction();
        try{
            $stmt = $this->banco->prepare(
                "UPDATE usuarios SET nome = ':nome', email = ':email', senha = ':senha' WHERE id = :id"
            );       
            $stmt->bindValue(':nome', $this->usuario->getNome());
            $stmt->bindValue(':email', $this->usuario->getEmail());

            $stmt->bindValue(':senha', $this->usuario->getSaveSenha());
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            $this->banco->commit();
        } catch (Exception $e) {
            $this->banco->rollback();
            echo $e->getMessage();
        }
    }

    public function delete($id){
        $this->banco->beginTransaction();
        try{
            $stmt = $this->banco->prepare(
                'DELETE FROM usuarios WHERE id = :id'
            );       
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            $this->banco->commit();
        } catch (Exception $e) {
            $this->banco->rollback();
            echo $e->getMessage();
        }
    }

    public function getAll(){
        try{
            $consulta = $this->banco->query("SELECT * FROM usuarios");
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getUsuario($id){
        try{
            $consultar = $this->banco->prepare(
                'SELECT * FROM usuarios WHERE id = :id'
            );
            $consultar->bindValue(':id', $id);
            $consultar->execute();
            return $consultar->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function validate($post){
        $erro = array();
        if($post){
            if(trim($post['nome']) == ''){
                $erro['nome'] = 'Campo Obrigatório!';
            }
            if(trim($post['email']) == ''){
                $erro['email'] = 'Campo Obrigatório!';
            }
            if(trim($post['perfil']) == ''){
                $erro['perfil'] = 'Campo Obrigatório!';
            }
            if(trim($post['senha']) == '' && (!isset($post['id']) || (isset($post['id']) && $post['id'] == ''))){
                $erro['senha'] = 'Campo Obrigatório!';
            }
        }else{
            $erro['todo'] = "Por favor preencha o formulario.";
        }

        return $erro;
    }

    public function validLogin(){
        try{
            $erro = array();
            if($this->usuario->getEmail() && $this->usuario->getSenha()){
                $consultar = $this->banco->prepare(
                    'SELECT * FROM usuarios WHERE email = :email'
                );
                $consultar->bindValue(':email', $this->usuario->getEmail());
                $consultar->execute();

                $dados = $consultar->fetch(PDO::FETCH_OBJ);
                
                if($dados != NULL && count($dados) > 0){
                    if($dados->senha && password_verify($this->usuario->getSenha(), $dados->senha)){
                        return $dados;
                    }else{
                        $erro['todo'] = 'Senha incorreta!';
                    }
                }else{
                    $erro['todo'] = 'Nenhuma conta encontrada';
                }

                return $erro;
            }else{
                $erro['todo'] = 'Por favor entre com suas credenciais!';
                return $erro;
            }
        } catch(Exception $e){
            echo $e->getMessage();
            exit();
        }
    }

    public function load($post){
        if(isset($post['id'])){
            $this->usuario->setId(intval($post['id']));
        }
        if(isset($post['nome'])){
            $this->usuario->setNome($post['nome']);
        }
        if(isset($post['email'])){
            $this->usuario->setEmail($post['email']);
        }
        if(isset($post['senha'])){
            $this->usuario->setSenha($post['senha']);
        }
        if(isset($post['perfil'])){
            $this->usuario->setPerfil($post['perfil']);
        }

    }
}