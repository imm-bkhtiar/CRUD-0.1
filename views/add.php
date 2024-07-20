<?php 
  session_start();
  if (!isset($_COOKIE["key"])){
    header("location: login.php");
    exit;
  };
  require "../functions/functions.php";


if(isset($_POST["submit"])){
  if ( insert($_POST) > 0) {
    echo "
    <script>
      alert('data berhasil di tambahkan');
      document.location.href = '../index.php'
    </script>
    ";
  } else {
    echo "
    <script>
      alert('data gagal ditambahkan');
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
  <title>Tambah Data</title>
  <style>
    form, label {
      display: flex;
      flex-direction: column;
      width: 10rem;
    }

    form {
      gap: 1rem;
    }
  </style>
</head>
<body>
  <h1>Tambah Data </h1>
<form  action="" method="post">
    <label>
      Part Name
      <input class="input" autocomplete="off"  type="text" name="name" required>
    </label>
    <label>
      Type
      <input class="input" autocomplete="off"  type="text" name="type" required>
    </label>
    <label>
      price
      <input class="input" autocomplete="off" type="number" name="cost" required>
    </label>
    <button type="submit" name="submit">Add Component</button>
  </form>
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