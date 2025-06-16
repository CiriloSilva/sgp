<?php
require 'db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email=$_POST['email']??'';
  $senha=$_POST['senha']??'';
  $conn=db();
  $stmt=$conn->prepare("SELECT id,senha FROM usuarios WHERE email=?");
  $stmt->bind_param("s",$email);
  $stmt->execute();
  $stmt->bind_result($uid,$hash);
  if($stmt->fetch() && password_verify($senha,$hash)){
     $_SESSION['user_id']=$uid;
     echo "OK";
  } else {
     http_response_code(401);
     echo "Falha";
  }
  exit;
}
?>