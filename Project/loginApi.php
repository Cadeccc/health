<?php
# 引入php __DIR__代表當前檔案所在的目錄
require __DIR__ . "/setting/db_connect.php";

# 設定 HTTP 回應標頭 (Header)，讓瀏覽器知道這個 API 回傳的是 JSON 格式。
header('Content-Type: application/json');

# 建立一個陣列 $output，用來儲存 API 回應的結果。
# success: false → 預設為 false，表示預設情況下資料尚未成功寫入資料庫。
# postData: $_POST → 儲存 POST 送來的資料，方便除錯。
# error: '' → 預設錯誤訊息為空字串，若發生錯誤，這裡會被填入錯誤訊息。

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
    'errorFields' => []
];

# TODO: 欄位的資料檢查

$email = mb_strtolower(trim($_POST['email'] ?? '')); # (trim)去掉頭尾空白，轉成小寫字母，如果沒有給值就是空字串
$password = trim($_POST['password'] ?? '');

$isPass = true;


if (empty($password)) {
    $isPass = false;
    $output['errorFields']['password'] = '密碼為必填欄位';
} elseif (mb_strlen($password) < 8 || mb_strlen($password) > 12) {
    $isPass = false;
    $output['errorFields']['password'] = '密碼長度必須介於 8 到 12 個字元之間';
}

if (empty($email)) {
    $isPass = false;
    $output['errorFields']['email'] = 'email為必填欄位';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $isPass = false;
    $output['errorFields']['email'] = '請填寫正確的email';
}

if (!$isPass) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


$sqlCheckEmail = "SELECT * FROM `account` WHERE `email` =?";
$stmtCheckEmail = $pdo->prepare($sqlCheckEmail);
$stmtCheckEmail->execute([$email]);
$rowCheckEmail = $stmtCheckEmail->fetch();

if (!$rowCheckEmail) {
    $output['error'] = '此信箱尚未註冊，請先註冊帳號';
    $output['code'] = 400;
} else {
    // 信箱已註冊，進行登入驗證
    if (!password_verify($password, $rowCheckEmail['password_hash'])) {
        $output['error'] = '密碼錯誤，請重新輸入';
        $output['code'] = 401;
    } else {
        $_SESSION['loginUser'] = [
            'member_id' => $rowCheckEmail['member_id'],
            'email' => $rowCheckEmail['email'],
        ];
        $output['success'] = true;
    }
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
