<?php

class Usuario {
    //Te class Usuario talks with the class Sql

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario(){

        return $this->idusuario;
    }

    public function setIdusuario($value){

        $this->idusuario = $value;
    }

    public function getDeslogin(){

        return $this->deslogin;
    }

    public function setDeslogin($value){

        $this->deslogin = $value;
    }

    public function getDessenha(){

        return $this->dessenha;
    }

    public function setDessenha($value){

        $this->dessenha = $value;
    }

    public function getDtcadastro(){

        return $this->dtcadastro;
    }

    public function setDtcadastro($value){

        $this->dtcadastro = $value;
    }

    public function __construct($login="", $password=""){

        $this->setDeslogin($login);
        $this->setDessenha($password);
    }//Closing __construct

    public function setData($data){

        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }//Closing setData

    public function loadById($id){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ':ID'=>$id
        ));

        if (count($results) > 0 ) {
            $this->setData($results[0]);
        }

    }//closing loadById

    public static function getList(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario");
    }//Closing getList

    public static function search($login){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin Like :SEARCH ORDER BY deslogin", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }//Closing search

    public function __toString(){
        
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }//Closing __toString

    public function login ($login, $password){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ':LOGIN'=>$login,
            ':PASSWORD'=>$password
        ));

        if (count($results) > 0){

            $this->setData($results[0]);
        }
        else {

            throw new Exception("Login e/ou senha invalidos.");
        }
    }//Closing login

    public function insert(){

        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));

        if (count($results) > 0){

            $this->setData($results[0]);
        }
    }//Closing insert

    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()
        ));
    }//Closing update

    public function delete(){

        $sql = new Sql();

        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ':ID'=>$this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());
    }//Closing delete

}//End of class 

?>