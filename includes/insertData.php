<?php 
include_once 'config.php';
    // if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //     echo "Hello";
    // }
        
   if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //echo "string";
         $bookTitle = addslashes($_POST['bookTitle']);
    $bookCategory = addslashes($_POST['bookCategory']);
    $bookCover = $_FILES['bookCover']['name'];
    $bookCover_toUpload = $bookCover;
    $tempCover = $_FILES['bookCover']['tmp_name'];
    $bookCoverType = $_FILES['bookCover']['type'];
    $bookCoverSize = $_FILES['bookCover']['size'];
    $bookCoverError = $_FILES['bookCover']['error'];
    $coverExt = explode('.', $bookCover_toUpload);
    $coverActualExt = strtolower(end($coverExt));
    $coverNameNew = uniqid('', true) ."." . $coverActualExt;
    $coverNewDestination = "../bookCovers/".$coverNameNew;
    $moveBookCover = move_uploaded_file($tempCover, $coverNewDestination);

    if(!$moveBookCover){
        printf('<script>alert.render("<strong>Error in Uploading Book Cover, Please try again Later</strong>");
                    </script>') ;
        exit();
    }

              $bookFile = $_FILES['bookFile']['name'];
    $bookFile_toUpload = $bookFile;
    $tempFile = $_FILES['bookFile']['tmp_name'];
    $bookFileType = $_FILES['bookFile']['type'];
    $bookFIleSize = $_FILES['bookFile']['size'];
    $bookFileError = $_FILES['bookFile']['error'];
    $bookExt = explode('.', $bookFile_toUpload);
    $bookActualExt = strtolower(end($bookExt));
    $bookNameNew = uniqid('', true) ."." . $bookActualExt;
    $bookNewDestination = "../bookContents/".$bookNameNew;
    $moveBookFile = move_uploaded_file($tempFile, $bookNewDestination);

    if(!$moveBookFile){
        printf('<script>alert.render("<strong>Error in Uploading Book FIle, Please try again Later</strong>");
                    </script>') ;
        exit();
    }

    if($moveBookCover === true && $moveBookFile === true){
     $insert_data = mysqli_query($con, " INSERT INTO library (book_title,book_category,book_cover, book_content) VALUES('$bookTitle','$bookCategory',
                     '$coverNewDestination','$bookNewDestination')");

            if ($insert_data) {
                echo "uploaded";
                // printf('<script>alert.render("<strong>Book Cover and Content uploaded successfully!</strong>");
                //     </script>') ;
            }else {
                echo "error";
                // printf('<script>alert.render("<strong>Error in Uploading Book Cover and Content, Please try again Later</strong>");
                //     </script>') ;
            }
            
 }
    }
    else{
        echo "nop";
    }


 ?>