 <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">DETAIL MENU PESANAN ANDA</h4>

              <!-- ========== Flashdata ========== -->
                   <?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
                                    <?php if ($this->session->flashdata('success')) { ?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <i class="fa fa-check sign"></i><?php echo $this->session->flashdata('success'); ?>
                                        </div>
                                    <?php } else if ($this->session->flashdata('warning')) { ?>
                                        <div class="alert alert-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <i class="fa fa-check sign"></i><?php echo $this->session->flashdata('warning'); ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <i class="fa fa-warning sign"></i><?php echo $this->session->flashdata('error'); ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                    <!-- ========== End Flashdata ========== -->
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
               <div class="panel panel-default">
                        <div class="panel-heading">
                             DETAIL MENU PESANAN ANDA
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <?php 
                        $costumer1 = $costumer->costumer_id;                    
                        $query1 = $this->db->query("SELECT * FROM pemesanan_detail WHERE costumer_id='$costumer1' ORDER BY costumer_id");
                        error_reporting(0);
                                 foreach ($query1->result() as $row1){ }
                                    if($row1->costumer_id == '') {
                        ?>
                         <div class="alert alert-warning">
                            Anda belum memesan menu pesanan.
                        </div>
                        <?php } else { ?>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Acara</th>
                                            <th>Nama Menu</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php  
                                    $no=1;
                        $costumer = $costumer->costumer_id;                      
                        $query = $this->db->query("SELECT 
                        pemesanan_detail.detail_id AS detail_id,
                        pemesanan_detail.detail_jumlah AS detail_jumlah,
                        pemesanan_detail.detail_harga AS detail_harga,
                        pemesanan_detail.detail_total AS detail_total,
                        pemesanan_detail.costumer_id AS costumer_id,
                        pemesanan_detail.menu_id AS menu_id,
                        pemesanan_detail.menu_id AS menu_id,
                        menu.menu_id AS menu_id,
                        menu.menu_nama AS menu_nama,
                        pemesanan.pemesanan_id AS pemesanan_id,
                        pemesanan.pemesanan_acara AS pemesanan_acara,
                        costumer.costumer_id AS costumer_id,
                        costumer.costumer_nama AS costumer_nama
                        FROM pemesanan_detail
                        LEFT JOIN menu ON menu.menu_id= pemesanan_detail.menu_id
                        LEFT JOIN pemesanan ON pemesanan.pemesanan_id = pemesanan_detail.pemesanan_id
                        LEFT JOIN costumer ON costumer.costumer_id = pemesanan_detail.costumer_id
                        WHERE pemesanan_detail.costumer_id='$costumer' ORDER BY detail_id DESC");
                                 foreach ($query->result() as $row){
                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row->pemesanan_acara; ?></td>
                                            <td><?php echo $row->menu_nama; ?></td>
                                            <td><?php echo format_rupiah($row->detail_harga); ?></td>
                                            <td><?php echo $row->detail_jumlah; ?></td>
                                            <td>Rp.<?php echo format_rupiah($row->detail_total); ?></td>
                                            <td><a href="<?php echo base_url();?>costumer/pemesanan/detail-hapus/<?php echo $row->detail_id; ?>" class="btn btn-danger">Hapus</a></td>
                                        </tr>
                                    <?php $no++; } ?>
                                        <tr>
                                            <td colspan="5">Jumlah Total yang harus di bayar</td>
                                            <td><?php   $jumlahkan  = $this->db->query("SELECT SUM(detail_total) AS detail_total FROM pemesanan_detail  WHERE costumer_id='$costumer'");foreach ($jumlahkan->result() as $row2){}

                                                    echo "<strong>Rp.".format_rupiah($row2->detail_total)."</strong>";
                                                    ?></td>
                                            <td><a href="<?php echo base_url();?>costumer/pembayaran/<?php echo $row2->detail_total; ?>" class="btn btn-success">Konfirmasi</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                    <?php } ?>
                            </div>
                        </div>
                            </div>
                            </div>
            </div>
           