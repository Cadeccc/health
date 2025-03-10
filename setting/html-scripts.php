<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- dashboard_charts.js -->
<!-- <script src="js/dashboard_charts.js"></script> -->

<!--修改為只在 pageName "dashboard" 引入此 js 避免找不到圖表報錯 -->
<?php if ($pageName === 'dashboard'): ?>
<script src="js/dashboard_charts.js"></script>
<?php endif; ?>
<!--
<script>
    /* active (改用新得的) 
    <?= $pageName == 'ab-list(需要加active的頁面)' ? 'active' : '' ?>
    $(function() {
        let currentPath = window.location.pathname.split("/").pop(); // 取得當前頁面的檔案名稱

        $(".nav-link,.list-group-item").each(function() {
            let linkPath = $(this).attr("href").split("/").pop(); // 取得 <a> 的 href 檔案名稱
            if (linkPath === currentPath) {
                $(this).addClass("active"); // 為符合當前頁面的 <a> 加上 active
                $(this).closest(".nav-item").addClass("active"); // 也加到父級 nav-item，避免樣式問題
                $(this).closest(".collapse").addClass("show");
                if ($(this).closest(".collapse").length) {
                    $(this).closest(".nav-item").removeClass("active");
                }
            }
        });
    });
</script>
-->
<script>
    
function confirmDelete(itemId, type, title = '') {
    let typeText = {
        'post': '文章',
        'achievement': '成就',
        'category': '分類'
    };

    let itemType = typeText[type] || '項目';
    let confirmMsg = `⚠️ 你確定要刪除這個${itemType}嗎？`;

    if (title) {
        confirmMsg = `⚠️ 你確定要刪除這個${itemType}：「${title}」嗎？\n\n此操作無法復原！`;
    }

    if (confirm(confirmMsg)) {
        window.location.href = `delete_${type}.php?id=${itemId}`;
    }
}
</script>