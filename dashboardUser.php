
<?php


if($_SERVER['REQUEST_METHOD'] == 'POST' and $_GET['users'] == 'update'):


    $sql = 'UPDATE users SET username = :username, password = :password, firstname = :firstname, lastname = :lastname WHERE id = :id';

      $stmt = $dbh->prepare($sql);

      $password =  !empty($_POST['password']) ? $_POST['password']: $_POST['old_password'];


      $data = [
        ':id' => $_POST['id'],
        ':username' => $_POST['username'],
        ':firstname' => $_POST['firstname'],
        ':lastname' => $_POST['lastname'],
        ':password' => $password,
      ];


      $stmt->execute($data);

      if($stmt->rowCount() > 0):
        echo '<div class="alert alert-success">تم تعديل المستخدم بنجاح</div>';
        header('Refresh: 3; url=dashboard.php?users=show', true, 201);
      endif;

      header('Refresh: 3; url=dashboard.php?users=show', true, 201);

   endif;


  if( $_GET['users'] == 'delete'):
    $sql = 'DELETE FROM users WHERE id = :id';

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

    if  ($stmt->execute()):
      echo '<div class="alert alert-success">تم الحذف بنجاح</div>';
      header('Refresh: 3; url=dashboard.php?users=show', true, 200);
    endif;
  endif;



?>


<div class="container">
    <div class="row">
    <?php if($_GET['users'] == 'show'): ?>


      <?php

          $sql = 'SELECT * FROM users';

          $stmt = $dbh->prepare($sql);

          $stmt->execute();

          $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

          $user_type_array = [
            'visitor'=> 'زائر',
            'admin'=> 'مدير النظام',
            'publisher'=> 'ناشر كتب',
          ]

        ?>



        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                المستخدمين
              </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#id</th>
                        <th>اسم المستخدم</th>
                        <th>البريد الالكتروني</th>
                        <!-- <th>نوع المستخدم</th> -->
                        <th>العمليات</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $user): ?>
                    
                      <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <!-- <td><?= $user_type_array[$user['user_type']] ?></td> -->
                        <td>
                          <a href="<?= $_SERVER['PHP_SELF'] .'?users=edit&id='. $user['id'] ?>" class="btn btn-info btn-sm">تعديل</a>
                          <a href="<?= $_SERVER['PHP_SELF'] .'?users=delete&id='. $user['id'] ?>" class="btn btn-danger btn-sm">حذف</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>

    <?php elseif($_GET['users'] == 'edit' && isset($_GET['id'])): ?>


      <?php

        $sql = 'SELECT * FROM users WHERE id = :id';

        $stmt = $dbh->prepare($sql);

        $stmt->execute([':id' => $_GET['id']]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);


      ?>


      <div class="card">
        <div class="card-header">
          تعديل
        </div>
        <div class="card-body">
          <form action="<?= $_SERVER['PHP_SELF'] .'?users=update' ?>" method="post">
            <input type="hidden" value="<?= $user['id'] ?>" name="id">
            <div class="form-group">
              <label for="firstname">الاسم الاول</label>
              <input class="form-control" type="text" name="firstname" id="firstname" value="<?= $user['firstname'] ?>" >
            </div>
            <div class="form-group">
              <label for="lastname">الاسم الاخير</label>
              <input class="form-control" type="text" name="lastname" id=""  value="<?= $user['lastname'] ?>">
            </div>
            <div class="form-group">
              <label for="username">اسم المستخدم</label>
              <input class="form-control" type="text" name="username" id="username"  value="<?= $user['username'] ?>">
            </div>
            <div class="form-group">
              <label for="password">كلمة المرور</label>
              <input class="form-control" type="password" name="password" id="password" >
              <input type="hidden" name="old_password" value="<?= $user['password'] ?>">
            </div>

            <button class="btn btn-primary mt-4">حفظ</button>
          </form>
        </div>
      </div>



    <?php endif; ?>








    </div>
</div>


