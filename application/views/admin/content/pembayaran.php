<?php if ($action == 'view' || empty($action)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pembayaran</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                            Pembayaran
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                            <a href="<?php echo base_url();?>admin/pembayaran/report" class="btn btn-ls btn-success">Buat Laporan</a><br><br>
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
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="20">No</th>
                                        <th>Tanggal</th>
                                        <th>Pembayaran</th>
                                        <th>Pemesanan</th>
                                        <th>Nama Costumer</th>
                                        <th>Status Pembayaran</th>
                                        <th>#</th>
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
                                         pembayaran.pembayaran_jumlah AS pembayaran_jumlah,
                                         pembayaran.pembayaran_status AS pembayaran_status
                                         FROM pembayaran 
                                         LEFT JOIN pemesanan ON pemesanan.pemesanan_id= pembayaran.pemesanan_id
                                         LEFT JOIN costumer ON costumer.costumer_id= pembayaran.costumer_id
                                         ORDER BY pembayaran_id DESC");
                                        foreach ($query->result() as $row){ 
                                        ?>
                                    <tr class="odd gradeX">
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo dateIndo($row->pembayaran_tanggal); ?></td>
                                            <td>Rp.<?php echo format_rupiah($row->pembayaran_jumlah); ?></td>
                                            <td><a href="<?php echo base_url();?>admin/pemesanan/detail/<?php echo $row->pemesanan_id; ?>" title="Detail" class="btn btn-primary"><?php echo $row->pemesanan_acara; ?></a> </td>
                                            <td><?php echo $row->costumer_nama; ?></td>
                                            <td><?php echo $row->pembayaran_status; ?></td>
                                            <td><a href="<?php echo base_url();?>admin/pembayaran/hapus/<?php echo $row->pemesanan_id; ?>" class="btn btn-danger" title="Hapus"><i class="fa fa-close fa-fw"></i></a></td>
                                    </tr>
                              <?php $no++; } ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
								</div>
							</div>
						</div>
	</div>
<?php } elseif ($action == 'report') { ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Buat Laporan</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                            Buat Laporan
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                      <form role="form" action="<?php echo base_url();?>admin/laporanexcel" method="post" enctype="multipart/form-data" data-parsley-validate="">
                                        <div class="form-group">
                                            <label>Dari Tanggal <span class="required">*</span></label>
                                            <input type="date"  name="dari" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Sampai Tanggal <span class="required">*</span></label>
                                            <input type="date"  name="sampai" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" name="buat" value="Buat Laporan">
                                </div>
                                       
                                </form>
                                </div>
                            </div>
                        </div>
    </div>

<?php } ?>