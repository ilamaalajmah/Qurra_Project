<?php

session_start();

include_once("connection.php");


// var_dump($_SESSION);

// $stmt = $dbh->prepare("SELECT * from users");

// $stmt->execute();

// $fetch = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($fetch);



?>



<!DOCTYPE html >
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
    <title>Libaray</title>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="front/images/logo.jpeg" alt="">
            </div>
            <ul class="list_items list-unstyled">
                <li><a href="#home">الصفحة الرئيسية</a></li>
                <li><a href="#about">نبذة عن قُـرَّأ</a></li>
                <li><a href="#why">لماذا نحن؟</a></li>
                <li><a href="#your">ارائكم</a></li>
                <li><a href="#contact">تواصل معنا</a></li>
            </ul>
            <?php if(!empty($_SESSION['user'])):  ?>

                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle text-right" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <span style="padding: 0 10px"><?php echo 'مرحبا :  '.$_SESSION["user"]["username"];  ?></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <?php if($_SESSION['user']['user_type'] == 'admin'): ?>
                        <li><a class="dropdown-item text-right" href="dashboard.php">لوحة التحكم</a></li>
                    <?php endif; ?>
                    <li><a class="dropdown-item text-right" href="logout.php">تسجيل خروج</a></li>
                </ul>
                </div>

            <?php else: ?>
                <button class="btn btn-primary">
                    <a href="login.php">دخول</a>
                </button>
            <?php endif; ?>


    </header>

    <main>

        <!-- Hearo Section -->
        <div class="hearo-section" id="home">
            <div class="hearo-text">
                <h2 class="haer-title">صنِّف كتابًا، غذِّ عقلًا</h2>
                <p class="haer-desc">
                    إن قراءة كتاب جيد تحفز خيال الأطفال، وتوسع معارفهم، وتغذي تعاطفهم، وتعزز نموهم الفكري والعاطفي، و تنقلهم إلى عوالم جديدة، وتثير فضولهم، وتلهمهم على حب القراءة والتعلم.
                </p>

                <span>صنِّف كتابك لمعرفة مدى تعقيده للأطفال واليافعين</span>

                <?php if(!empty($_SESSION['user'])):  ?>
                    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#singinModal">ادرج كتابك </button>
                <?php else: ?>
                    <button class="btn btn-primary mt-2" id="add_book">ادرج كتابك </button>
                <?php endif; ?>

            </div>
            <div class="hearo-image" >
                <!-- <img src="front/images/hero.jpg" alt="hero image"> -->
            </div>
        </div>

        <!-- Hearo Section -->
        <div class="hearo-section" id="home">
            <div class="hearo-text">
                <h2 class="haer-title">الصق محتوى الكتاب</h2>
				    <form action="rnn_result1.php" method="POST">
				    <div class="form-group">
					<input type="text" class="form-control" name="x_rnn" id="x_rnn">
					</div>
                    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#singinModal"> تحقق من</button>
					</form>
            </div>
            <div class="hearo-image" >
                <!-- <img src="front/images/hero.jpg" alt="hero image"> -->
            </div>
        </div>



        <!-- Love Reading Section -->
        <div class="love-reading" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                       <div class="reading-text">
                        <h2>
                            تصنيف الكتب يساعد <br /> الأطفال على الاستمتاع<br /> بالقراءة
                        </h2>
                        <p>
                            من خلال هذه الخدمة، حوَّل التصنيف المبتكر تعقيد كتب الأطفال إلى شيء يسهل تنظيمه. بفضل نظام التصنيف الفعّال، يمكن للكتّاب و الناشرين الآن تصنيف كتبهم ونشرها بسهولة.
                        </p>
                       </div>
                    </div>
                    <div class="col-md-6">
                        <img src="front/images/mzb0_igii_210527.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>



        <!-- Why we Read ? -->

        <div class="why-read" id="why">
            <div class="container">
            <h2>لماذا قرأ؟</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon">
                            <img src="front/images/rocket.png" alt="" width="60">
                        </div>
                        <h3>التصنيف السريع</h3>
                        <p>يقدم موقع قرأ خدمة تصنيف سريعة بسبب استخدام تقنيات التعلم العميق.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="icon">
                            <img src="front/images/star.png" alt="" width="60">
                        </div>
                        <h3> الدقة</h3>
                        <p>يهدف موقع قرأ الى تقديم خدمة تصنيف عالية الدقة وضمان نتائج تصنيف</p>
                    </div>
                    <div class="col-md-4">
                        <div class="icon">
                            <img src="front/images/reading.png" alt="" width="60">
                        </div>
                        <h3>مساعدة الكتاب والناشرين</h3>
                        <p>يساعد موقع قرأ الكتاب والناشرين على تصنيف كتبهم بطريقة أكثر فاعلية.</p>
                    </div>
                </div>
            </div>
        </div>



        <!-- reader and publishera  -->

        <div class="readers" id="your">
            <div class="container">
                <header>
                    <h2>آراء الكتاب والناشرين عن قرأ</h2>
                    <div class="icon-box">
                        <img src="front/images/quotation.png" alt="" width="50">
                    </div>
                </header>
                <div class="row">
                    <div class="col-md-6">
                        <div class="text">
                            <h3>لمى عبدالله</h3>
                            <p>ككاتبة مبتدئة في مجال كتابة قصص الأطفال واليافعين، ساعدني موقع قرأ على تقييم صعوبة كتبي لكل فئة وتعديلها حسب مستوى فهمهم</p>
                            <spam class="star">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                            </spam>
                        </div>
                        <div class="avatar">
                            <img src="front/images/woo2.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text">
                            <h3>رهف خالد</h3>
                            <p>لقد ساعدني قرأ على معرفة من هي الفئة المناسبة التي يجب علي توجيه كتبي لها </p>
                            <spam  class="star">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                            </spam>
                        </div>
                        <div class="avatar">
                            <img src="front/images/woo.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- contact us -->
        <div class="contact-us" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>لا تتردد في سؤالنا</h2>
                        <div class="form">
                            <form action="">
                                <div class="form-group">
                                    <label for="name">الايميل </label>
                                    <input type="email" class="form-control" name="name" id="name">
                                </div>
                                <div class="form-group mt-4">
                                    <label for="message">رسالتك </label>
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
                                </div>
                                <button class="btn btn-primary mt-2 w-100">إرسال</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="front/images/balon.jpg" alt="">
                    </div>

                </div>
            </div>
        </div>




        <!-- footer -->

        <div class="footer">
            <footer>
                <div class="logo">
                    <img src="front/images/logo.jpeg" alt="" width="100">
                </div>
                <div>
                    <ion-icon name="logo-instagram"></ion-icon>
                    <ion-icon name="logo-whatsapp"></ion-icon>
                </div>
                <p>جميع الحقوق محفوظة</p>
            </footer>
        </div>

    </main>






  <!-- Modal -->
  <div class="modal fade" id="singinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <form enctype="multipart/form-data" action="addBook.php" method="post" >
            <div class="modal-body">
                <h4 class="text-center">ادرج كتابك</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked value="6">
                                <label class="form-check-label" for="flexRadioDefault1">
                                اطفال (٢ - ٦)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="12">
                                <label class="form-check-label" for="flexRadioDefault2">
                                اطفال (٧ - ١٢)
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefaul3" value="16">
                                <label class="form-check-label" for="flexRadioDefault3">
                                مراهق (١٣ - ١٦)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" value="17">
                                <label class="form-check-label" for="flexRadioDefault4">
                                مراهق (١٤ - ١٧)
                                </label>
                            </div>
                        </div>
                        </div>
                    </div>
                    <input type="file" name="book" />

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </form>
      </div>
    </div>
  </div>


    <script type="" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- <script src="front/js/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

    <script>

        // The constructor of Dropzone accepts two arguments:
        //
        // 1. The selector for the HTML element that you want to add
        //    Dropzone to, the second
        // 2. An (optional) object with the configuration


        function addBookBtn() {
                let login = true;

                if(login) {
                    Swal.fire({
                        title: ' يجب عليك تسجيل الدخول اولا  هل تريد الاستمرار؟',
                        icon: 'question',
                        iconHtml: '؟',
                        confirmButtonText: 'نعم',
                        cancelButtonText: 'لا',
                        showCancelButton: true,
                        showCloseButton: true
                        }).then(isOk => {
                            if(isOk.isConfirmed) {
                                location.href = 'login.php'
                            } else {
                                // var myModal = new bootstrap.Modal(document.getElementById('singinModal'))
                                // myModal.show()
                            }
                        })
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Do you want to continue',
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    }).then(isOk => {
                        location.href = 'http://google.com'
                    })
                }

        }

        document.querySelector('#add_book').addEventListener('click', addBookBtn)



    </script>
</body>
</html>
<?php unset($_SESSION['rating']) ?>
