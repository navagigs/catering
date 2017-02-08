
  <table width="100%" border="1px">
                                <thead>
                                    <tr>
                                        <td colspan="6"><center><strong><h1>Data Transaksi</h1></center></td>
                                    </tr>
                                    <tr>
                                        <th width="20">No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Costumer</th>
                                        <th>Pemesanan</th>
                                        <th>Status Pembayaran</th>
                                        <th>Pembayaran</th>
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
                                <?php
                                $query1 = $this->db->query("SELECT * FROM pembayaran ORDER BY pembayaran_id");
                                 foreach ($query1->result() as $row1){ }
                                            if($row1->pembayaran_tanggal == '') { ?>
                                    <tr class="odd gradeX">
                                            <center>Tidak ada Transaksi</center>
                                    </tr>
                                <?php  } else { ?>
                                    <tr class="odd gradeX">
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo dateIndo($row->pembayaran_tanggal); ?></td>
                                            <td><?php echo $row->costumer_nama; ?></td>
                                            <td><?php echo $row->pemesanan_acara; ?></td>
                                            <td><?php echo $row->pembayaran_status; ?></td>
                                            <td><p align="right">Rp.<?php echo format_rupiah($row->pembayaran_jumlah); ?></p></td>
                                    </tr>
                                    <?php } ?>
                              <?php $no++; } ?>
                                    <tr>
                                        <td colspan="5"><p align="right">Total</p></td>
                                        <td><p align="right"><?php   $jumlahkan  = $this->db->query("SELECT SUM(pembayaran_jumlah) AS pembayaran_jumlah FROM pembayaran ");foreach ($jumlahkan->result() as $row2){}

                                                    echo "<strong>Rp.".format_rupiah($row2->pembayaran_jumlah)."</strong>";
                                                    ?></p></td>
                                    </tr>
                                </tbody>
                            </table>