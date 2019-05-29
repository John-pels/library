<?php 
if (isset($_POST['submitBtn'])) {
	// $bookTitle = $_POST['bookTitle'];
	// $bookCategory = $_POST['bookCategory'];
	// 	$bookFile = $_FILES['bookFile'];
			$bookFileType = $_FILES['bookFile']['type'];
				$bookFile_tmp = $_FILES['bookFile']['tmp_name'];
				$targetPath = "../bookContents/".$_FILES['bookFile']['name'];
					$movefile = move_uploaded_file($bookFile_tmp, $targetPath);

}

 ?>