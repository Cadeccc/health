<?php

require __DIR__ . '/setting/db_connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if($id > 0){
    $sql = "DELETE FROM `members` WHERE id=$id";
    $pdo->query($sql);
}

$come_from = 'accountList.php';
if(!empty($_SERVER['HTTP_REFERER'])){
    $come_from = $_SERVER['HTTP_REFERER'];
}

header("Location: $come_from");
?>
