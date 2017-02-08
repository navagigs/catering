 <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Menu Catering</h4>
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
                        $query = $this->db->query("SELECT * FROM menu ORDER BY menu_id");
                foreach ($query->result() as $row){ 
                ?>
              <div class="col-md-4 col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo $row->menu_nama;?>
                        </div>
                        <div class="panel-body">
                            <center><p><img src="<?php echo base_url();?>assets/images/<?php echo $row->menu_foto ;?>" width="320px"></p><br></center>
                            <b>Deskripsi:</b><hr>
                            <p><?php echo $row->menu_deskripsi ;?></p><br><hr>
                            <center><b><h3>Rp.<?php echo format_rupiah($row->menu_harga);?></h3></b></center>
                        </div>
                        <div class="panel-footer">
                            <center><a href="<?php echo base_url();?>costumer/pemesanan/detail/<?php echo $row->menu_id ;?>" class="btn btn-success btn-lg">Pesan Sekarang</a></center>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
           