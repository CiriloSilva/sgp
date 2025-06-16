<?php require 'db.php'; ?>
<!doctype html>
<html lang="pt-br"><meta charset="utf-8">
  <head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <h3>Controle de Ponto</h3>
      <nav>
        <a href="index.php">Home</a>
        <?php if(isset($_SESSION['user_id'])): ?>
          <a href="cadastro.php">Cadastro</a>
          <a href="logout.php">Logout</a>
          <a href="relatorio.php">Relatório</a>
        <?php else: ?>
          <a href="login.html">Login</a>
          <a href="register.html">Registrar</a>
          <a href="relatorio.php">Relatório</a>
        <?php endif; ?>
      </nav>
    </header>
    <div class="container">
      <h2>Sobre o Sistema</h2>
      <p>
        Este sistema integra <strong>ESP8266</strong> + <strong>leitor PN532 RFID</strong> para capturar o UID de pulseiras ou cartões
        e registrar automaticamente a presença no banco de dados <strong>MySQL</strong> via API PHP.
      </p>
      <h3>Como funciona</h3>
      <ol>
        <li>O dispositivo lê o cartão e envia o UID via HTTP.</li>
        <li>O backend grava data e hora no banco.</li>
        <li>Os supervisores visualizam tudo em tempo real na página <em>Relatório</em>.</li>
        <li>Usuários autenticados conseguem cadastrar funcionários e vincular nomes aos UIDs.</li>
      </ol>
      <h3>Primeiros passos</h3>
      <ul>
        <li>Crie sua conta em <a href="register.html">Registrar</a>.</li>
        <li>Faça login para habilitar o menu de cadastro.</li>
        <li>Aproxime a pulseira do leitor para ver as marcações entrarem na tabela.</li>
      </ul>
    </div>
  </body>
</html>
