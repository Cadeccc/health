<?php
# include:它會引入指定的 PHP 檔案，並在該檔案中的程式碼會在當前檔案中執行。與 require 不同include 會在檔案缺失或發生錯誤時不會阻止程式執行，但會發出警告。
require __DIR__ . '/setting/db_connect.php';
$title = '登入';
$pageName = 'login';
?>
<?php include __DIR__ . '/setting/html-head.php' ?>
<?php include __DIR__ . '/setting/html-sidebar.php' ?>
<div class="container-fluid">
    <div class="row">
        <div class="d-flex justify-content-center mt-5">
            <div class="card" style="width:50%">
                <div class="card-body">
                    <h5 class="card-title text-center">登入管理者</h5>
                    <form name="loginForm" novalidate onsubmit="sendData(event)">

                    <div class="mb-2">
                            <label for="email" class="form-label">帳號</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="請輸入email" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label">密碼</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="請輸入手機號碼" maxlength="12" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary mt-3 justify-content-end">登入</button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">歡迎回家！</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    登入成功
                </div>
            </div>
            <div class="modal-footer">
                <a href="accountList.php" class="btn btn-primary">回會員列表</a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/setting/html-footer.php' ?>
<?php include __DIR__ . '/setting/html-scripts.php' ?>

<script>
    // 建立對應到DOM的Modal物件
    const myModal = new bootstrap.Modal('#exampleModal');

    // 取得欄位的參照

    const emailField = document.loginForm.email;
    const passwordField = document.loginForm.password;


    // 檢查格式
    function validateEmail(email) {
        const checkEmail =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return checkEmail.test(email);
    }

    function validatePassword(Password) {
        const checkPassword =
            /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,12}$/;
        return checkPassword.test(Password);
    }

    const sendData = event => {
        event.preventDefault();
        // 恢復欄位的外觀
        emailField.style.border = '1px solid #CCC';
        emailField.nextElementSibling.innerHTML = '';
        passwordField.style.border = '1px solid #CCC';
        passwordField.nextElementSibling.innerHTML = '';


        // TODO: 欄位的資料檢查

        let isPass = true; // 有沒有通過檢查


        if (!validatePassword(passwordField.value)) {
            isPass = false;
            passwordField.style.border = '1px solid red';
            passwordField.nextElementSibling.innerHTML = '請填入正確的密碼';
        } else if (passwordField.value.length < 8) {
            isPass = false;
            passwordField.style.border = '1px solid red';
            passwordField.nextElementSibling.innerHTML = '密碼長度不足';
        }
        if (!validateEmail(emailField.value)) {
            isPass = false;
            emailField.style.border = '1px solid red';
            emailField.nextElementSibling.innerHTML = '請填入正確的帳號';
        }

        if (isPass) {
            const formData = new FormData(document.loginForm);
            fetch('loginApi.php', {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(result => {
                    if (result.success) {
                        myModal.show();
                        return;
                    }
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
</script>
<?php include __DIR__ . '/setting/html-tail.php' ?>