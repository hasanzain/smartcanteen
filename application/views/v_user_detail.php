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
                                    <h1 class="m-0 text-dark">Detail User</h1>
                                    <?= $this->session->flashdata('message')?>
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
            $i=0;
            foreach ($user->result_array() as $key) {
            ?>
                        <form action="<?= base_url('monitoring/update_user_') ?>" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">NAMA</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value=<?= $key['nama'] ?>>
                                    <input type="text" class="form-control" id="id" name="id" value=<?= $key['id'] ?> hidden>
                                    <?= form_error('nama','<small class="text-danger pl-3">','</small>'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">PANGKAT</label>
                                    <input type="text" class="form-control" id="pangkat" name="pangkat" value=<?= $key['pangkat'] ?>>
                                    <?= form_error('pangkat','<small class="text-danger pl-3">','</small>'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">ID SIDIK JARI</label>
                                    <input type="text" class="form-control" id="fingerID" name="fingerID" value=<?= $key['finger_location'] ?>>
                                    <?= form_error('fingerID','<small class="text-danger pl-3">','</small>'); ?>
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