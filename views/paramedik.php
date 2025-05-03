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
                                    <label for="nama">Nama Dokter</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select name="gender" class="form-control" id="">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tmp_lahir">Tempat Lahir</label>
                                    <input type="text" name="tmp_lahir" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <input type="text" name="kategori" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="telpon">Telpon</label>
                                    <input type="number" name="telpon" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="textarea" name="alamat" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="unit_kerja_id">Unit Kerja</label>
                                    <select name="unit_kerja_id" class="form-control" id="">
                                    <option value="">-- Pilih Unit Kerja --</option>
                                        <?php
                                        require_once("Controllers/UnitKerja.php");
                                        $unit_kerja = new UnitKerja($pdo);
                                        $dataunitkerja = $unit_kerja->index();
                                        foreach ($dataunitkerja as $unitkerja) {
                                            echo '<option value="'.$unitkerja['id'].'">'.$unitkerja['nama'].'</option>';
                                        }
                                        ?>
                                    </select>
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
                        <th>Nama Dokter</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Kategori</th>
                        <th>Telpon</th>
                        <th>Alamat</th>
                        <th>Unit Kerja</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("Controllers/Paramedik.php");
                    $row = $paramedik->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['gender'] ?></td>
                            <td><?= $item['tmp_lahir'] ?></td>
                            <td><?= $item['tgl_lahir'] ?></td>
                            <td><?= $item['kategori'] ?></td>
                            <td><?= $item['telpon'] ?></td>
                            <td><?= $item['alamat'] ?></td>
                            <td><?= $item['unit_kerja_id'] ?></td>
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
                                        <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control" value="<?= $item['nama'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Jenis Kelamin</label>
                                            <input type="text" name="gender" class="form-control" value="<?= $item['gender'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tmp_lahir">Tempat Lahir</label>
                                            <input type="text" name="tmp_lahir" class="form-control" value="<?= $item['tmp_lahir'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control" value="<?= $item['tgl_lahir'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" name="kategori" class="form-control" value="<?= $item['kategori'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telpon">No. Telpon</label>
                                            <input type="number" name="telpon" class="form-control" value="<?= $item['telpon'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" value="<?= $item['alamat'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="unit_kerja_id">Unit Kerja</label>
                                            <select name="unit_kerja_id" class="form-control" id="">
                                                <option value="">-- Pilih Unit Kerja --</option>
                                                <?php
                                                require_once("Controllers/UnitKerja.php");
                                                $unit_kerja = new UnitKerja($pdo);
                                                $dataunitkerja = $unit_kerja->index();
                                                foreach ($dataunitkerja as $unitkerja) {
                                                    echo '<option value="'.$unitkerja['id'].'" '.($item['unit_kerja_id'] == $unitkerja['id'] ? 'selected' : '').'>'.$unitkerja['nama'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
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
                            $paramedik->delete($_POST['id']);
                            echo '<script>alert("hapus berhasil")</script><meta http-equiv="refresh" content="0; url=?url=paramedik">';
                        } elseif ($_POST['type'] == "tambah") {
                            $data = [
                                'nama' => $_POST['nama'],
                                'gender' => $_POST['gender'],
                                'tmp_lahir' => $_POST['tmp_lahir'],
                                'tgl_lahir' => $_POST['tgl_lahir'],
                                'kategori' => $_POST['kategori'],
                                'telpon' => $_POST['telpon'],
                                'alamat' => $_POST['alamat'],
                                'unit_kerja_id' => $_POST['unit_kerja_id'],
                            ];
                            $paramedik->create($data);
                            echo '<script>alert("tambah berhasil")</script><meta http-equiv="refresh" content="0; url=?url=paramedik">';
                        } elseif ($_POST['type'] == "update") {
                            $data = [
                                'nama' => $_POST['nama'],
                                'gender' => $_POST['gender'],
                                'tmp_lahir' => $_POST['tmp_lahir'],
                                'tgl_lahir' => $_POST['tgl_lahir'],
                                'kategori' => $_POST['kategori'],
                                'telpon' => $_POST['telpon'],
                                'alamat' => $_POST['alamat'],
                                'unit_kerja_id' => $_POST['unit_kerja_id'],
                            ];
                            $paramedik->update($_POST['id'], $data);
                            echo '<script>alert("update berhasil")</script><meta http-equiv="refresh" content="0; url=?url=paramedik">';
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

