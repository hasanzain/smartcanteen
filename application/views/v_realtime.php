<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-primary">Lokasi Terkini</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('monitoring/realtime') ?>" method="POST">
                <div class="input-group mb-3 col-lg-5">
                    <span class="input-group-text">Filter</span>
                    <input type="text" class="form-control" placeholder="NRP" aria-label="NRP" name="nip">
                    <input type="date" class="form-control" name="tanggal">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
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
                                            <th scope="col">NAMA</th>
                                            <th scope="col">LOKASI</th>
                                            <th scope="col">JARAK</th>
                                            <th scope="col">JAM</th>
                                            <th scope="col">TANGGAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        function rad($x){ return $x * M_PI / 180; }
                                        function distHaversine($coord_b){
                                            $coord_a = "-7.7950607,110.4366169";
                                            # jarak kilometer dimensi (mean radius) bumi
                                            $R = 6371;
                                            $coord_a = explode(",",$coord_a);
                                            $coord_b = explode(",",$coord_b);
                                            $dLat = rad(($coord_b[0]) - ($coord_a[0]));
                                            $dLong = rad($coord_b[1] - $coord_a[1]);
                                            $a = sin($dLat/2) * sin($dLat/2) + cos(rad($coord_a[0])) * cos(rad($coord_b[0])) * sin($dLong/2) * sin($dLong/2);
                                            $c = 2 * atan2(sqrt($a), sqrt(1-$a));
                                            $d = $R * $c * 1000;
                                            # hasil akhir dalam satuan kilometer
                                            return number_format($d);
                                        } 
                                        $i=0;
                                        foreach ($realtime->result_array() as $key) {
                                            $coord_b = $key['latitude'] . "," . $key['longitude'];
                                            ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $key['nama'] ?></td>
                                            <td><a href="https://www.google.com/maps/search/?api=1&query=<?= $key['latitude'] ?>,<?= $key['longitude'] ?>&hl=id"
                                                    target="blank">Klik Disini</a></td>
                                            <td><?= distHaversine($coord_b) ?></td>
                                            <td><?= $key['jam'] ?></td>
                                            <td><?= $key['tanggal'] ?></td>
                                            </a>
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