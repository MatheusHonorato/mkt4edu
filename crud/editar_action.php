<?php
require 'config.php';
require 'dao/ContatoDaoMysql.php';

$contatoDao = new ContatoDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$celular = filter_input(INPUT_POST, 'celular');

if($id && $nome && $email) {
    $contato = new Contato();
    $contato->setId($id);
    $contato->setNome($nome);
    $contato->setEmail($email);
    $contato->setCelular($celular);

    $contatoDao->update( $contato );

    header("Location: index.php");
    exit;
    
} else {
    header("Location: editar.php?id=".$id);
    exit;
}