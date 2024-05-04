<?php



session_start();


require_once(dirname(__FILE__) ."/connection.php");

if($_SESSION['user']['user_type'] != 'admin') {
  header('Location: index.php');
}


?>


<?php

    $sql = "SELECT * FROM users ";

    $stmt = $dbh->prepare($sql);

    $stmt->execute();

    $users = $stmt->rowCount();

    $sql = "SELECT * FROM books ";

    $stmt2 = $dbh->prepare($sql);

    $stmt2->execute();

    $book = $stmt2->rowCount();



?>





<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" type="text/css" />


    <link rel="stylesheet" href="front/css/bootstrap.min.css">
    <link rel="stylesheet" href="front/css/main.css">
    <title>لوحة التحكم</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="container-fluid">
  <a a class="navbar-brand" href="dashboard.php">
      <img src="front/images/logo.jpeg" alt="" width="50" height="30" class="d-inline-block align-text-top">

    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="<?= $_SERVER['PHP_SELF'] .'?users=show' ?>">المستخدمين</a>
        <a class="nav-link" href="<?= $_SERVER['PHP_SELF'] .'?books=show' ?>">الكتب</a>


        <a href="index.php" class="nav-link mr-auto">الصفحة الرئيسية</a>

      </div>
    </div>
  </div>
</nav>


<main class="mt-4">

        <?php


          if(isset($_GET['users'])) {
            include('dashboardUser.php');
          } else if(isset($_GET['books'])) {
            include('dashboardBooks.php');
          } else { ?>

            <div class="container">
              <div class="row">
                <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <a href="<?= $_SERVER['PHP_SELF'] .'?users=show' ?>"> المستخدمين</a>
                        <h3><?= $users ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <a href="<?= $_SERVER['PHP_SELF'] .'?books=show' ?>"> الكتب</a>
                        <h2><?= $book ?></h2>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>


           <?php }

         ?>

</main>





<script type="" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- <script src="front/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

</body>
</html>
