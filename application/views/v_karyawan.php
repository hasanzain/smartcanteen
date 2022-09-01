<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-primary">DAFTAR KARYAWAN</h1>
                    <?= $this->session->flashdata('message') ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="card col-md">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card col-md">
                            <div class="row">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID KARYAWAN</th>
                                            <th scope="col">NAMA</th>
                                            <th scope="col">E-MAIL</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $status = "";
                                        foreach ($karyawan->result_array() as $key) {
                                            if ($key['status'] == "1") {
                                                $status = "Terbuka";
                                            } else {
                                                $status = "Terkunci";
                                            }
                                        ?>
                                            <tr>
                                                <th scope="row"><?= $i++ ?></th>
                                                <td><?= $key['id_karyawan'] ?></td>
                                                <td><?= $key['nama'] ?></td>
                                                <td><?= $key['email'] ?></td>
                                                <td><?= $status ?></td>
                                                <td>
                                                    <a href="<?= base_url('monitoring/update_status?id=') . $key['id'] ?>">
                                                        <button type="button" class="btn btn-warning">Buka/Tutup</button>
                                                    </a>
                                                    <a href="<?= base_url('monitoring/update_karyawan?id=') . $key['id'] ?>">
                                                        <button type="button" class="btn btn-success">Lihat</button>
                                                    </a>
                                                    <a href="<?= base_url('monitoring/delete_user?id=') . $key['id'] ?>">
                                                        <button type="button" class="btn btn-danger">Hapus</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>


                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.content-wrapper -->
    </section>




    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-secondary">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->