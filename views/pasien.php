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
                                    <label for="kode">Kode</label>
                                    <input type="text" name="kode" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
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
                                    <label for="gender">Jenis Kelamin</label>
                                    <select name="gender" class="form-control" id="">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="textarea" name="alamat" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="kelurahan_id">Kelurahan</label>
                                    <select name="kelurahan_id" class="form-control" id="">
                                    <option value="">-- Pilih Kelurahan --</option>
                                        <?php
                                        require_once("Controllers/Kelurahan.php");
                                        $kelurahan = new Kelurahan($pdo);
                                        $datakelurahan = $kelurahan->index();
                                        foreach ($datakelurahan as $kel) {
                                            echo '<option value="'.$kel['id'].'">'.$kel['nama'].'</option>';
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
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Kelurahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("Controllers/Pasien.php");
                    $row = $pasien->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $item['kode'] ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['tmp_lahir'] ?></td>
                            <td><?= $item['tgl_lahir'] ?></td>
                            <td><?= $item['gender'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td><?= $item['alamat'] ?></td>
                            <td><?= $item['nama_kelurahan'] ?></td>
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
                                            <label for="nidn">NIDN</label>
                                            <input type="text" name="nidn" class="form-control" value="<?= $item['nidn'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control" value="<?= $item['nama'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gelar_belakang">Gelar Belakang</label>
                                            <input type="text" name="gelar_belakang" class="form-control" value="<?= $item['gelar_belakang'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gelar_depan">Gelar Depan</label>
                                            <input type="text" name="gelar_depan" class="form-control" value="<?= $item['gelar_depan'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <input type="text" name="jenis_kelamin" class="form-control" value="<?= $item['jenis_kelamin'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control" value="<?= $item['tempat_lahir'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $item['tanggal_lahir'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" value="<?= $item['alamat'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?= $item['email'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_masuk">Tahun Masuk</label>
                                            <input type="number" name="tahun_masuk" class="form-control" value="<?= $item['tahun_masuk'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="prodi_id">Program Studi</label>
                                            <input type="text" name="prodi_id" class="form-control" value="<?= $item['prodi_id'] ?>" required>
                                        </div>
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
                            $pasien->delete($_POST['id']);
                            echo '<script>alert("hapus berhasil")</script><meta http-equiv="refresh" content="0; url=?url=pasien">';
                        } elseif ($_POST['type'] == "tambah") {
                            $data = [
                                'kode' => $_POST['kode'],
                                'nama' => $_POST['nama'],
                                'tmp_lahir' => $_POST['tmp_lahir'],
                                'tgl_lahir' => $_POST['tgl_lahir'],
                                'gender' => $_POST['gender'],
                                'email' => $_POST['email'],
                                'alamat' => $_POST['alamat'],
                                'kelurahan_id' => $_POST['kelurahan_id'],
                            ];
                            $pasien->create($data);
                            echo '<script>alert("tambah berhasil")</script><meta http-equiv="refresh" content="0; url=?url=pasien">';
                        } elseif ($_POST['type'] == "update") {
                            $data = [
                                'kode' => $_POST['kode'],
                                'nama' => $_POST['nama'],
                                'tmp_lahir' => $_POST['tmp_lahir'],
                                'tgl_lahir' => $_POST['tgl_lahir'],
                                'gender' => $_POST['gender'],
                                'email' => $_POST['email'],
                                'alamat' => $_POST['alamat'],
                                'kelurahan_id' => $_POST['kelurahan_id'],
                            ];
                            $pasien->update($_POST['id'], $data);
                            echo '<script>alert("update berhasil")</script><meta http-equiv="refresh" content="0; url=?url=pasien">';
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

