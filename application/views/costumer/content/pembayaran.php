<div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">CONFIRMASI PEMBAYARAN</h4>
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
                                    <?php 
                        $costumer1 = $costumer->costumer_id;                    
                        $query1 = $this->db->query("SELECT * FROM pemesanan WHERE costumer_id='$costumer1' ORDER BY costumer_id");
                        error_reporting(0);
                                 foreach ($query1->result() as $row1){ }
                                    if($row1->costumer_id == '') {
                        ?>
             <div class="col-md-12">
                         <div class="alert alert-warning">
                            Anda belum memesan menu pesanan.
                        </div>
                        </div>
                        <?php } else { ?>
             <div class="col-md-6">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                           CONFIRMASI PEMBAYARAN
                        </div>
                        <div class="panel-body">
                    <form role="form" action="<?php echo base_url();?>costumer/pembayaran/tambah" method="post">
                        <input type="hidden" name="costumer_id" value="<?php echo $costumer->costumer_id;?>" />
                        <label>Pemesanan : </label>
                        <select name='pemesanan_id' required class='form-control' style='width:'><option value=''></option>
                                     <?php
                                        $no=1;             
                                         $query = $this->db->query("SELECT * FROM pemesanan WHERE costumer_id = '$costumer->costumer_id' ORDER BY pemesanan_id DESC");
                                        foreach ($query->result() as $row1){ 
                                        ?>
                            <option value='<?php echo $row1->pemesanan_id;?>'><?php echo $row1->pemesanan_acara;?></option>
                            <?php } ?>
                         </select>
                        <label>Tanggal Pembayaran : </label>
                        <input type="date" name="pembayaran_tanggal" required="" class="form-control" />
                        <label>Jumlah Pembayaran : </label>
                        <input type="number" name="pembayaran_jumlah" required="" class="form-control" />
                        <label>Pembayaran melalui :</label>
                        <div class="radio">
					  <label>
					    <input type="radio" name="pembayaran_status" id="pembayaran_status" value="Transper" checked />
					    Transper
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" name="pembayaran_status" id="pembayaran_status" value="Tunai" />
					    Tunai
					  </label>
					  </div>

                        <hr />
                        <input type="submit" name="kirim" value="Confirmasi Pemabayaran" class="btn btn-info">
                    </form>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            PEMBAYARAN
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Pemesanan</th>
                                            <th>Nama Pemesanan</th>
                                            <th>Status Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                        $no=1;             
                                         $query = $this->db->query("SELECT 
                                         pemesanan.pemesanan_id AS pemesanan_id,
                                         pemesanan.pemesanan_acara AS pemesanan_acara,
                                         costumer.costumer_id AS costumer_id,
                                         costumer.costumer_nama AS costumer_nama,
                                         pembayaran.pembayaran_tanggal AS pembayaran_tanggal,
                                         pembayaran.pembayaran_status AS pembayaran_status
                                         FROM pembayaran 

					                     LEFT JOIN pemesanan ON pemesanan.pemesanan_id= pembayaran.pemesanan_id
					                     LEFT JOIN costumer ON costumer.costumer_id= pembayaran.costumer_id
					                      WHERE pembayaran.costumer_id = '$costumer->costumer_id' ORDER BY pembayaran_id DESC");
                                        foreach ($query->result() as $row){ 
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo dateIndo($row->pembayaran_tanggal); ?></td>
                                            <td><?php echo $row->pemesanan_acara; ?></td>
                                            <td><?php echo $row->costumer_nama; ?></td>
                                            <td><?php echo $row->pembayaran_status; ?></td>
                                        </tr>
                                    <?php $no++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            </div>
                                <?php } ?>
                        </div>

            </div>