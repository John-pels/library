<?php
require_once "config.php";


if (! (isset($_GET['pageNumber']))) {
    $pageNumber = 1;
} else {
    $pageNumber = $_GET['pageNumber'];
}

$perPageCount = 5;
$rowCount = "";

$sql = "SELECT * FROM library  WHERE 1";

if ($result = mysqli_query($con, $sql)) {
    $rowCount = mysqli_num_rows($result);
    mysqli_free_result($result);
}

$pagesCount = ceil($rowCount / $perPageCount);

$lowerLimit = ($pageNumber - 1) * $perPageCount;

$sqlQuery = " SELECT * FROM library WHERE 1 limit " . ($lowerLimit) . " ,  " . ($perPageCount) . " ";
$results = mysqli_query($con, $sqlQuery);

?>



        <div class="container">
           
            <div class="row" style="margin-left:150px;">
                 <?php
                if (is_array($results) || is_object($results)) {
                    foreach ($results as $data) {
                        ?>
                <div class="col-lg-2 col-md-2 col-sm-2  col-xs-6 ">
                    	<div class="book-wrap">
                      <a href="<?php echo $data['book_content']?>" target="_blank">
									<img src="<?php echo $data['book_cover']?>" alt="Book cover" class="img-responsive" style="width:145px;height:100px;display:block;">
									<div class="overlay">
										<div class="text"><?php echo $data['book_title']?></div>
									</div>
                  </a>
								</div>

                </div>
                <?php
                    }
                }
                ?>
                <!-- Next -->
            </div>
    
<br> <br>
                
<table width="50%" align="center">
    <tr>

        <td valign="top" align="left"></td>


        <td valign="top" align="center">
            <?php
    for ($i = 1; $i <= $pagesCount; $i ++) {
    if ($i == $pageNumber) {
        ?> <a href="javascript:void(0);" class="current" style="text-decoration:none;">
                <?php echo $i ?>
        </a> <?php
    } else {
        ?> <a href="javascript:void(0);" class="pages"
            onclick="showRecords('<?php echo $perPageCount;  ?>', '<?php echo $i; ?>');" style="text-decoration:none;">
                <?php echo $i ?>
        </a> <?php
    } // endIf
} // endFor

?>
            
        </div>
   
<!-- </div>             -->
    


