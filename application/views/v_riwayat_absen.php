<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-primary">RIWAYAT AKSES</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

            <form action="<?= base_url('monitoring/riwayat') ?>" method="POST">
                <div class="input-group mb-3 col-lg-5">
                    <span class="input-group-text">Filter</span>
                    <input type="text" class="form-control" placeholder="Nama" aria-label="Nama" name="nama">
                    <input type="date" class="form-control" name="tanggal">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                </div>
            </form>

            <form action="<?= base_url('monitoring/export_csv') ?>" method="POST">
                <div class="input-group mb-3 col-lg-5">
                    <span class="input-group-text">Filter</span>
                    <input type="text" class="form-control" placeholder="Nama" aria-label="Nama" name="nama">
                    <input type="date" class="form-control" name="tanggal">
                    <button class="btn btn-outline-success" type="submit" id="button-addon2">Export Data</button>
                </div>
            </form>
                

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
                                            <th scope="col">Nama</th>
                                            <th scope="col">PANGKAT</th>
                                            <th scope="col">FOTO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($absensi->result_array() as $key) {
                                        
                                            ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $key['nama'] ?></td>
                                            <td><?= $key['pangkat'] ?></td>
                                            <td><a href="<?= $key['foto_masuk'] ?>" target="_blank">Klik Disini!</a></td>
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