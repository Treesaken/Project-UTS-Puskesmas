<?php
require_once 'Config/DB.php';

class Periksa
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("
SELECT periksa.*, pasien.nama AS nama_pasien, paramedik.nama AS nama_paramedik
FROM periksa 
JOIN pasien ON periksa.pasien_id = pasien.id
JOIN paramedik ON periksa.paramedik_id = paramedik.id
");
        return $stmt->fetchAll();
    }

    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM periksa WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO periksa (tanggal, berat, tinggi, tensi, keterangan, pasien_id, paramedik_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['tanggal'],
            $data['berat'],
            $data['tinggi'],
            $data['tensi'],
            $data['keterangan'],
            $data['pasien_id'],
            $data['paramedik_id']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE periksa SET tanggal = ?, berat = ?, tinggi = ?, tensi = ?, keterangan = ?, pasien_id = ?, paramedik_id = ? WHERE id = ?");
        return $stmt->execute([
            $data['tanggal'],
            $data['berat'],
            $data['tinggi'],
            $data['tensi'],
            $data['keterangan'],
            $data['pasien_id'],
            $data['paramedik_id'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM periksa WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$periksa = new Periksa($pdo);
