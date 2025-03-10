<?php

# 引入php __DIR__代表當前檔案所在的目錄

require __DIR__ . "/config.php";

# dsn = data source name
# 建構資料庫的 DSN 字串，包含了資料庫的位置、名稱、編碼等資訊

$dsn = sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8mb4', DB_HOST, DB_NAME, DB_PORT);

# 建立 PDO 連線選項的陣列

$pdo_options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ];
# 建立了一個 PDO 資料庫連線物件

  $pdo = new PDO($dsn, DB_USER, DB_PASS, $pdo_options);

# 啟用 Session 功能(讓網站能夠「記住」使用者)

if (! isset($_SESSION)) {
  session_start();
}

