


<div class="container">
    <div class="row">
    <?php if($_GET['books'] == 'show'): ?>


      <?php

          $sql = 'SELECT * FROM books';

          $stmt = $dbh->prepare($sql);

          $stmt->execute();

          $books = $stmt->fetchAll(PDO::FETCH_ASSOC);


        ?>



        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                الكتب
              </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#id</th>
                        <th>اسم الناشر</th>
                        <th>اسم الكتاب</th>
                        <th>التقييم</th>
                        <!-- <th>العمليات</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($books as $book): ?>

                      <tr>
                      <td><?= $book['id'] ?></td>

                        <td><?php



                          $sql = 'SELECT username FROM users WHERE id = '.$book['user_id'] ;

                          $stmt = $dbh->prepare($sql);

                          $stmt->execute();

                          $user = $stmt->fetch(PDO::FETCH_ASSOC);

                          echo $user['username']

                        ?></td>
                        <td><?= $book['book_name'] ?></td>
                        <td><?= $book['status'] ?></td>
                        <td style="display: none;">
                          <!-- <a href="<?= $_SERVER['PHP_SELF'] .'?books=edit&id='. $book['id'] ?>" class="btn btn-info btn-sm">تعديل</a> -->
                          <a href=""<?= $_SERVER['PHP_SELF'] .'?books=delete&id='. $book['id'] ?>" class="btn btn-danger btn-sm">حذف</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>

    <?php elseif($_GET['books'] == 'edit' && isset($_GET['id'])): ?>


      <?php

        $sql = 'SELECT * FROM books WHERE id = :id';

        $stmt = $dbh->prepare($sql);

        $stmt->execute([':id' => $_GET['id']]);

        $book = $stmt->fetch(PDO::FETCH_ASSOC);


      ?>


      <div class="card">
        <div class="card-header">
          تعديل
        </div>
        <div class="card-body">
          <form action="<?= $_SERVER['PHP_SELF'] .'?books=update' ?>" method="post">
            <input type="hidden" value="<?= $book['id'] ?>" name="id">
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

      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <a href=""> المستخدمين</a>
              <h3><?= $result ?></h3>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <a href=""> الكتب</a>
              <h2><?= $book ?></h2>
            </div>
          </div>
        </div>
      </div>


    <?php endif; ?>








    </div>
</div>


