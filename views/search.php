<?php 
  session_start();
  require '../functions/functions.php';
  $i = 1;
  $keyword = $_GET["keyword"];


  $datas = query("SELECT * FROM component
  WHERE 
  name LIKE '%$keyword%' OR
  type LIKE '%$keyword%' ORDER BY id DESC");

function formatRupiah ($angka) {
  return "Rp " . number_format($angka, 0, ',', '.');
};
?>  



<table class="tableContent" >
      <thead>
        <th>No.</th>
        <th>Part Name</th>
        <th>Type</th>
        <th>Price</th>
        <th>Action</th>
      </thead>
      <tbody>
        <?php foreach ($datas as $data) :?>
          <tr>
            <td class="center"><?= $i++; ?></td>
            <td><?= $data["name"]; ?></td>
            <td><?= $data["type"]; ?></td>
            <td class="price" ><?= formatRupiah($data["price"]); ?></td>
            <td><a class="actionBtn" href="./views/detail.php?id=<?= $data["id"]?>">?</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>




