<?php

require_once("config.php");


/*Carrega um usuario pelo ID
$user = new Usuario();
$user->loadByID(2);
echo $user;
*/


/*Carrega uma lista de usuarios
getList não usa nenhum atributo (não tem nenhum $this no metodo) então podemos fazer dele um metodo estatico colocando static após colocar public para que possamos acessar ele sem instanciar a classe
$lista = Usuario::getList();
echo json_encode($lista);
*/


/*
Carrega uma lista de usuarios buscando pelo login
$search = Usuario::search("fre");
echo json_encode($search);
*/


/*
Carrega um usuario usando login e senha
$user = new Usuario();
$user->login("Fred","qwert");
echo $user;
*/


/*
Cria um novo usuario
$pessoa = new Usuario("pessoa","p3ss0@");
$pessoa->insert();
echo $pessoa;
*/


/*
Altera um usuario
$user = new Usuario();
$user->loadById(1);
$user->update("novologin","novasenha");
echo $user;
*/


/*
Deletar usuario da tabela
$user = new Usuario();
$user->loadById(1);
$user->delete();
echo $user;
echo user mostrara como ficara o usuario após excluirmos ele
*/

?>