<?php 
  session_start();
  if (!isset($_COOKIE["key"])){
    header("location: login.php");
    exit;
  };
require "../functions/functions.php";

$id = $_GET["id"];


$data = query("SELECT * FROM component WHERE id = $id")[0];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details</title>
  <style>
    .container {
      width: 30rem;
      height: 15rem;
      background-color: rgb(168, 214, 214);
      padding: 0 1rem;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      font-size: 1rem;
      position: relative;
    }

    h2{
      text-align: center;
    }

    ul{
      margin-top: -1rem;
    }

    li {
      margin: .5rem;
    }

    .action{
      right: 0;
    }

    .action a{
      margin: .5rem;
    }

    .back,
    .action{
      bottom: 10%;
      position: absolute;
      margin: 0 .5rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Detail</h2>
    <ul>
      <li>Name : <span><?= $data["name"]; ?></span></li>
      <li>Type : <span><?= $data["type"]; ?></span></li>
      <li>Price : <span class="price" ><?= $data["price"]; ?></span></li>
      <li>Detail : <br> <span><?= $data["detail"]; ?></span></li>
    </ul>
    <div class="action">
      <a href="" identitas="<?=  $data["id"];?>" id="delete">Delete</a> |
      <a href="edit.php?id=<?= $id; ?>" >Edit</a>
    </div>
    <a class="back" href="../"><- Back</a>
  </div>

  <script src="../public/js/delete.js"></script>
</body>
</html>