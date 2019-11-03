<?php
class Usuarios{
    private $pdo;
    private $id;
    private $permissoes;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function fazerLogin($email, $senha){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email",$email);
        $sql->bindValue(":senha",$senha);
        $sql->execute();
        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            $_SESSION['logado'] = $sql['id'];
            return true;
        }else{
            return false;
        }
    }
    public function setUsuarios($id){
        $this->id = $id;
        $sql = $this->pdo->prepare("SELECT * FROM USUARIOS WHERE id = ?");
        $sql->execute(array($id));
        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            $this->permissoes = explode(",",$sql['permissoes']);
        }
        
    }
    public function getPermissoes(){
        return $this->permissoes;
    }
    public function temPermissao($permissao){
        if(in_array($permissao, $this->permissoes)){
            return true;
        }else{
            return false;
        }
            
    }
}