<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">UPDATE JAM MAKAN</h1>
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
        <form action="<?= base_url('monitoring/update_jamMakan_') ?>" method="post">
            <?php
            $i = 0;
            foreach ($jam_makan->result_array() as $key) {
            ?>
                <div class="form">
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Jam</label>
                        <input type="text" class="form-control" id="jam" name="jam" value="<?= $key['jam'] ?>">
                        <input type="text" class="form-control" id="id" name="id" value="<?= $key['id'] ?>" hidden>
                        <?= form_error('jam', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">KETERANGAN</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $key['keterangan'] ?>" disabled>
                        <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </div>
            <?php
            }
            ?>

        </form>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->