<?php
include './connection/db.php';



$id = $_POST['id'];

$chk_res = $conn->prepare("SELECT * FROM residents WHERE id = ? LIMIT 1");
$chk_res->execute(array($id));
$result=$chk_res->fetch(PDO::FETCH_ASSOC);

echo json_encode(array($result));


?>
