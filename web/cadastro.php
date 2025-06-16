<?php
require 'db.php';
if(!isset($_SESSION['user_id'])){
   header("Location: login.html");
   exit;
}
$conn = db();
if($_SERVER['REQUEST_METHOD']==='POST'){
  $uid=$_POST['uid']??'';
  $nome=$_POST['nome']??'';
  if($uid && $nome){
    $stmt=$conn->prepare("INSERT IGNORE INTO funcionarios(uid,nome) VALUES(?,?)");
    $stmt->bind_param("ss",$uid,$nome);
    $stmt->execute();
    $msg="Salvo!";
  }
}
?>
<!doctype html>
<html lang="pt-br">
  <meta charset="utf-8">
  <head>
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
    <script src="modal.js"></script>
  </head>
  <body>
    <header><h3>Controle de Ponto</h3>
      <nav>
        <a href="index.html">Home</a>
        <a href="cadastro.php">Cadastro</a>
        <a href="logout.php">Logout</a>
        <a href="relatorio.php">Relatório</a>
      </nav>
    </header>

    <div class="container" id="cadApp">
      <h2>Cadastrar Funcionário</h2>
      <?php if(isset($msg)) echo "<script>showModal('Funcionario cadastrado com sucesso!', 'relatorio.php');</script>"; ?>
      <form method="post">
        <label>UID RFID</label><input name="uid" required>
        <label>Nome</label><input name="nome" required>
        <button>Salvar</button>
      </form>
    </div>
  </body>
</html>
