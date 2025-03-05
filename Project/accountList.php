<?php
require __DIR__ . '/setting/db_connect.php';
$title = '會員列表';
$pageName = 'ab-list';





# 用戶要看的頁面
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    # page = 1; 讓 $page 永遠都是>=1 
    header('Location: ?page=1'); # 轉向或者是跳頁
    exit; # 結束程式
}

$t_sql = "SELECT COUNT(1) FROM `members` ";

# 每頁有幾筆
$perPage = 30;
# 取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPage = 0;  # 總頁數的預設值
$rows = []; # 頁面資料的預設值
if ($totalRows) {
    # 計算總頁數
    $totalPage = ceil($totalRows / $perPage);  # 在正數的時候，ceil相當於無條件進位

    if ($page > $totalPage) {
        header("Location: ?page={$totalPage}"); # 轉向或者是跳頁
        exit;
    }

    # 取得該頁面的資料
    $sql = sprintf(
        "SELECT * FROM `members` 
                ORDER BY id 
                LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    try {
        $rows = $pdo->query($sql)->fetchAll();
    } catch (PDOException $ex) {
        echo '<h1>' . $ex->getMessage() . '</h1>';
        echo '<h2>' . $ex->getCode() . '</h2>';
    }
}

?>

<?php include __DIR__ . '/setting/html-head.php' ?>
<?php include __DIR__ . '/setting/html-sidebar.php' ?>

<div class="container">
    <div class="row">
        <?php
        if (empty($rows)) {
            include __DIR__ . '/listNoDate.php';
        } else {
            include __DIR__ . '/accountListContent.php';
        }
        ?>
    </div>
</div>

<?php include __DIR__ . '/setting/html-scripts.php' ?>
<script>
    const deleteOne = id => {
        if (confirm(`確定要刪除編號為${id}的資料嗎？`)) {
            location.href = `delete.php?id=${id}`;
        }
    }
</script>
<?php include __DIR__ . '/setting/html-tail.php' ?>