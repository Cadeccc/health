<aside class="sidebar">
    <h4 class="sidebar-brand">海優斯後台管理</h4>
    <ul class="nav flex-column sidebar-nav ">
        <li class="nav-item d-flex align-items-center fs-5">
            <i class="bi bi-house "></i>
            <a href="index_.php" class="nav-link fw-bold" aria-current="page">
                <span>首頁</span>
            </a>
        </li>
        <li class="nav-item d-flex align-items-center fs-5">
            <i class="bi bi-person-circle"></i>
            <a href="accountList.php" class="nav-link fw-bold">
                <span>會員管理</span>
            </a>
        </li>
        <li class="nav-item ">
            <div class="d-flex align-items-center fs-5">
                <i class="bi bi-handbag"></i>
                <a class="nav-link fw-bold" data-bs-toggle="collapse" href="#couponMenu" role="button" aria-expanded="false">
                    <span>優惠券管理</span>
                </a>
            </div>
            <div class="collapse" id="couponMenu">
                <ul class="list-group">
                    <a class="list-group-item bg-light fs-6 d-flex align-items-center" href="test01.php">
                        <i class="bi bi-ticket-perforated me-2"></i>
                        <span>優惠券內容管理</span>
                    </a>
                    <a class="list-group-item bg-light fs-6 d-flex align-items-center" href="test02.php">
                        <i class="bi bi-person-badge me-2"></i>
                        <span>優惠券內容管理</span>
                    </a>
                </ul>
            </div>
        </li>
        <li class="nav-item d-flex align-items-center fs-5">
            <i class="bi bi-shop"></i>
            <a href="test03.php" class="nav-link fw-bold">
                <span>商品管理</span>
            </a>
        </li>
        <li class="nav-item d-flex align-items-center">
            <i class="fa-solid fa-dumbbell fs-6"></i>
            <a href="test04.php" class="nav-link fw-bold fs-5">
                <span>課程管理</span>
            </a>
        </li>
        <li class="nav-item d-flex align-items-center fs-5">
            <i class="bi bi-person-standing"></i>
            <a href="test05.php" class="nav-link fw-bold">
                <span>教練管理</span>
            </a>
        </li>
        <li class="nav-item">
            <div class="d-flex align-items-center fs-5">
                <i class="bi bi-file-text"></i>
                <a href="manage_forum.php" class="nav-link fw-bold">
                    <span>論壇管理</span>
                </a>
                <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#forumMenu" role="button" aria-expanded="false"></a>
            </div>
            <div class="collapse" id="forumMenu">
                <ul class="list-group">
                    <a class="list-group-item bg-light fs-6 <?= $currentPage == 'manage_posts.php' ? 'active' : '' ?>"
                        href="manage_posts.php">
                        <i class="bi bi-journal-text"></i>
                        <span>文章管理</span> 
                    </a>
                    <a class="list-group-item bg-light fs-6 <?= $currentPage == 'manage_categories.php' ? 'active' : '' ?>"
                        href="manage_categories.php">
                        <i class="bi bi-tags"></i>
                        <span>分類管理</span> 
                    </a>
                    <a class="list-group-item bg-light fs-6 <?= $currentPage == 'manage_achievements.php' ? 'active' : '' ?>"
                        href="manage_achievements.php">
                        <i class="bi bi-trophy"></i>
                        <span>成就管理</span> 
                    </a>
                </ul>
            </div>
        </li>
        <li class="d-flex justify-content-end fs-5">
            <a href="login.php" class="nav-link fw-bold">登入</a>
        </li>
        <?php if (isset($_SESSION['admin'])) ?>
        <?php ?>
        <?php ?>
    </ul>
</aside>