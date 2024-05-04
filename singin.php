<?php





include_once("connection.php");
require_once("helper.php");

session_start();


if(!is_null($_SESSION['user'])) {
    header('Location: index.php');
}

$error_message = $_SESSION['error'] ?? '';
unset($_SESSION['error']);


if($_SERVER['REQUEST_METHOD'] == 'POST') {



    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];



    if($re_password != $password) {
        $_SESSION['error'] = 'كلمة المرور غير متطابقة';
        $error_message = $_SESSION['error'] ?? '';
        $_SESSION['form_data'] = [
            'username' => $_POST['username'],
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
        ];

     } else {
        $sql = 'INSERT into users (username, firstname, lastname, email, password) VALUES(:username, :firstname, :lastname, :email, :password)';

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);

        $stmt->execute();

        $id = $dbh->lastInsertId();

        $sql = "SELECT email FROM users WHERE id = ?";

        $stmt = $dbh->prepare($sql);
        $stmt->execute([$id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);



        try{
            if(isset($user)) {
                $_SESSION['email'] = $user->email;
                echo'<div class="alert alert-success">تم انشاء الحساب بنجاح جاري التحويل لصفحة تسجيل الدخول ...</div>';
                header('Refresh: 3; url=login.php', true, 200);
            }
        }catch(PDOException $e) {
            echo ''. $e->getMessage() .'';
        }
    }
}
?>





<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1.0">
        <title>صفحة تسجيل الدخول</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="sweetalert2.all.min.js"></script>



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
                    <h2>انشاء حساب </h2>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">الاسم الاول</label>
                                    <input type="text" class="form-control" name="firstname" value="<?= $_SESSION['form_data']['firstname'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الاسم الاخير</label>
                                    <input type="text" class="form-control" name="lastname" value="<?= $_SESSION['form_data']['lastname'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>اسم المستخدم</label>
                                    <input type="text" class="form-control" name="username" value="<?= $_SESSION['form_data']['username'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">الايميل</label>
                                    <input type="email" class="form-control" name="email" value="<?= $_SESSION['form_data']['email'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">كلمة المرور</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="re_password">تاكيد كلمة المرور</label>
                                    <input type="password" class="form-control" name="re_password">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary w-100 mt-4">حفظ</button>
                        </div>
                        <div class="col-md-12 mt-2">
                            <span>لديك حساب بالفعل ؟ <a style=" color: black; font-weight: bold; text-decoration: underline;" href="login.php">تسجيل الدخول </a></span>
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

<?php session_destroy(); ?>

