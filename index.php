<?php 
  require './functions/functions.php';
  session_start();
  
  if (!isset($_COOKIE["key"])){
    header("location: ./views/login.php");
    exit;
  };

  if(isset($_POST["search"])){
    $search = $_POST["keyword"];
    $_SESSION["search"] = $search;
    header("location: ?page=1");
  } elseif (isset($_SESSION["search"])) {
    $search = $_SESSION["search"];
  } else {
    $search = '';
  };

  $datas = query("SELECT * FROM component
  WHERE 
  name LIKE '%$search%' OR
  type LIKE '%$search%' ORDER BY id DESC");

  $lengthOfRow = 10;
  $lengthOfDatas = count($datas);
  $totalRowInOnePage = ceil($lengthOfDatas / $lengthOfRow);
  $activePages = (isset($_GET["page"])) ? $_GET["page"] : 1 ;
  $startData = ($activePages * $lengthOfRow) - $lengthOfRow;
  $datasPage = query("SELECT * FROM component WHERE 
  name LIKE '%$search%' OR
  type LIKE '%$search%' ORDER BY id DESC LIMIT $startData, $lengthOfRow");
    
  // 21 aku pengen bagi masing2 10 data berarti
  // 1 * 10 = 10 halaman pertama halaman kedua dimulai dari index ke 0 - 9
  // halaman kedua dimulai dari index ke 10 berarti (1 * 10) - 10 = 0
  
  $totalLinkPage = 2;
  if($activePages > $totalLinkPage){
    $startPage = $activePages - $totalLinkPage;
  } else{
    $startPage =1;
  };

  if ($activePages < ($totalRowInOnePage - $totalLinkPage)) {
    $endPage = $activePages + $totalLinkPage;
  }else{
    $endPage = $totalRowInOnePage;
  };

?>  


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./public/css/style.css">
  <title>Belajar database</title>
</head>
<body>
  <h1>Daftar Component PC</h1>
    <a class="add" href="./views/add.php">Tambah Data</a>
  <form id="searchForm" action="" method="post">
    <label>
      <input value="<?= $search;?> " id="searchInput" type="text" name="keyword" placeholder="Search" autocomplete="off" autofocus size="30">
    </label>
     <button id="searchBtn" type="submit" name="search">Search</button>
  </form>

  <div class="container" >
    <p class="page">
      <?php if($activePages > 1 ) : ?>
        <a href="?page=<?= $activePages - 1;?>">&laquo;</a>
      <?php endif; ?>  
      <?php for ($i = $startPage; $i <= $endPage; $i++ ) : ?>
        <?php if($totalRowInOnePage <= 1):  ?>
          <a  style="display: none;" href="?page=<?= $i;?>"><?= $i; ?></a>
        <?php elseif ($i == $activePages) :?>
          <a class="active" href="?page=<?= $i;?>"><?= $i; ?></a>
        <?php else : ?>
            <a href="?page=<?= $i;?>"><?= $i; ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      <?php if($activePages < $totalRowInOnePage ) : ?>
        <a href="?page=<?= $activePages + 1;?>">&raquo;</a>
      <?php endif; ?>  
    </p>
    <table class="tableContent" >
      <thead>
        <tr>
          <th>No.</th>
          <th>Part Name</th>
          <th>Type</th>
          <th>Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 + $startData; ?>
        <?php foreach ($datasPage as $data) :?>
          <tr>
            <td><?= $i++; ?></td>
            <td><?= $data["name"]; ?></td>
            <td><?= $data["type"]; ?></td>
            <td class="price"><?= $data["price"]; ?></td>
            <td><a class="actionBtn" href="./views/detail.php?id=<?= $data["id"]?>">?</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <a class="logout" href="./views/logout.php">Log Out</a>
  <script src="./public/js/main.js"></script>
</body>
</html>