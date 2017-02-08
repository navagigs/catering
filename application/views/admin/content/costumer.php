<?php if ($action == 'view' || empty($action)){ ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Costumer </h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
	<div class="row">
       <!-- /.col-lg-6 -->
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Costumer 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <a href="<?php echo base_url();?>admin/costumer/tambah" class="btn btn-ls btn-success">Tambah Costumer</a><br><br>
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
                                        <th width="50">No</th>
                                        <th>Nama Costumer</th>
                                        <th>Username</th>
                                        <th>No.Telepon</th>
                                        <th>Alamat</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $no=1;
                            $query = $this->db->query("SELECT * FROM costumer ORDER BY costumer_id DESC"); foreach ($query->result() as $row){
                            ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row->costumer_nama; ?></td>
                                        <td><?php echo $row->costumer_username; ?></td>
                                        <td><?php echo $row->costumer_notelp; ?></td>
                                        <td><?php echo $row->costumer_alamat; ?></td>
                                        <td><a href="<?php echo base_url();?>admin/costumer/edit/<?php echo $row->costumer_id; ?>" class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i></a> <a href="<?php echo base_url();?>admin/costumer/hapus/<?php echo $row->costumer_id; ?>" class="btn btn-danger"><i class="fa fa-close fa-fw"></i></a></td>
                                    </tr>
                              <?php $no++; } ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
	</div>

<?php } elseif ($action == 'tambah') { ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Costumer </h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Costumer 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                    <form role="form" action="<?php echo base_url();?>admin/costumer/tambah" method="post" enctype="multipart/form-data" data-parsley-validate="">
                                        <div class="form-group">
                                            <label>Nama <span class="required">*</span></label>
                                            <input type="text"  name="costumer_nama" id="costumer_nama" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Username <span class="required">*</span></label>
                                            <input type="text" name="costumer_username" id="costumer_username" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Password <span class="required">*</span></label>
                                            <input type="password" name="costumer_password" id="costumer_password" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>No.Telepon <span class="required">*</span></label>
                                            <input type="text" name="costumer_notelp" id="costumer_notelp" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat <span class="required">*</span></label>
                                            <textarea  name="costumer_alamat" id="costumer_alamat" required="" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                			<input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                                            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>admin/costumer'"/>
								        </div>
								    </form>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
            </div>
<?php } elseif ($action == 'edit') { ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Costumer </h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Costumer 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                    <form role="form" action="<?php echo base_url();?>admin/costumer/edit" method="post" enctype="multipart/form-data" data-parsley-validate="">
                                        <input type="hidden" name="costumer_id" value="<?php echo $costumer_id;?>" />
                                        <div class="form-group">
                                            <label>Nama <span class="required">*</span></label>
                                            <input type="text"  name="costumer_nama" id="costumer_nama" value="<?php echo $costumer_nama; ?>" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Username <span class="required">*</span></label>
                                            <input type="text" name="costumer_username" value="<?php echo $costumer_username; ?>" id="costumer_username" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Password <span class="required">*</span></label>
                                            <input type="password" name="costumer_password" id="costumer_password" value="" class="form-control"> <span class="required">*</span>kosongkan bila password tidak diubah.
                                        </div>
                                        <div class="form-group">
                                            <label>No.Telepon <span class="required">*</span></label>
                                            <input type="text" name="costumer_notelp" id="costumer_notelp" required="" value="<?php echo $costumer_notelp; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat <span class="required">*</span></label>
                                            <textarea  name="costumer_alamat" id="costumer_alamat" required="" class="form-control"><?php echo $costumer_alamat; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                			<input type="submit" class="btn btn-primary" name="simpan" value="Simpan Data">
                                            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>admin/costumer'"/>
								</div>
								</form>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
            </div>
<?php } ?>
