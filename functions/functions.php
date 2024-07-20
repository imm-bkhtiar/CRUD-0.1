<?php 
$connection = mysqli_connect("localhost", "root", "", "mydatabase");

function query( $query){
  global $connection;
  $component =  mysqli_query($connection, $query);
  $datas = [];
  while($data = mysqli_fetch_assoc($component)){
    $datas[] = $data;
  };
  return $datas;
};

function insert($data){
  $name = htmlspecialchars($data["name"]);
  $type = htmlspecialchars($data["type"]);
  $cost = htmlspecialchars($data["cost"]);

  $query = "INSERT INTO `component` (`id`, `name`, `type`, `price`) VALUES (NULL, '$name', '$type', '$cost')";

  global $connection;
  $component =  mysqli_query($connection, $query);

  return mysqli_affected_rows($connection);
};

function delete($id){
  global $connection;
  mysqli_query($connection, "DELETE FROM component WHERE id = $id");
  return mysqli_affected_rows($connection);
};

function edit($data){
  $name = htmlspecialchars($data["name"]);
  $type = htmlspecialchars($data["type"]);
  $cost = htmlspecialchars($data["cost"]);
  $id = $data["id"];

  $query = "UPDATE `component` SET 
  `name` = '$name', 
  `type` = '$type', 
  `price` = '$cost' 
  WHERE `id` = $id ";

  global $connection;
  $component =  mysqli_query($connection, $query);

  return mysqli_affected_rows($connection);
};

function search($keyword){
  $query = "SELECT * FROM component
                  WHERE 
                  name LIKE '%$keyword%' OR
                  type LIKE '%$keyword%' ORDER BY id DESC ";
  return query($query);
};

function signIn($data){
  global $connection;
  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($connection, $data["password"]);
  $verifyPassword = mysqli_real_escape_string($connection, $data["verifyPassword"]);

  $hasUsername = mysqli_query($connection, "SELECT username FROM users WHERE username = '$username'");
  if(mysqli_fetch_assoc($hasUsername)){
    echo "<script>
            alert('Username sudah terdaftar!!');
          </script>";
          return false;
  }

  if ($password !== $verifyPassword) {
    echo "<script>
            alert('Password tidak sesuai!!')
          </script>";
      return false;
  };

  $password = password_hash($password, PASSWORD_DEFAULT);
  
  mysqli_query($connection, "INSERT INTO users VALUES (NULL, '$username', '$password' )");
  return mysqli_affected_rows($connection);

};

?>