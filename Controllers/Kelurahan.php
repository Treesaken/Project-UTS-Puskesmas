<?php
require_once 'Config/DB.php';

class Kelurahan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("SELECT kelurahan.*, kecamatan.nama AS nama_kecamatan 
FROM kelurahan 
JOIN kecamatan ON kelurahan.kecamatan_id = kecamatan.id
");
        return $stmt->fetchALL();
    }

    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM kelurahan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO kelurahan (nama, kecamatan_id) VALUES (?,?)");
        return $stmt->execute([
            $data['nama'],
            $data['kecamatan_id']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE kelurahan SET nama = ?, kecamatan_id = ? WHERE id=?");
        return $stmt->execute([
            $data['nama'],
            $data['kecamatan_id'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM kelurahan WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$kelurahan = new Kelurahan($pdo);