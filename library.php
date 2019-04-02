<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rasmed Library</title>
    <link rel="stylesheet" href="css/library.css">  	    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    	  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">	
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="images/rasmed_favicon.png" type="image/x-icon">        
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
  <nav class="navbar navbar-inverse navbar-fixed-top" style="background:#35475E !important;">
  <div class="container-fluid">
    <div class="navbar-header">
<img src="images/rasmed_favicon.png" alt="Rasmed" style="wdith:30px;height:30px;margin:10px;cursor:pointer;margin-bottom:20px;"> <span style="color:white;font-size:25px;font-family:'Oswald',sans-serif;margin-right:10px;"> Rasmed Publications</span>
      <a class="navbar-brand" href="index.php"></a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="index.php" style="color:white;font-family:'Open Sans Condensed', sans-serif;font-size:20px;">Home</a></li>
     
    </ul>
    <form class="navbar-form navbar-right" action="" style="margin-top:10px;">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Books" name="search">
        <div class="input-group-btn">
          <button class="btn btn-success" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</nav>
<div id="container">
        <div id="inner-container">
            <div id="results"></div>
            <div id="loader"></div>

        </div>
    </div>
    
    <script type="text/javascript">
    function showRecords(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "includes/getLibraryBooks.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#loader').html('<img src="images/animated_spinner.gif" alt="reload" width="30" height="30" style="position:absolute; top:40%;left:50%;">');
    			
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