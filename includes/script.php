<?php
// session_start();
require_once 'config.php';
include_once ('alert.php'); 
?>
<!-- For uploading of books -->
<?php 
        
    if (isset($_POST['submitBtn'])) {
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
                printf('<script>alert.render("<strong>Book Cover and Content uploaded successfully!</strong>");
                    </script>') ;
            }else {
                printf('<script>alert.render("<strong>Error in Uploading Book Cover and Content, Please try again Later</strong>");
                    </script>') ;
            }
            
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