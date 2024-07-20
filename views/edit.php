<?php 
  session_start();
  if (!isset($_COOKIE["key"])){
    header("location: login.php");
    exit;
  };
  require "../functions/functions.php";
  $id = $_GET["id"];

  $data = query("SELECT * FROM component WHERE id = $id")[0];


if(isset($_POST["submit"])){
  if ( edit($_POST) > 0) {
    echo "
    <script>
      alert('data berhasil di ubah');
      document.location.href = '../index.php'
    </script>
    ";
  } else {
    echo "
    <script>
      alert('data gagal diubah');
      document.location.href = '../index.php'
    </script>
    ";
  } 
};

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
      height: 17rem;
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
      margin: .5rem ;
    }
    button{
      margin: 0 10rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Edit</h2>
      <form action="" method="post">
        <label>
          <input type="hidden" name="id" value=" <?=  $data["id"];?> " >
        </label>
      <ul>
        <li>Name :
          <label>
            <input class="input" type="text" name="name" value="<?= $data["name"];?>">
          </label>
        </li>
        <li>Type : 
          <label>
            <input class="input" type="text" name="type" value="<?= $data["type"];?>">
          </label>
        </li>
        <li>Price : 
          <label>
            <input class="input" type="number" name="cost" value="<?= $data["price"];?>">
          </label>
        </li>
      </ul>
      <button id="actionEdit" type="submit" name="submit" identitas="<?= $data["id"];?>">Edit Data</button>
    </form>
    
    <a class="back" href="javascript:history.back()"><- Back</a>
  </div>
  <script> 
    const inputs = document.querySelectorAll('.input')

    inputs.forEach((input, index) => {
      input.addEventListener("keydown", (e) => {
      if (e.key === "Enter") {
        e.preventDefault(); // Mencegah form submit
        const nextInput = inputs[index + 1];
        if (nextInput) {
          nextInput.focus();
            }
          }
        });
    });
  </script>
</body>
</html>