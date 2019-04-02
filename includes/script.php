<?php
// session_start();
require_once 'config.php';
?>

<?php
//For Uploading to books to the database
if (isset($_POST['submitBook'])) {
    $bookTitle = strip_tags(htmlspecialchars($_POST['bookTitle']));
    $bookCategory = strip_tags(htmlspecialchars($_POST['bookCategory']));
    //To save Book Cover to the root folder
    $book_cover = $_FILES['bookCover']['tmp_name'];
        $file = $_FILES['bookCover']['name'];
        $fileFolder = "../bookCovers/";
        $joinBookCover = $fileFolder.$file;
        $saveBookCover = move_uploaded_file($book_cover,$joinBookCover);
        //To save Book Content to the root folder
         $book_file = $_FILES['bookFile']['tmp_name'];
        $fileContent = $_FILES['bookFile']['name'];
        $fileDir = "../bookContents/";
        $joinBookContent = $fileDir.$fileContent;
        $saveBookContent = move_uploaded_file($book_file,$joinBookContent);

    $insert_data = mysqli_query($con, " INSERT INTO library (book_title,book_category,book_cover, book_content) VALUES('$bookTitle','$bookCategory',
    '$joinBookCover','$joinBookContent')");
            if ($insert_data) {
                    	printf('<script>alert("Book Uploaded Successfully!");
 					window.location = "../admin/dashboard.php";
 					</script>') ;
            }
            else {
                	printf('<script>alert("Error in Uploading!");
 					window.location = "../admin/dashboard.php";
 					</script>') ;
            }
}
?>

<?php
//For registering more Admin login details to the database

if (isset($_POST['addAdmin'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = sha1($_POST['password']);

    $insert_admin = mysqli_query($con, "INSERT INTO admin (username, password) VALUES('$username', '$password')");

    if ($insert_admin) {
         	printf('<script>alert("Admin details Added!");
 					window.location = "../admin/dashboard.php";
 					</script>') ;
    }
    else {
        printf('<script>alert("Error in inserting details!");
 					window.location = "../admin/dashboard.php";
 					</script>') ;
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