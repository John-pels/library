<?php 



 $bookTitle = addslashes($_POST['bookTitle']);
    $bookCategory = addslashes($_POST['bookCategory']);
    $bookCover = $_FILES['bookCover']['name'];
    $bookCover_toUpload = $bookCover;
    $tempCover = $_FILES['bookCover']['tmp_name'];
    $bookCoverType = $_FILES['bookCover']['type'];
    $bookCoverSize = $_FILES['bookCover']['size'];
    $bookCoverError = $_FILES['bookCover']['error'];
    $moveBookCover = move_uploaded_file($tempCover, "../bookCovers/$bookCover_toUpload");

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
    $moveBookFile = move_uploaded_file($tempFile, "../bookContents/$bookFile_toUpload");

    if(!$moveBookFile){
        printf('<script>alert.render("<strong>Error in Uploading Book FIle, Please try again Later</strong>");
                    </script>') ;
        exit();
    }

    if($moveBookCover === true && $moveBookFile === true){
     $insert_data = mysqli_query($con, " INSERT INTO library (book_title,book_category,book_cover, book_content) VALUES('$bookTitle','$bookCategory',
                     '$moveBookCover','$moveBookFile')");

            if ($insert_data) {
                printf('<script>alert.render("<strong>Book Cover and Content uploaded successfully!</strong>");
                    </script>') ;
            }else {
                printf('<script>alert.render("<strong>Error in Uploading Book Cover and Content, Please try again Later</strong>");
                    </script>') ;
            }
            
 }
 ?>




<?php 

 $bookTitle = addslashes($_POST['bookTitle']);
    $bookCategory = addslashes($_POST['bookCategory']);
    
                     $book_cover = $_FILES['bookCover'];
            $fileName1 = $_FILES['bookCover']['name'];
            $fileTmpName1 = $_FILES['bookCover']['tmp_name'];
            $fileSize1 = $_FILES['bookCover']['size'];
            $fileError1 = $_FILES['bookCover']['error'];
            $fileType1 = $_FILES['bookCover']['type'];
                $fileExt1 = explode('.', $fileName1);
                $fileActualExt1 = strtolower(end($fileExt1));
                $allowed1 = array('jpg','png','jpeg');
                   
        $book_file = $_FILES['bookFile'];
        $fileName = $_FILES['bookFile']['name'];
        $fileTmpName = $_FILES['bookFile']['tmp_name'];
        $fileSize = $_FILES['bookFile']['size'];
        $fileError = $_FILES['bookFile']['error'];
        $fileType = $_FILES['bookFile']['type'];
                $fileExt = explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('epub');
                    if(in_array($fileActualExt,$allowed) && in_array($fileActualExt1,$allowed1)){
                            if($fileError === 0 && $fileError1 === 0){
                                    if($fileSize <= 40000000 && $fileSize1 <= 4000000){
                                                $fileNameNew = uniqid('', true) ."." . $fileActualExt;
                                                $fileNameNew1 = uniqid('', true) .".". $fileActualExt1;
                                                $fileDestination = '../bookContents/'. $fileNameNew;
                                                $fileDestination1 = '../bookCovers/' . $fileNameNew1;
                                                move_uploaded_file($fileTmpName, $fileDestination);
                                                move_uploaded_file($fileTmpName1, $fileDestination1);
                    $insert_data = mysqli_query($con, " INSERT INTO library (book_title,book_category,book_cover, book_content) VALUES('$bookTitle','$bookCategory',
                     ' $fileDestination1','$fileDestination')");
            if ($insert_data) {
                        printf('<script>alert.render("Book Uploaded Successfully!");
                
                    </script>');
            }
            else {
                    printf('<script>alert.render("Error in connecting to database!");
                
                    </script>');
            }
                                    }
                                    else {
                                        printf('<script>alert.render("The Book Size is too large to Upload!");
                                     
                                        </script>') ;
                                    }
                            }
                            else {
                                printf('<script>alert.render("There was an Error Uploading the Book!");
                
                    </script>') ;
                            }
                    }
                    else {
                        printf('<script>alert.render("You cannot Upload Ebooks of this Type!");
                
                    </script>') ;
                    }
                

}

 ?>

 <?php 


if(isset($_POST['but_upload'])){
 
  $name = $_FILES['file']['name'];
  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
    // Convert to base64 
    $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
    // Insert record
    $query = "insert into images(image) values('".$image."')";
    mysqli_query($con,$query);
  
    // Upload file
    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
  }
 
}
  ?>

        $bookFileName = $_FILES['bookFile']['name'];
        $bookFile_dir = "../bookContents/";
        $bookFile_file =  $bookFile_dir.basename($_FILES['bookFile']['name']);
        $bookFileType = strtolower(pathinfo($bookFile_file,PATHINFO_EXTENSION));
        $bookFile_ext = array("epub");
        