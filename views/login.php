<?php 
  session_start();
  require "../functions/functions.php";

  if(isset($_COOKIE["login"])) {
    $id = $_COOKIE['id'];
    $cookie = query("SELECT * FROM users WHERE  id = '$id' ");
    if (hash_equals($_COOKIE['key'], $cookie["username"])) {
      header("location: ../index.php");
      exit;
    };
  };

  if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hasUsername = mysqli_query($connection, " SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($hasUsername) === 1) {
        $dataUser = mysqli_fetch_assoc($hasUsername);
        if(password_verify($password, $dataUser["password"])){
            echo "<script>
                    alert('Berhasil Log In, Selamat Datang Kembali');
                  </script> ";
             header("location: ../index.php");
             $_SESSION["login"] = true;
             if(isset($_POST["rememberMe"])){
              setcookie("key", hash("sha3-512" ,$dataUser["username"] ), time() + (30 * (60 * 60 * 24 )), "/");
              setcookie("id", $dataUser["id"] , time() + (30 * (60 * 60 * 24 )));
             };
           exit;
        };
    };
    $error = true;
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

    .rememberMe{
      display: inline;
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
  <title>Halaman Login</title>
</head>
<body>
  <div class="container">

    <form action="" method="post"> 
      <h1>Login</h1>
      <br>
      <?php 
        if (isset($error)) :?>
          <p style="color : red; font-style: italic;">username / password salah</p>    
      <?php endif; ?>


      <label>
        username
        <input type="text" name="username" autofocus class="input" autocomplete="off" >
      </label>
      <label>
        Password
        <input type="password" name="password" class="input" autocomplete="off">
      </label>
      <label >
        <input class="rememberMe" type="checkbox" name="rememberMe" class="input">
        Remember me
      </label>
      <button type="submit" name="login">Log in</button>
    </form>
    <div><a href="registration.php">Sign In</a></div>
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