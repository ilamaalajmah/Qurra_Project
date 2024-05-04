<?php

session_start();

require_once(dirname(__FILE__) ."/connection.php");




if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $file_type = explode('.', $_FILES['book']['name'])[1];


    $upload_path = dirname(__FILE__) ."/upload/";

    $filename = rand(0,999999999) .basename($_FILES['book']['name']);

    $upload_file = $upload_path . rand(0,999999999) .basename($_FILES['book']['name']);

    $errors = [];
    if($file_type != 'txt' && $file_type != 'docx' && $file_type != 'doc') {
        $errors[] = 'upload only text and word file only ';
    }



    if  (empty($errors)  and move_uploaded_file($_FILES['book']['tmp_name'], $upload_file)) {

        $book_name =  $_FILES['book']['name'];
        $book_path = $upload_file;
        $user_id = $_SESSION['user']['id'];
        $status= $_POST['flexRadioDefault'];



        $sql = 'INSERT into books (user_id, book_name, book_path, status) VALUES(:user_id, :book_name, :book_path, :status)';

        $stmt = $dbh->prepare($sql);

        $stmt->execute(array(
                ':user_id'=> $user_id,
                ':book_name'=> $filename,
                ':book_path'=> $book_path,
                ':status' => $status));

        echo "<p class='alert alert-success'>uploaded File with id ". $dbh->lastInsertId() . ' Successfuly</p>';
        header('Refresh: 3; url=index.php', true, 201);

    } else {

        echo'<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo '<div>'. $error .'</div>';
        }
        echo '</div>';

        $_SESSION['rating'] =  $status;
        header('Refresh: 3; url=index.php', true, 303);
    }

    echo'redirecting...';

} else {
    echo $_SERVER['REQUEST_METHOD'];
}


