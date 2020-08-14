<?php
require_once 'models/Contato.php';

class ContatoDaoMysql implements ContatoDAO {
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function add(Contato $contato) {
        
        $sql = $this->pdo->prepare("INSERT INTO contatos (nome, email, celular) VALUES (:nome, :email, :celular)");
        $sql->bindValue(':nome', $contato->getNome());
        $sql->bindValue(':email', $contato->getEmail());
        $sql->bindValue(':celular', $contato->getCelular());
        $sql->execute();

        return $contato;
    }

    public function findAll() {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM contatos");
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach($data as $item) {
                $contato = new Contato();
                $contato->setId($item['id']);
                $contato->setNome($item['nome']);
                $contato->setEmail($item['email']);
                $contato->setCelular($item['celular']);

                $array[] = $contato;
            }
        }

        return $array;
    }

    public function findByEmail($email) {
        $sql = $this->pdo->prepare("SELECT * FROM contatos WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $contato = new Contato();
            $contato->setId($data['id']);
            $contato->setNome($data['nome']);
            $contato->setEmail($data['email']);
            $contato->setCelular($data['celular']);

            return $contato;
        } else {
            return false;
        }
    }


    public function findById($id) {
        $sql = $this->pdo->prepare("SELECT * FROM contatos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $contato = new Contato();
            $contato->setId($data['id']);
            $contato->setNome($data['nome']);
            $contato->setEmail($data['email']);
            $contato->setCelular($data['celular']);

            return $contato;
        } else {
            return false;
        }
    }

    public function update(Contato $contato) {
        $sql = $this->pdo->prepare("UPDATE contatos SET nome = :nome, email = :email, celular = :celular WHERE id = :id");
        $sql->bindValue(':nome', $contato->getNome());
        $sql->bindValue(':email', $contato->getEmail());
        $sql->bindValue(':celular', $contato->getCelular());
        $sql->bindValue(':id', $contato->getId());
        $sql->execute();

        return true;
    }

    public function delete($id) {
        $sql = $this->pdo->prepare("DELETE FROM contatos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}