<?php
$conn = new mysqli("localhost","root","","controle_ponto");
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $uid  = $_POST['uid'] ?? '';
  $nome = $_POST['nome'] ?? '';
  if($uid && $nome){
    $stmt=$conn->prepare("INSERT IGNORE INTO funcionarios(uid,nome) VALUES(?,?)");
    $stmt->bind_param("ss",$uid,$nome); $stmt->execute(); $stmt->close();
    echo "Salvo!<hr>";
  }
}
?>
<!doctype html>
<html>
<meta charset="utf-8">
<h3>Cadastrar Funcionário</h3>
<form method="post">
  UID RFID:<br><input name="uid" required><br>
  Nome:<br><input name="nome" required><br><br>
  <button>Cadastrar</button>
</form>
<p><a href="relatorio.php">Ver relatórios</a></p>
