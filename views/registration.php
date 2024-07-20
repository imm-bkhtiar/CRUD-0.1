<?php 
  require "../functions/functions.php";

  if (isset($_POST["signIn"])) {
    if (signIn($_POST) > 0 ){
      echo "<script>
              alert('Berhasil Sign In, Selamat Datang');
            </script> ";
            header("location: login.php");
            exit;
    } else {
      echo mysqli_error($connection);
    };
  };


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin-top: 3rem;
    }
    body,
    .container{
      display: flex;
      justify-content: center;
      align-items: center;
    } 
    

    .container {
      width: 20rem;
      height: 30rem;
      background-color: gray;
      justify-content: space-evenly;
      padding: 1rem;
      box-sizing: border-box;
      flex-direction: column;
    }

    h1 {
      display: inline-block;
      margin-bottom: 3rem;
      text-align: center;
      color: whitesmoke;
    }

    form > *,
    input {
     display: block;
    }

    label,
    button,
    a{
      margin-top: .5rem;
      color: white;
    }

    button{
      text-align: center;
      margin: 0 auto;
      color: gray;
      margin-top: 1rem;
    }


  </style>
  <title>Halaman  Regristasi</title>
</head>
<body>
  <div class="container">

    <form action="" method="post"> 
      <h1>Sign In</h1>
      <label>
        username
        <input type="text" name="username" autofocus class="input" autocomplete="off" >
      </label>
      <label>
        Password
        <input type="password" name="password" class="input" autocomplete="off">
      </label>
      <label>
        Verify Password
        <input type="password" name="verifyPassword" class="input"  autocomplete="off">
      </label>
      <button type="submit" name="signIn">Sign In</button>
    </form>
    <div><a href="login.php">Log In</a></div>
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