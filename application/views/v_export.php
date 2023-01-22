<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-primary">EXPORT</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

            <form action="<?= base_url() ?>monitoring/export_csv" method="POST">
                <div class="input-group mb-3 col-lg-6">
                    <span class="input-group-text">Filter</span>
                    <input type="text" class="form-control" placeholder="ID Karyawan" aria-label="NRP" name="idKaryawan">
                    <input type="text" class="form-control" placeholder="Nama" aria-label="NRP" name="nama">
                    <input type="text" class="form-control" placeholder="Waktu Makan" aria-label="NRP" name="keterangan">
                    <input type="date" class="form-control" name="tanggal">
                    <button class="btn btn-outline-success" type="submit" id="button-addon2">Export CSV</button>
                </div>
            </form>


            <form action="<?= base_url() ?>monitoring/export_pdf" method="POST">
                <div class="input-group mb-3 col-lg-6">
                    <span class="input-group-text">Filter</span>
                    <input type="text" class="form-control" placeholder="ID Karyawan" aria-label="NRP" name="idKaryawan">
                    <input type="text" class="form-control" placeholder="Nama" aria-label="NRP" name="nama">
                    <input type="text" class="form-control" placeholder="Waktu Makan" aria-label="NRP" name="keterangan">
                    <input type="date" class="form-control" name="tanggal">
                    <button class="btn btn-outline-danger" type="submit" id="button-addon2">Export PDF</button>
                </div>
            </form>

            <!-- <form action="monitoring/export_csv" method="POST">
                <div class="input-group mb-3 col-lg-5">
                    <span class="input-group-text">Filter</span>
                    <input type="text" class="form-control" placeholder="NRP" aria-label="NRP" name="nip">
                    <input type="date" class="form-control" name="tanggal">
                    <button class="btn btn-outline-success" type="submit" id="button-addon2">Export Data</button>
                </div>
            </form> -->




            <!-- /.content-wrapper -->
    </section>




    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-secondary">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->