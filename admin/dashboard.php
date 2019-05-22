<?php
require_once "../includes/session.php";
require_once "../includes/script.php";
// $admin_id = $_SESSION['id'];
// $user = mysqli_query($con, "SELECT * FROM admin where id = '$admin_id'");
// $user_rows = mysqli_num_rows($user);
// $fetch_user = mysqli_fetch_array($user);
// $user_name = $fetch_user['username'];
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Administrator Dashboard</title>
	  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">	
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">	  	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../images/rasmed_favicon.png" type="image/x-icon">        
		<link rel="stylesheet" href="../css/admin_dashboard.css">
		<style>
      #inner-container {
    width: 1000px;
    max-width: 100%;
    padding: 20px 0 70px 0;
    height: 100%;
}

#container {
		min-height: 100%;
    padding: 20px;
    border-radius: 2px;
}
.loader{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.56);
    z-index: 999;
    display:none;
}

.pages {
    padding: 10px 14px;
    color: #000000;
    border-radius: 50%;
    background: #CCC;
    text-decoration: none;
    margin: 0px 6px;
    font-size: 0.9em;
}

.pages:hover {
    color: #ffffff;
    background: #666;
}

.current {
    padding: 10px 14px;
    color: #ffffff;
    background: #73AD21;
    text-decoration: none;
    border-radius: 50%;
    margin: 0px 6px;
}
    </style>
	</head>
	<body>
		<div class="header">
			<div class="logo">
				<img src="../images/rasmed_favicon.png" alt="logo" style="width:20px; height:20px;">
				<span>Rasmed Publications</span>
			</div>
			<a href="#" class="nav-trigger"><span></span></a>
		</div>
		<div class="side-nav">
			<div class="logo">
				<img src="../images/rasmed_favicon.png" alt="logo" style="width:20px; height:20px;">
				<span>Rasmed Publications</span>
			</div>
			<nav>
				<ul>
					<li>
						<a href="javascript:void(0);">
							<span><i class="fa fa-user"></i></span>
							<span>Dashboard</span>
						</a>
					</li>
          <li>
						<a href="../index.php" target="_blank">

							<span><i class="fa fa-home"></i></span>
							<span>Library</span>
						</a>
					</li>
					<li>
						<a href="#">

							<span><i class="fa fa-book"></i></span>
							<span data-target ="#addBooks" data-toggle ="modal">Add books</span>
						</a>
					</li>
					<li class="active">
						<a href="#">
							<span><i class="fa fa-bar-chart"></i></span>
							<span  data-target ="#viewUploadedBooks" data-toggle ="modal">Published books</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span><i class="fa fa-user-plus"></i></span>
							<span data-target ="#addAdmin" data-toggle ="modal">Add Admin</span>
						</a>
					</li>
					<li>
						<a href="../includes/logout.php?<?php echo $_SESSION['id'];?>" onclick = "return confirm ('Are you sure you want to Logout?')">
							<span><i class="fa fa-angle-double-left"></i></span>
							<span>Logout</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="main-content">
		 
			<div class="title">
		<p>Welcome! &nbsp;<span style="color:green;"><?php echo $_SESSION['username'];?></span></p>	
			</div>
			</div>
			<div class="main">
				<div class="widget">
					<div class="title">Books Catalogue
  <!-- inline seach button starts here -->  
  <form class="navbar-form navbar-right" action="" style="line-height:25px;">
  <div class="input-group">
    <input type="text" class="form-control" placeholder="search Books" id="search" name="search">
    <div class="input-group-btn">
      <button class="btn btn-success" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
</form>
  <!-- inline seach button ends here -->
				</div>
			<div id="container">
        <div id="inner-container">
            <div id="results"></div>
            <div id="loader"></div>

        </div>
    </div>


  
			</div>
		</div>
    <script src="js/jquery.js" type="text/javascript"></script>

<script>
    $("#search").keyup(function(){
            //e.preventDefault();
           var search = $(this).val();
           if (search=='') {
            $("#results").load("../includes/getBooks.php");
           }
           else if (search.length < 1) {
           // $("#showsearchR").hide();
            $("#results").show();


           }
          /* else if (search.length == 0) {
            $("#result").load("includes/getLibraryBooks.php");
            
           }*/
           else{
            $.ajax({
                type: "POST",
                url: "../includes/admin_searchLibrary.php",
                data: {search:search},
                success: function(data){
                   // $("#results").hide();
                    setTimeout(function(){
                      //  $("#results").hide();
                        $("#results").html(data);
                    },200);
                    if (data=='No book found') {
                        $("#results").html("No Book Found");

                    }
                    
                }
            });
           }
    });
</script>
<script>
	$(document).ready(function() {
	$('.nav-trigger').click(function() {
		$('.side-nav').toggleClass('visible');
	});
});
</script>
  <script type="text/javascript">
    function showRecords(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "../includes/getBooks.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#loader').html('<img src="../images/animated_spinner.gif" alt="reload" width="50" height="50" style="position:absolute; top:40%;left:50%;">');
    			
            },
            success: function(html) {
                $("#results").html(html);
                $('#loader').html(''); 
            }
        });
    }
    
    $(document).ready(function() {
        showRecords(10, 1);
    });
         </script>   
	</body>
</html>
<!--For Addition of more books-->
<div class="modal fade" id="addBooks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size:25px;">Upload new Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="exampleInputname">Book Title</label>
          <input type="text" class="form-control" id="bookTitle" name="bookTitle" aria-describedby="bookTitle" placeholder="Book Title" required="">
		</div>
		   <div class="form-group">
          <label for="exampleInputname">Book Category</label>
          <select name="bookCategory" id="bookCategory" class="form-control"  aria-describedby="bookCategory">
					<option value="" selected> Select Category</option>
					<option value="Primary Schools">Primary Schools</option>
					<option value="Secondary Schools">Secondary Schools</option>
					<option value="Tertiary Institutions">Tertiary Institutions</option>
					</select>
        </div>
        <div class="form-group">
          <label for="exampleInputTitle">Book Cover <span style="color:#FF0000;">(JPG,JPEG and PNG only)*</span></label>
          <input type="file" class="form-control" id="bookCover" name="bookCover" placeholder="Book Cover"  required="">
        </div>
         <div class="form-group">
          <label for="exampleInputPassword1">Book file  <span style="color:#FF0000;">(EPUB Books only)*</span> </label>
          <input type="file" class="form-control" id="bookFile" name="bookFile" placeholder=" Book File" required="">
        </div>
        
        <button type="submit" class="btn btn-success" name="submitBook" style="width: 100%;">Upload</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<!--For Addition of Administrator-->
<div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size:25px;">Add Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="exampleInputname">Username</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Username" required="">
		</div>
		   <div class="form-group">
          <label for="exampleInputname">Password</label>
          <input type="password" class="form-control" id="password" name="password" aria-describedby="password" placeholder="Password" required="">
        </div>
        
        <button type="submit" class="btn btn-success" name="addAdmin" style="width: 100%;">Add</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<!-- For Total Uploaded books view -->
<div class="modal fade" id="viewUploadedBooks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong style="font-size:25px;">Uploaded Books Categories</strong> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div style="font-size:25px;">Primary School Books:  <span style="background:#FF0000;border-radius:10px;font-weight:900; color:#FFF; font-size:25px;"><?php echo $primary_rows;?></span></div>
        <p style="font-size:25px;">Secondary School Books:  <span style="background:#FF0000;border-radius:10px;font-weight:900; color:#FFF; font-size:25px;"><?php echo $secondary_rows;?></span></p>
        <p style="font-size:25px;">Tertiary School Books:  <span style="background:#FF0000;border-radius:10px;font-weight:900; color:#FFF; font-size:25px;"><?php echo $tertiary_rows;?></span></p>		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>