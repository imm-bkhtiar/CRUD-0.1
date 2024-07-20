<?php 
  session_start();
  if (!isset($_COOKIE["key"])){
    header("location: login.php");
    exit;
  };
require "../functions/functions.php";

$id = $_GET["id"];

if(delete($id) > 0){
  echo "
  <script>
    alert('data berhasil di hapus');
    document.location.href = '../index.php'
  </script>
  ";
} else {
  echo "
  <script>
    alert('data tidak berhasil di hapus');
    document.location.href = '../index.php'
  </script>
  ";
};

?>