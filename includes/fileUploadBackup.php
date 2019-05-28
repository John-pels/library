<?php 

 $bookTitle = addslashes($_POST['bookTitle']);
    $bookCategory = addslashes($_POST['bookCategory']);
    //To save Book Cover to the root folder
    // $book_cover = $_FILES['bookCover']['tmp_name'];
    //     $file = $_FILES['bookCover']['name'];
    //     $fileFolder = "../bookCovers/";
    //     $joinBookCover = $fileFolder.$file;
    //     $saveBookCover = move_uploaded_file($book_cover,$joinBookCover);
           
                    //                 }
                    //                 else {
                    //                     printf('<script>alert.render("The Book Size is too large to Upload!");
                                    
                    //                     </script>') ; 
                    //                 }
                    //         }
                    //         else {
                    //             printf('<script>alert.render("There was an Error Uploading the Book!");
                               
                    //             </script>') ;
                    //         }
                    // }
                    // else{
                    //     printf('<script>alert.render("You cannot Upload Book Cover of this Type!");
                       
                    //     </script>') ;
                    // }
    
        //To save Book Content to the root folder
        //  $book_file = $_FILES['bookFile']['tmp_name'];
        // $fileContent = $_FILES['bookFile']['name'];
        // $fileDir = "../bookContents/";
        // $joinBookContent = $fileDir.$fileContent;
        // $saveBookContent = move_uploaded_file($book_file,$joinBookContent);
                     $book_cover = $_FILES['bookCover'];
            $fileName1 = $_FILES['bookCover']['name'];
            $fileTmpName1 = $_FILES['bookCover']['tmp_name'];
            $fileSize1 = $_FILES['bookCover']['size'];
            $fileError1 = $_FILES['bookCover']['error'];
            $fileType1 = $_FILES['bookCover']['type'];
                $fileExt1 = explode('.', $fileName1);
                $fileActualExt1 = strtolower(end($fileExt1));
                $allowed1 = array('jpg','png','jpeg');
                    // if(in_array($fileActualExt1,$allowed1)){
                    //         if($fileError1 === 0){
                    //                 if($fileSize1 < 5000000){
                    //                             $fileNameNew1 = uniqid('',true) ."." . $fileActualExt1;
                    //                             $fileDestination1 = '../bookCovers/'. $fileNameNew1;
                    //                             move_uploaded_file($fileTmpName1, $fileDestination1);
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