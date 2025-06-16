<?php require 'db.php'; $conn=db(); ?>
<!doctype html>
<html lang="pt-br">
  <meta charset="utf-8">
  <head>
    <meta http-equiv="refresh" content="5">
    <title>Relatório</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <h3>Controle de Ponto</h3>
      <nav>
        <a href="index.html">Home</a>
        <?php if(isset($_SESSION['user_id'])): ?>
          <a href="cadastro.php">Cadastro</a>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="login.html">Login</a>
          <a href="register.html">Registrar</a>
        <?php endif; ?>
        <a href="relatorio.php">Relatório</a>
      </nav>
    </header>
    <div class="container">
    <h2>Registros de Presença</h2>
    <table>
      <tr>
        <th>Funcionário</th>
        <th>UID</th>
        <th>Horário</th>
      </tr>
      <?php
      $res=$conn->query("SELECT COALESCE(f.nome,'-') AS nome,r.uid,r.horario FROM registros r LEFT JOIN funcionarios f ON f.uid=r.uid ORDER BY r.horario DESC");
      while($row=$res->fetch_assoc()):
      ?>
      <tr>
        <td>
          <?=htmlspecialchars($row['nome'])?>
        </td>
        <td>
          <?=$row['uid']?>
        </td>
        <td>
          <?=$row['horario']?>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
    </div>
  </body>
</html>
