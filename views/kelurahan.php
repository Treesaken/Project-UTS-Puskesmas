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
                                    <label for="nama">Nama Kelurahan</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan_id">Kecamatan</label>
                                    <select name="kecamatan_id" class="form-control" id="">
                                        <option value="">-- Pilih Kecamatan --</option>
                                        <?php
                                        require_once("Controllers/Kecamatan.php");
                                        $kecamatan = new Kecamatan($pdo);
                                        $datakecamatan = $kecamatan->index();
                                        foreach ($datakecamatan as $kec) {
                                            echo '<option value="'.$kec['id'].'">'.$kec['nama'].'</option>';
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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelurahan</th>
                        <th>Kecamatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("Controllers/Kelurahan.php");
                    $row = $kelurahan->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['nama_kecamatan'] ?></td>
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
                                                <label for="kecamatan_id">Kecamatan</label>
                                                <select name="kecamatan_id" class="form-control" id="">
                                                    <option value="">-- Pilih Kecamatan --</option>
                                                    <?php
                                                    require_once("Controllers/Kecamatan.php");
                                                    $kecamatan = new Kecamatan($pdo);
                                                    $datakecamatan = $kecamatan->index();
                                                    foreach ($datakecamatan as $kec) {
                                                        echo '<option value="'.$kec['id'].'" '.($item['kecamatan_id'] == $kec['id'] ? 'selected' : '').'>'.$kec['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
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
                            $kelurahan->delete($_POST['id']);
                            echo '<script>alert("hapus berhasil")</script><meta http-equiv="refresh" content="0; url=?url=kelurahan">';
                        } elseif ($_POST['type'] == "tambah") {
                            $data = [
                                'nama' => $_POST['nama'],
                                'kecamatan_id' => $_POST['kecamatan_id'],
                            ];
                            $kelurahan->create($data);
                            echo '<script>alert("tambah berhasil")</script><meta http-equiv="refresh" content="0; url=?url=kelurahan">';
                        } elseif ($_POST['type'] == "update") {
                            $data = [
                                'nama' => $_POST['nama'],
                                'kecamatan_id' => $_POST['kecamatan_id'],
                            ];
                            $kelurahan->update($_POST['id'], $data);
                            echo '<script>alert("update berhasil")</script><meta http-equiv="refresh" content="0; url=?url=kelurahan">';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

