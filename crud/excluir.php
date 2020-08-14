<?php
require 'config.php';
require 'dao/ContatoDaoMysql.php';

$contatoDao = new ContatoDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');
if($id) {
    $contatoDao->delete($id);
}

header("Location: index.php");
exit;