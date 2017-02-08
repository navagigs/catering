<?php if ($action == 'view' || empty($action)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pemesanan</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                            Pemesanan
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   <!-- ========== Flashdata =========== -->
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
									 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="20">No</th>
                                        <th>Pemesanan</th>
                                        <th>Nama Costumer</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Status Pembayaran</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php     $no=1;  
                                         $query = $this->db->query("SELECT 
                        pemesanan.pemesanan_id AS pemesanan_id,
                        pemesanan.pemesanan_acara AS pemesanan_acara,
                        pemesanan.pemesanan_tanggal AS pemesanan_tanggal,
                        pemesanan.pemesanan_status AS pemesanan_status,
                        costumer.costumer_id AS costumer_id,
                        costumer.costumer_nama AS costumer_nama
                        FROM pemesanan
                        LEFT JOIN costumer ON costumer.costumer_id = pemesanan.costumer_id
                            ORDER BY pemesanan_id DESC");
                                        foreach ($query->result() as $row){ 
                                        ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $no; ?></td>
                                            <td><?php echo $row->pemesanan_acara; ?></td>
                                            <td><?php echo $row->costumer_nama; ?></td>
                                            <td><?php echo dateIndo($row->pemesanan_tanggal); ?></td>
                                            <td><?php if ($row->pemesanan_status=='N'){ echo "<span class='btn btn-primary'>?</span>"; } else{ echo "<span class='btn btn-success'>Sudah Dibayar</span>"; }?></td>
                                            <td><a href="<?php echo base_url();?>admin/pemesanan/detail/<?php echo $row->pemesanan_id; ?>" class="btn btn-primary">Detail Pemesanan</a> 
                                            <a href="<?php echo base_url();?>admin/pemesanan/status/<?php echo $row->pemesanan_id; ?>" class="btn btn-success" title="Klik bila Costumer sudah bayar"><i class="fa fa-dollar fa-fw"></i></a> 
                                            <a href="<?php echo base_url();?>admin/pemesanan/hapus/<?php echo $row->pemesanan_id; ?>" class="btn btn-danger" title="Hapus"><i class="fa fa-close fa-fw"></i></a></td>
                                    </tr>
                              <?php $no++; } ?>
                                </tbody>
                            </table>
								</div>
							</div>
						</div>
	</div>
<?php } elseif ($action == 'detail') { ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detail Pemesanan</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                           Detail Pemesanan
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                <?php             
                        $query1 = $this->db->query("SELECT * FROM pemesanan_detail WHERE pemesanan_id='$pemesanan_id' ORDER BY costumer_id");
                        error_reporting(0);
                                 foreach ($query1->result() as $row1){ }
                                    if($row1->costumer_id == '') {
                        ?>
                         <div class="alert alert-warning">
                            Tidak ada menu pemesanan
                        </div>
                        <?php } else { ?>

                            <div class="table-responsive">
                            <?php     
                        $no=1;                   
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
                        pemesanan.pemesanan_status AS pemesanan_status,
                        costumer.costumer_id AS costumer_id,
                        costumer.costumer_nama AS costumer_nama,
                        costumer.costumer_notelp AS costumer_notelp,
                        costumer.costumer_alamat AS costumer_alamat
                        FROM pemesanan_detail
                        LEFT JOIN menu ON menu.menu_id= pemesanan_detail.menu_id
                        LEFT JOIN pemesanan ON pemesanan.pemesanan_id = pemesanan_detail.pemesanan_id
                        LEFT JOIN costumer ON costumer.costumer_id = pemesanan_detail.costumer_id
                        WHERE pemesanan_detail.pemesanan_id='$pemesanan_id' ORDER BY detail_id DESC");
                                        foreach ($query->result() as $row2){ }
                                        ?>
                                     <table width="50%" >
                                        <tr>
                                            <td>Nama Costumer</td>
                                            <td>:</td>
                                            <td><strong> <?php echo $row2->costumer_nama; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><strong> <?php echo $row2->costumer_alamat; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>No.Telepon</td>
                                            <td>:</td>
                                            <td><strong> <?php echo $row2->costumer_notelp; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Status Pembayaran</td>
                                            <td>:</td>
                                            <td><strong> <?php if ($row2->pemesanan_status=='N'){ echo "<span class='btn btn-primary'>?</span>"; } else{ echo "<span class='btn btn-success'>Sudah Dibayar</span>"; }?></strong></td>
                                        </tr>
                                        </table>
                                </div><br><hr>
                                     <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="20">No</th>
                                        <th>Pemesanan</th>
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th>Jumlah Pemesanan</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php     
                        $no=1;                   
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
                        WHERE pemesanan_detail.pemesanan_id='$pemesanan_id' ORDER BY detail_id DESC");
                                        foreach ($query->result() as $row){ 
                                        ?>
                                    <tr class="odd gradeX">
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row->pemesanan_acara; ?></td>
                                            <td><?php echo $row->menu_nama; ?></td>
                                            <td>Rp.<?php echo format_rupiah($row->detail_harga); ?></td>
                                            <td><?php echo $row->detail_jumlah; ?></td>
                                            <td>Rp.<?php echo format_rupiah($row->detail_total); ?></td>
                                    </tr>
                              <?php $no++; } ?>
                               <tr>
                                            <td colspan="5">Jumlah Total yang harus di bayar</td>
                                            <td><?php   $jumlahkan  = $this->db->query("SELECT SUM(detail_total) AS detail_total FROM pemesanan_detail WHERE pemesanan_id='$pemesanan_id'");foreach ($jumlahkan->result() as $row2){}

                                                    echo "<strong>Rp.".format_rupiah($row2->detail_total)."</strong>";
                                                    ?></td>
                                        </tr>
                                </tbody>
                            </table>
                            <?php } ?>

                                            <input class="btn btn-default" type="reset" name="batal" value="Kembali" onclick="location.href='<?php echo site_url(); ?>admin/pemesanan'"/>
                                </div>
                            </div>
                        </div>
    </div>
<?php } ?>