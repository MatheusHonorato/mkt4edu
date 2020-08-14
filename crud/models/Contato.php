<?php
class Contato {
    private $id;
    private $nome;
    private $email;
    private $celular;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = trim($id);
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = ucwords(trim($nome));
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = strtolower(trim($email));
    }
    public function getCelular() {
        return $this->celular;
    }
    public function setCelular($celular) {
        $this->celular = strtolower(trim($celular));
    }
}

interface ContatoDAO {
    public function add(Contato $contato);
    public function findAll();
    public function findByEmail($email);
    public function findById($id);
    public function update(Contato $contato);
    public function delete($id);
}