<?php
require_once 'Config/DB.php';

class Kecamatan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("SELECT * FROM kecamatan");
        return $stmt->fetchALL();
    }

    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM kecamatan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO kecamatan (nama) VALUES (?)");
        return $stmt->execute([
            $data['nama']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE kecamatan SET nama = ? WHERE id=?");
        return $stmt->execute([
            $data['nama'],
            $id 
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM kecamatan WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$kecamatan = new Kecamatan($pdo);
