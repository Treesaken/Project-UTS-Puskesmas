<div class="container">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Tambah Data
            </button>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Tambah Data </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="pasien_id">Nama Pasien</label>
                                    <select name="pasien_id" class="form-control" id="">
                                    <option value="">-- Pilih Pasien --</option>
                                        <?php
                                        require_once("Controllers/Pasien.php");
                                        $pasien = new Pasien($pdo);
                                        $datapasien = $pasien->index();
                                        foreach ($datapasien as $pasien) {
                                            echo '<option value="'.$pasien['id'].'">'.$pasien['nama'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="paramedik_id">Nama Dokter</label>
                                    <select name="paramedik_id" class="form-control" id="">
                                    <option value="">-- Pilih Dokter --</option>
                                        <?php
                                        require_once("Controllers/Paramedik.php");
                                        $paramedik = new Paramedik($pdo);
                                        $dataparamedik = $paramedik->index();
                                        foreach ($dataparamedik as $dokter) {
                                            echo '<option value="'.$dokter['id'].'">'.$dokter['nama'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Perika</label>
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="berat">Berat Badan</label>
                                    <input type="number" name="berat" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tinggi">Tinggi Badan</label>
                                    <input type="number" name="tinggi" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tensi">Tekanan Darah</label>
                                    <input type="text" name="tensi" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" required>
                                </div>
                                <input type="hidden" name="type" value="tambah">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Nama Dokter</th>
                        <th>Tanggal Periksa</th>
                        <th>Berat Badan</th>
                        <th>Tinggi Badan</th>
                        <th>Tekanan Darah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("Controllers/Periksa.php");
                    $row = $periksa->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $item['nama_pasien'] ?></td>
                            <td><?= $item['nama_paramedik'] ?></td>
                            <td><?= $item['tanggal'] ?></td>
                            <td><?= $item['berat'] ?></td>
                            <td><?= $item['tinggi'] ?></td>
                            <td><?= $item['tensi'] ?></td>
                            <td><?= $item['keterangan'] ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="submit" value="delete" class="btn btn-danger btn-sm">
                                </form>
                                <a href="?url=detail&id=<?= $item['id'] ?>" class="btn btn-info btn-sm">Show</a>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $item['id'] ?>">Edit</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-edit-<?= $item['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Form Edit Data </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post">
                                        <di class="modal-body">
                                        <div class="form-group">
                                            <label for="nama">Nama Pasien</label>
                                            <select name="pasien_id" class="form-control" id="">
                                            <option value="">-- Pilih Pasien --</option>
                                                <?php
                                                require_once("Controllers/Pasien.php");
                                                $pasien = new Pasien($pdo);
                                                $datapasien = $pasien->index();
                                                foreach ($datapasien as $pasien) {
                                                    echo '<option value="'.$pasien['id'].'" '.($item['pasien_id'] == $pasien['id'] ? 'selected' : '').'>'.$pasien['nama'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group"></div>
                                            <label for="paramedik_id">Nama Dokter</label>
                                            <select name="paramedik_id" class="form-control" id="">
                                            <option value="">-- Pilih Dokter --</option>
                                                <?php
                                                require_once("Controllers/Paramedik.php");
                                                $paramedik = new Paramedik($pdo);
                                                $dataparamedik = $paramedik->index();
                                                foreach ($dataparamedik as $dokter) {
                                                    echo '<option value="'.$dokter['id'].'">'.$dokter['nama'].'</option>';
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="type" value="update">
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    <?php
                    endforeach;
                    if (isset($_POST['type'])) {
                        if ($_POST['type'] == "delete") {
                            $periksa->delete($_POST['id']);
                            echo '<script>alert("hapus berhasil")</script><meta http-equiv="refresh" content="0; url=?url=periksa">';
                        } elseif ($_POST['type'] == "tambah") {
                            $data = [
                                'pasien_id' => $_POST['pasien_id'],
                                'paramedik_id' => $_POST['paramedik_id'],
                                'tanggal' => $_POST['tanggal'],
                                'berat' => $_POST['berat'],
                                'tinggi' => $_POST['tinggi'],
                                'tensi' => $_POST['tensi'],
                                'keterangan' => $_POST['keterangan'],
                            ];
                            $periksa->create($data);
                            echo '<script>alert("tambah berhasil")</script><meta http-equiv="refresh" content="0; url=?url=periksa">';
                        } elseif ($_POST['type'] == "update") {
                            $data = [
                                'pasien_id' => $_POST['pasien_id'],
                                'paramedik_id' => $_POST['paramedik_id'],
                                'tanggal' => $_POST['tanggal'],
                                'berat' => $_POST['berat'],
                                'tinggi' => $_POST['tinggi'],
                                'tensi' => $_POST['tensi'],
                                'keterangan' => $_POST['keterangan'],
                            ];
                            $periksa->update($_POST['id'], $data);
                            echo '<script>alert("update berhasil")</script><meta http-equiv="refresh" content="0; url=?url=periksa">';
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

