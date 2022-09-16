<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="card col-md">

                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">DETAIL KARYAWAN</h1>
                                    <?= $this->session->flashdata('message') ?>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <section class="content">
                        <?php
                        $i = 0;
                        foreach ($karyawan->result_array() as $key) {
                        ?>
                            <form action="<?= base_url('monitoring/update_karyawan_') ?>" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">NRP</label>
                                        <input type="text" class="form-control" id="nrp" name="nrp" value=<?= $key['nrp'] ?>>
                                        <?= form_error('nrp', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">NAMA</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $key['nama'] ?>">
                                        <input type="text" class="form-control" id="id" name="id" value=<?= $key['id'] ?> hidden>
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">EMAIL</label>
                                        <input type="text" class="form-control" id="email" name="email" value=<?= $key['email'] ?>>
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">ID KARTU</label>
                                        <input type="text" class="form-control" id="idKaryawan" name="idKaryawan" value=<?= $key['id_karyawan'] ?> disabled>
                                        <?= form_error('idKaryawan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">DEPARTEMEN</label>
                                        <select class="custom-select" id="departemen" name="departemen">
                                            <?php
                                            foreach ($departemen->result_array() as $key) {
                                            ?>
                                                <option value="<?= $key['departemen_id'] ?>"><?= $key['nama'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <?= form_error('departemen', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>

                                <input type="submit" value="Perbarui" class="btn btn-primary">
                            </form>
                        <?php
                        }
                        ?>
                        <!-- /.content-wrapper -->

                        <!-- Control Sidebar -->
                        <aside class="control-sidebar control-sidebar-dark">
                            <!-- Control sidebar content goes here -->
                        </aside>
                        <!-- /.control-sidebar -->
                </div>
            </div>

        </div>
</section>