<?php
// session_start();
require_once 'config.php';
include_once ('alert.php');
?>
<?php
//For Uploading to books to the database
if (isset($_POST['submitBook'])) {
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

<?php
//For registering more Admin login details to the database

if (isset($_POST['addAdmin'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = sha1($_POST['password']);
    $check =  mysqli_query($con, "SELECT * FROM admin");
    $row = mysqli_num_rows($check);
        $verify = mysqli_fetch_array($check);
        if($username === $verify['username']){
                printf('<script>alert.render("Username already Exist!");
                    </script>') ;
        }
    

    else {
        $insert_admin = mysqli_query($con, "INSERT INTO admin (username, password) VALUES('$username', '$password')");
            if ($insert_admin) {
            printf('<script>alert.render("Admin details Added!");
                    </script>') ;
    }
    else {
        printf('<script>alert.render("Error in inserting details!");
                    </script>') ;
    }
    
    }
    
}
?>

<?php
//For Administrator Login

$error_message = "";
if (isset($_POST['adminLogin'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = sha1($_POST['password']);

    $select_adminDetails = mysqli_query($con," SELECT * FROM admin WHERE username = '$username' && password = '$password' ");
    $row = mysqli_num_rows($select_adminDetails);
    $fetch = mysqli_fetch_array($select_adminDetails);
            if($row == 1)
            {
                $_SESSION['id'] = $fetch['id'];
                $_SESSION['username'] = $fetch['username'];
                        header("Location: ../admin/dashboard.php");
            }
            else {
                $error_message =  "<div class = 'alert alert-danger' role ='alert'>Invalid Username or Password </div>";
            }
} 

?>

<?php
//For displaying the Published book Categories

$select_primary = mysqli_query($con, "SELECT * FROM library WHERE book_category = 'Primary Schools'");
$primary_rows = mysqli_num_rows($select_primary);
$fetch_primary = mysqli_fetch_array($select_primary);
// $primaryBooks = $fetch['id'];

$select_secondary = mysqli_query($con, "SELECT * FROM library WHERE book_category = 'Secondary Schools'");
$secondary_rows = mysqli_num_rows($select_secondary);
$fetch_secondary = mysqli_fetch_array($select_primary);

$select_tertiary = mysqli_query($con, "SELECT * FROM library WHERE book_category = 'Tertiary Institutions'");
$tertiary_rows = mysqli_num_rows($select_tertiary);
$fetch_tertiary = mysqli_fetch_array($select_primary);



 ?>