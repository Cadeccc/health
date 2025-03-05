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
    'error' => '',
    'errorFields' => []
];

# TODO: 欄位的資料檢查

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = trim($_POST['name'] ?? '');
$email = mb_strtolower(trim($_POST['email'] ?? '')); # (trim)去掉頭尾空白，轉成小寫字母，如果沒有給值就是空字串
$birthday = $_POST['birth_date'] ?? '';
$phone = $_POST['phone'] ?? '';
$address = $_POST['address'] ?? '';
$height = $_POST['height'] ?? '';
$weight = $_POST['weight'] ?? '';




$isPass = true;
if (empty($name)) {
    $isPass = false;
    $output['errorFields']['name'] = '姓名為必填欄位';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
} elseif (mb_strlen($name) < 2) {
    $output['errorFields']['name'] = '請填寫正確的姓名';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

if (empty($birthday)) {
    $isPass = false;
    $output['errorFields']['birth_date'] = '出生日期為必填欄位';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

if (empty($phone)) {
    $isPass = false;
    $output['errorFields']['phone'] = '電話為必填欄位';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
} elseif (mb_strlen($phone) != 10) {
    $output['errorFields']['phone'] = '請填寫正確的手機號碼';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

if (empty($address)) {
    $isPass = false;
    $output['errorFields']['address'] = '地址為必填欄位';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

if (empty($email)) {
    $isPass = false;
    $output['errorFields']['email'] = 'email為必填欄位';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
} elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $isPass = false;
    $output['errorFields']['email'] = '請填寫正確的email';
}

if (empty($height)) {
    $isPass = false;
    $output['errorFields']['height'] = '身高為必填欄位';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
} elseif (!is_numeric($height) || floatval($height) < 56 || floatval($height) > 247) {
    $output['errorFields']['height'] = '請填寫正確的身高(以cm為單位)';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

if (empty($weight)) {
    $isPass = false;
    $output['errorFields']['weight'] = '身高為必填欄位';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
} elseif (!is_numeric($weight) || floatval($weight) < 20 || floatval($weight) > 200) {
    $output['errorFields']['weight'] = '請填寫正確的體重(以kg為單位)';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

if (! $isPass) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}



# 處理日期的格式 (如果不是必填就要加預設值)
if (!empty($_POST['birth_date'])) {
    $day = strtotime($_POST['birth_date']); # 整數(timestamp) 或 false
    if ($day !== false) {
        $birthday = date('Y-m-d', $day);
    }
}

$sql = "UPDATE `members` SET
`name`=?,
`birth_date`=?,
`phone`=?,
`email`=?,
`address`=?,
`height`=?,
`weight`=? 
WHERE `id`=?";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $name,
        $birthday,
        $phone,
        $email,
        $address,
        $height,
        $weight,
        $id
    ]);
    
    $output['success'] = !! $stmt->rowCount(); # !!轉成布林值
    $output['id'] = $pdo->lastInsertId(); # 最近新增資料的PrimaryKey
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
