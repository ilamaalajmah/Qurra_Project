<?php

session_start();
include_once("connection.php");
require_once("helper.php");

if(!is_null($_SESSION['user'])) {
    header('Location: index.php');
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $error_message =  $_SESSION['msg'];
    unset($_SESSION['msg']);
    // var_dump($error_message, $_SESSION['msg']);

    $username = $_POST['email'];
    $password = $_POST['password'];

    // var_dump($_POST);
    // exit;

    $stmt = $dbh->prepare("SELECT * FROM users WHERE email = :username AND password = :pass");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":pass", $password, PDO::PARAM_STR);

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);



    if($user) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
    } else {
        $_SESSION['msg'] = 'البريد الالكتروني او كلمة المرور خطا';
    }

}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1.0">
        <title>صفحة تسجيل الدخول</title>
        <link rel="stylesheet" href="front/css/bootstrap.min.css">
    <link rel="stylesheet" href="front/css/main.css">

        <link rel="stylesheet" href="<?= 'login/style.css' ?>">
        <style>
            section .imgBx {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <section>
        <div class="container">
                <div class="row p-4">
                    <div class="ocl-md-12">
                        <div class="logo ">
                            <img width="250" class="rounded" src="front//images//logo.jpeg" alt="logo">
                        </div>
                    </div>
                    <?php if(!empty($error_message)): ?>
                        <div class="alert alert-danger">
                            <?= $error_message ?>
                        </div>
                    <?php endif; ?>

                    <h2>تسجيل الدخول</h2>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">الايميل</label>
                                    <input type="email" class="form-control" name="email" value="<?php $_SESSION['email'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">كلمة المرور</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary w-100 mt-4">حفظ</button>
                        </div>
                        <div class="col-md-12 mt-2">
                            <span> ليس لديك حساب ؟<a style=" color: black; font-weight: bold; text-decoration: underline;" href="singin.php">انشاء حساب </a></span>
                        </div>
                    </form>
                </div>
              </div>
            <div class="imgBx">
                <img src="login/login.jpg">
            </div>
        </section>
    </body>
</html>
