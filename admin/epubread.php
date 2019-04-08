<?php
require_once "../includes/config.php";

if (isset($_GET['C'])) {
  $id = base64_decode($_GET['C']);

  $get = mysqli_query($con,"SELECT * FROM library WHERE id = '$id'");
  $fetch = mysqli_fetch_array($get);
  extract($fetch);

}
?>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $fetch['book_title'];?></title>
    <meta name="description" content="">

    <link rel="stylesheet" href="/css/main.css">
    <script async="" src="//www.google-analytics.com/analytics.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">	
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">	
    <link rel="shortcut icon" href="../images/rasmed_favicon.png" type="image/x-icon">        
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/epubjs/dist/epub.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
  <style>
  body {
    background: #D5DAE5;
  }
  .container {
    background: #FFF;
  }
  .arrow-left {
    position: absolute;
    top:350px;
    cursor:pointer;
    border: 2px solid grey;
    font-size:30px;
    text-align:center;
    height:35px;
    width:50px;
  }
  .arrow-left:hover{
    border: 2px solid green;
  }
  .arrow-right {
    position: absolute;
    top:350px;
    right:10px;
    cursor:pointer;
    border: 2px solid grey;
    font-size:30px;
    text-align:center;
    height:35px;
    width:50px;
  }
  .arrow-right:hover{
    border: 2px solid green;
  }
  .jumbotron {
    color: green;
    font-size:50px;
    font-family: 'Open Sans Condensed', sans-serif;
  }
  @media only screen and (max-width:767px){
    .arrow-right {
      position:absolute;
      right:0;
      top: -720px;
      width:40px;

    }
    .arrow-left{
      position: absolute;
      left:0;
      width:40px;
    }
  }
  </style>

</head>


  <body cz-shortcut-listen="true">







<div class="container">
  <div class="row">
  <div class="jumbotron">
      <strong><center><?php echo $fetch['book_title'];?></center></strong>
  </div>
    <div class="col-sm-2"><div id="prev" onclick="rendition.prev();" class="arrow-left"><i class="fa fa-angle-left"></i></div></div>
    <div class="col-sm-8" id="area"></div>
      <div class="col-sm-2">
      <div id="next" onclick="rendition.next();" class="arrow-right"><i class="fa fa-angle-right"></i>
      </div></div>
  </div>
</div> 
<script>
   var book = ePub("http://localhost/books_library/admin/<?php echo($book_content); ?>");

  var rendition = book.renderTo("area", { width: "90%", height: "100%" });

   rendition.display();
</script>
</body></html>