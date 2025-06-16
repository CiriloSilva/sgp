<?php
session_start();
function db(){
  $conn = new mysqli("localhost","root","","controle_ponto");
  if($conn->connect_error){ die("Erro DB"); }
  return $conn;
}
?>