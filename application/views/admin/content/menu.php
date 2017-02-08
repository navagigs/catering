<?php if ($action == 'view' || empty($action)){ ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Menu Catering</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
	<div class="row">
       <!-- /.col-lg-6 -->
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Menu Catering
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <a href="<?php echo base_url();?>admin/menu/tambah" class="btn btn-ls btn-success">Tambah Menu</a><br><br>
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
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $no=1;
                            $query = $this->db->query("SELECT * FROM menu ORDER BY menu_id DESC"); foreach ($query->result() as $row){
                            ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row->menu_nama; ?></td>
                                        <td>Rp.<?php echo format_rupiah($row->menu_harga); ?></td>
                                        <td><img src="<?php echo base_url()."assets/images/".$row->menu_foto; ?>" width="100px"/>
                                        <td><a href="<?php echo base_url();?>admin/menu/edit/<?php echo $row->menu_id; ?>" class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i></a> <a href="<?php echo base_url();?>admin/menu/hapus/<?php echo $row->menu_id; ?>"  class="btn btn-danger"><i class="fa fa-close fa-fw"></i></a></td>
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
        <h1 class="page-header">Menu Catering</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Menu Catering
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                    <form role="form" action="<?php echo base_url();?>admin/menu/tambah" method="post" enctype="multipart/form-data" data-parsley-validate="">
                                        <div class="form-group">
                                            <label>Nama <span class="required">*</span></label>
                                            <input type="text"  name="menu_nama" id="menu_nama" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga <span class="required">*</span></label>
                                            <input type="number" name="menu_harga" id="menu_harga" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi Menu <span class="required">*</span></label>
                                            <textarea  name="menu_deskripsi" id="menu_deskripsi" required="" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto <span class="required">*</span></label>
                                            <input type="file"  name="menu_foto" id="menu_foto" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                			<input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                                            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>admin/menu'"/>
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
        <h1 class="page-header">Menu Catering</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Menu Catering
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                    <form role="form" action="<?php echo base_url();?>admin/menu/edit" method="post" enctype="multipart/form-data" data-parsley-validate="">
                                        <input type="hidden" name="menu_id" value="<?php echo $menu_id;?>" />
                                        <div class="form-group">
                                            <label>Nama <span class="required">*</span></label>
                                            <input type="text" name="menu_nama" id="menu_nama" value="<?php echo $menu_nama;?>" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga <span class="required">*</span></label>
                                            <input type="text" name="menu_harga" id="menu_harga" value="<?php echo $menu_harga;?>" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi <span class="required">*</span></label>
                                            <textarea name="menu_deskripsi" id="menu_deskripsi" class="form-control"><?php echo $menu_deskripsi;?></textarea>
                                        </div>
                                        <?php if ($menu_foto){?>
                                         <div class="form-group">
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><img src="<?php echo base_url()."assets/images/".$menu_foto;?>" width="100px"/></td>
                                            </tr>
                                        </div>
                                         <div class="form-group">
                                            <tr>
                                                <td><label for="menu_foto">Edit Foto</label></td>
                                                <td><input type="file" name="menu_foto" id="menu_foto" /></td>
                                            </tr>
                                        </div>
                                        <?php } else {?>
                                            <tr>
                                                <td><label for="menu_foto" >Foto <span class="required">*</span></label></td>
                                                <td><input type="file" name="menu_foto" id="menu_foto"  /></td>
                                            </tr>
                                        <?php } ?>
                                        <div class="form-group">
                                			<input type="submit" class="btn btn-primary" name="simpan" value="Simpan Data">
                                            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>admin/menu'"/>
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
