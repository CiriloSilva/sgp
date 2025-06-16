<?php
require 'db.php';
$conn = db();
$uid = $_POST['uid'] ?? '';
if($uid===''){ http_response_code(400); exit('UID vazio'); }
$stmt=$conn->prepare("INSERT INTO registros(uid,horario) VALUES(?, NOW())");
$stmt->bind_param("s",$uid);
$stmt->execute();
echo "OK";
?>