<div class="content">
    <h1 class="">會員列表</h1>
    <button class="btn btn-primary mb-3" onclick="location.href='add.php'">新增會員</button>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>姓名</th>
                <th>出生日期</th>
                <th>手機</th>
                <th>email</th>
                <th>地址</th>
                <th>身高</th>
                <th>體重</th>
                <th><i class="fa-solid fa-pen-to-square"></i></th>
                <th><i class="fa-solid fa-trash-can"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r): ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= $r['name'] ?></td>
                    <td><?= $r['birth_date'] ?></td>
                    <td><?= $r['phone'] ?></td>
                    <td><?= $r['email'] ?></td>
                    <td><?= htmlentities($r['address']) ?></td>
                    <!-- <td><?= strip_tags($r['address']) ?></td> 移除標籤 -->
                    <td><?= $r['height'] ?></td>
                    <td><?= $r['weight'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $r['id'] ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <a href="javascript: deleteOne(<?= $r['id'] ?>)">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="col">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="fa-solid fa-angles-left fs-4"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="fa-solid fa-angle-left fs-4" ></i>
                    </a>
                </li>
                <?php for ($i = $page - 1; $i <= $page + 4; $i++):
                    if ($i >= 1 and $i <= $totalPage):
                ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                <?php endif;
                endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="fa-solid fa-angle-right fs-4"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="fa-solid fa-angles-right fs-4"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>