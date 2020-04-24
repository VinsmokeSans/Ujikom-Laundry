 <!DOCTYPE html>
 <html><head>
     <title></title>
 </head><body>

    <h1 align="center">Laporan Laundry</h1><br><br><br>
     <table >
                    
        <tr>
           <th>No</th>
           <th>Nama Member</th>
           <th>Alamat</th>
           <th>Kode Invoice</th>
           <th>Tanggal Transaksi</th>
           <th>Tanggal Bayar</th>
           <th>Batas Waktu</th>
           <th>Total Harga</th>
           <th>Status Transaksi</th>                   
        </tr>
                              
        <?php 
        $i=1;
        $a=0;
        foreach ($data as $d) :?>
                       
        <tr align="center">
            <td align="center"><?= $i++ ?></td>
            <td align="center"><?= $d['nm_member'] ?></td>
            <td align="center"><?= $d['alamat_member'] ?></td>
            <td align="center"><?= $d['kode_invoice'] ?></td>
            <td align="center"><?= $d['tgl_transaksi'] ?></td>
            <td align="center"><?= $d['tgl_bayar'] ?></td>
            <td align="center"><?= $d['batas_waktu'] ?></td>
            <td align="center"><?= $d['total_harga'] ?></td>
            <td align="center"><?= $d['status_transaksi'] ?></td>
        </tr>
        <?php $a = $a + $d['total_harga']; ?>
                      
      <?php endforeach ?><br><br><br>
      <label><b>Total Pemasukan adalah <?= number_format($a , 0, ',', '.') ?></b></label>
      </table>
 </body></html>
 