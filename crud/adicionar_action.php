<?php
require 'config.php';
require 'dao/ContatoDaoMysql.php';

$contatoDao = new ContatoDaoMysql($pdo);

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$celular = filter_input(INPUT_POST, 'celular');

if($nome && $email) {

    if($contatoDao->findByEmail($email) === false) {
        $novoContato = new Contato();
        $novoContato->setNome($nome);
        $novoContato->setEmail($email);
        $novoContato->setCelular($celular);

        $contatoDao->add( $novoContato );

        header("Location: index.php");
        exit;
    } else {
        header("Location: adicionar.php");
        exit;
    }
} else {
    header("Location: adicionar.php");
    exit;
}