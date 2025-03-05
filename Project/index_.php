<?php
# include:它會引入指定的 PHP 檔案，並在該檔案中的程式碼會在當前檔案中執行。與 require 不同include 會在檔案缺失或發生錯誤時不會阻止程式執行，但會發出警告。
require __DIR__ . '/setting/db_connect.php';
$title = '首頁';
$pageName = 'home';
?>
<?php include __DIR__ . '/setting/html-head.php' ?>
<?php include __DIR__ . '/setting/html-navbar.php' ?>
<?php include __DIR__ . '/setting/html-sidebar.php' ?>
<?php include __DIR__ . '/setting/html-footer.php' ?>
<?php include __DIR__ . '/setting/html-scripts.php' ?>
<?php include __DIR__ . '/setting/html-tail.php' ?>