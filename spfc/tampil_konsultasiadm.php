<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Hasil Konsultasi</strong></div>
  <div class="card-body">
    <table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th width="80px">No.</th>
        <th width ="500px">Nama penyakit</th>
        <th width ="500px">Keterangan</th>
        <th width ="100px"></th>
      </tr>
    </thead>
    <tbody>
			<!-- letakkan proses menampilkan disini -->
    <?php
     $no=1;
     $sql = "SELECT basis_aturan.idaturan,basis_aturan.idpenyakit,penyakit.nmpenyakit,penyakit.keterangan FROM basis_aturan INNER JOIN penyakit ON basis_aturan.idpenyakit=penyakit.idpenyakit ORDER BY nmpenyakit ASC";
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc()) {
    ?>
         <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nmpenyakit']; ?></td>
            <td><?php echo $row['keterangan']; ?></td>
            <td> <align="center">
                <a class="btn btn-primary" href="?page=aturan&action=detail&id=<?php echo $row['idaturan']; ?>">
                    <i class="fas fa-list"></i>
                </a>

                <a class="btn btn-warning" href="?page=aturan&action=update&id=<?php echo $row['idaturan']; ?>">
                    <i class="fas fa-edit"></i>
                </a>
                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=aturan&action=hapus&id=<?php echo $row['idaturan']; ?>">
                    <i class="fas fa-window-close"></i>
                </a>
            </td>
         </tr>
     <?php
     }
     $conn->close();
    ?>
   </tbody>
</table>
</div>
</div>