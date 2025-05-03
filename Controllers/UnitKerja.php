<?php
require_once 'Config/DB.php';

class UnitKerja
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("SELECT * FROM unit_kerja");
        return $stmt->fetchALL();
    }

    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM unit_kerja WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO unit_kerja (nama) VALUES (?)");
        return $stmt->execute([
            $data['nama']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE unit_kerja SET nama = ? WHERE id=?");
        return $stmt->execute([
            $data['nama'],
            $id 
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM unit_kerja WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$unit_kerja = new UnitKerja($pdo);
