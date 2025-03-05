<?php

require __DIR__ . '/setting/db_connect.php';
$title = '編輯會員資料';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT * FROM `members` WHERE id=$id";
    $row = $pdo->query($sql)->fetch();
}
if (empty($row)) {
    header('Location: accountList.php');
}

?>
<?php include __DIR__ . '/setting/html-head.php' ?>
<?php include __DIR__ . '/setting/html-sidebar.php' ?>
<div class="container-fluid">
    <div class="row">
        <div class="d-flex justify-content-center mt-5">
            <div class="card" style="width:50%">
                <div class="card-body">
                    <h5 class="card-title text-center">編輯會員資料</h5>
                    <form name="addForm" novalidate onsubmit="sendData(event)">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <div class="mb-2">
                            <label for="id" class="form-label">id</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $row['id'] ?>" disabled>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-2">
                            <label for="name" class="form-label">姓名</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>" placeholder="請輸入姓名" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-2">
                            <label for="datepicker" class="form-label
                                ">出生日期</label>
                            <input type="text" class="form-control" id="datepicker" name="birth_date" value="<?= $row['birth_date'] ?>" placeholder="請選擇出生日期" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-2">
                            <label for="phone" class="form-label">手機號碼</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $row['phone'] ?>" placeholder="請輸入手機號碼" maxlength="10" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-2">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>" placeholder="請輸入email" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-2">
                            <label for="address" class="form-label">地址</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $row['address'] ?>" placeholder="請輸入地址">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-2">
                            <label for="height" class="form-label">身高</label>
                            <input type="number" class="form-control" id="height" name="height" min="56" max="247" value="<?= $row['height'] ?>" placeholder="請輸入身高(cm)"
                                required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-2">
                            <label for="weight" class="form-label">體重</label>
                            <input type="number" class="form-control" id="weight" name="weight" min="20" max="300" value="<?= $row['weight'] ?>" placeholder="請輸入體重(kg)"
                                required>
                            <div class="form-text"></div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary mt-3 justify-content-end">確認編輯</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal互動視窗 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    資料編輯成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續編輯資料</button>
                <a href="javascript: back()" class="btn btn-primary">回列表頁</a>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/setting/html-scripts.php' ?>

<script>
    // 建立對應到DOM的Modal物件
    const myModal = new bootstrap.Modal('#exampleModal');
    const modalInfo = document.querySelector('#exampleModal .alert');

    // 取得欄位的參照
    const nameField = document.addForm.name;
    const birthDateField = document.addForm.birth_date;
    const emailField = document.addForm.email;
    const phoneField = document.addForm.phone;
    const heightField = document.addForm.height;
    const weightField = document.addForm.weight;
    const addressField = document.addForm.address;

    const back = () => {
        if (document.referrer) {
            location.href = document.referrer;
        } else {
            location.href = 'accountList.php';
        }

    }


    // 檢查格式
    function validateEmail(email) {
        const checkEmail =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return checkEmail.test(email);
    }

    function validatePhone(phone) {
        const checkPhone = /^09\d{8}$/;
        return checkPhone.test(phone);
    }

    const sendData = event => {
        event.preventDefault();
        // 恢復欄位的外觀
        nameField.style.border = '1px solid #CCC';
        nameField.nextElementSibling.innerHTML = '';
        birthDateField.style.border = '1px solid #CCC';
        birthDateField.nextElementSibling.innerHTML = '';
        phoneField.style.border = '1px solid #CCC';
        phoneField.nextElementSibling.innerHTML = '';
        emailField.style.border = '1px solid #CCC';
        emailField.nextElementSibling.innerHTML = '';
        addressField.style.border = '1px solid #CCC';
        addressField.nextElementSibling.innerHTML = '';
        heightField.style.border = '1px solid #CCC';
        heightField.nextElementSibling.innerHTML = '';
        weightField.style.border = '1px solid #CCC';
        weightField.nextElementSibling.innerHTML = '';

        // TODO: 欄位的資料檢查

        let isPass = true; // 有沒有通過檢查

        if (nameField.value.length < 2) {
            isPass = false;
            nameField.style.border = '1px solid red';
            nameField.nextElementSibling.innerHTML = '請填入正確的姓名';
        }
        if (birthDateField.value == "") {
            isPass = false;
            birthDateField.style.border = '1px solid red';
            birthDateField.nextElementSibling.innerHTML = '請填入正確的出生日期';
        }
        if (!validatePhone(phoneField.value)) {
            isPass = false;
            phoneField.style.border = '1px solid red';
            phoneField.nextElementSibling.innerHTML = '請填入正確的手機號碼';
        }
        if (!validateEmail(emailField.value)) {
            isPass = false;
            emailField.style.border = '1px solid red';
            emailField.nextElementSibling.innerHTML = '請填入正確email';
        }
        if (addressField.value == "") {
            isPass = false;
            addressField.style.border = '1px solid red';
            addressField.nextElementSibling.innerHTML = '請填入正確的地址';
        }

        if (heightField.value < 56 || heightField.value > 247) {
            isPass = false;
            heightField.style.border = '1px solid red';
            heightField.nextElementSibling.innerHTML = '請填入正確的身高';
        }
        if (weightField.value < 20 || weightField.value > 300) {
            isPass = false;
            weightField.style.border = '1px solid red';
            weightField.nextElementSibling.innerHTML = '請填入正確的體重';
        }

        if (isPass) {
            const formData = new FormData(document.addForm);
            fetch('editApi.php', {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(result => {
                    console.log(result);
                    if (result.success) {
                        modalInfo.classList.add('alert-success');
                        modalInfo.classList.remove('alert-danger');
                        modalInfo.innerHTML = '修改成功';
                    } else{
                        modalInfo.classList.remove('alert-success');
                        modalInfo.classList.add('alert-danger');
                        modalInfo.innerHTML = '修改失敗，請檢查資料是否正確';
                    } 
                    myModal.show();
                    
                    if (result.error) {
                        alert(result.error)
                    } else {
                        for (let k in result.errorFields) {
                            const element = document.querySelector(`#${k}`);
                            if (element) {
                                element.style.border = '1px solid #CCC';
                                element.nextElementSibling.innerHTML = 'result.errorFields[k]';
                            }
                        }
                    }
                })
                .catch(ex => {
                    console.warn('Fetch 出錯了!', ex);
                })
        }
    }

    $(function() {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            maxDate: 0
        });
    });
</script>
<?php include __DIR__ . '/setting/html-tail.php' ?>