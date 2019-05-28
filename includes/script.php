<?php
// session_start();
require_once 'config.php';
include_once ('alert.php'); 
?>
<?php
//For Uploading to book Content and book Cover to the database
if (isset($_POST['submitBook'])) {
        $bookTitle = addslashes($_POST['bookTitle']);
        $bookCategory = addslashes($_POST['bookCategory']);
        $bookCoverName = $_FILES['bookCover']['name'];
        $bookCover_dir = "../bookCovers/";
        $bookCover_file =  $bookCover_dir.basename($_FILES['bookCover']['name']);
        //Select file type
        $bookCoverType = strtolower(pathinfo($bookCover_file,PATHINFO_EXTENSION));
        //Validate File extensions
        $bookCover_ext = array("jpg","png","jpeg","gif");
                            //For Book File

        $bookFileName = $_FILES['bookFile']['name'];
        $bookFile_dir = "../bookContents/";
        $bookFile_file =  $bookFile_dir.basename($_FILES['bookFile']['name']);
        $bookFileType = strtolower(pathinfo($bookFile_file,PATHINFO_EXTENSION));
        $bookFile_ext = array("epub");
        //Check extension
        if(in_array($bookCoverType, $bookCover_ext) && in_array($bookFileType, $bookFile_ext)){
                //Convert to base64
            $bookCover_base64 = base64_encode(file_get_contents($_FILES['bookCover']['tmp_name']));
            $bookFile_base64 = base64_encode(file_get_contents($_FILES['bookFile']['tmp_name']));
            $cover = 'data:cover/'.$bookCoverType.';base64,'.$bookCover_base64;
            $file = 'data:file/'.$bookFileType.';base64,'.$bookFile_base64;
            //Insert into the database
            $query = "insert into library(book_title,book_category,book_cover, book_content) values('".$bookTitle."','".$bookCategory."','".$cover."','".$file."')";
            mysqli_query($con,$query);
           
             //Upload Files
            move_uploaded_file($_FILES['bookCover']['tmp_name'], $bookCover_dir.$bookCoverName);
            move_uploaded_file($_FILES['bookFile']['tmp_name'], $bookFile_dir.$bookFileName);
             if ($query) {
               
                printf('<script>alert.render("<strong>Book Cover and Content uploaded successfully!</strong>");
                    </script>');
            }
                else{
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