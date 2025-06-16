<?php
require 'db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
   $email = $_POST['email']??'';
   $senha = $_POST['senha']??'';
   if(!$email||!$senha){ exit('Dados faltando'); }
   $hash = password_hash($senha, PASSWORD_BCRYPT);
   $conn=db();
   $stmt=$conn->prepare("INSERT INTO usuarios(email,senha) VALUES(?,?)");
   $stmt->bind_param("ss",$email,$hash);
   if($stmt->execute()){
      echo "OK";
   }else{
      http_response_code(400);
      echo "Usuário já existe";
   }
   exit;
}
?>