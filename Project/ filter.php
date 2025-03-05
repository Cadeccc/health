<?php

require __DIR__ . '/setting/db_connect.php';

$sql = "SELECT * FROM `members` ORDER BY `birth_date` ASC"; // 依據出生日期升序排序
$rows = $pdo->query($sql)->fetchAll();


?>