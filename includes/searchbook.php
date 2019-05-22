<?php
require 'config.php';
if (isset($_POST['search'])) {
	echo "<div class='container'>
           
            <div class='row'>";
    $search = $_POST['search'];
  		
  		$searchbooks = mysqli_query($con,"SELECT * FROM library WHERE book_title LIKE '%$search%'");
  		$count = mysqli_num_rows($searchbooks);
  		if ($count > 0) {
  			while ($fetchbooks = mysqli_fetch_array($searchbooks)) {
  					?>
  						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 ">
                    	<div class="book-wrap">
                    		<a href="epub2.php?C=<?php echo base64_encode($fetchbooks['id']); ?>" target="_blank">

                   									<img src="<?php echo str_replace("../","",$fetchbooks['book_cover'])?>" alt="Book cover" class="img-responsive" style="width:145px;height:100px;display:block;">
									<div class="overlay">
										<div class="text"><?php echo $fetchbooks['book_title']?></div>
									</div>
                  </a>

								</div>

                </div>
  					<?php
  			}
  		}
  		else{
  			echo "<center><div class='alert alert-info' style='font-size:2rem;margin-top:70px;'><b>\"$search\"</b> not found in the Library</div></center>";
  		}
  	}
  		?>
  	</div>
  </div>