<?php
require_once "includes/config.php";

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
    <link rel="shortcut icon" href="images/rasmed_favicon.png" type="image/x-icon">        
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
    scroll-behavior:smooth;
  }
  .arrow-left {
    position:fixed;
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
    position:fixed;
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
    position:sticky;
    top:0;
    z-index:999;
  }
  @media only screen and (max-width: 600px){
    .jumbotron {
      font-size: 2.5rem;
    }
    #area{
      margin-left: 35px;
    }
    .arrow-left {
      position: fixed;
      top:500px;
      left: 0;
    }
    .arrow-right{
      position: fixed;
      top:500px;
      right: 0;
    }

  }
  @media only screen and (min-width: 601px){
     .jumbotron {
      font-size: 3.5rem;
    }
    #area{
      margin-left: 35px;
    }
    .arrow-left {
      position: fixed;
      top:500px;
    }
    .arrow-right{
      position: fixed;
      top:500px;
      right: 20px;
    }

  }
  @media only screen and (min-width: 768px) and (max-width:900px){
     .jumbotron {
      font-size: 4rem;
    }
    #area{
      margin-left: 35px;
    }
    .arrow-left {
      position: fixed;
      top:500px;
      left: 95px;
    }
    .arrow-right{
      position: fixed;
      top:500px;
      right: 100px;
    }

  }
  @media only screen and (min-width: 901px) and (max-width:1200px){
     .jumbotron {
      font-size: 4.5rem;
    }
    #area{
      margin-left: 35px;
    }
    .arrow-left {
      position: fixed;
      top:500px;
      left: 150px;
    }
    .arrow-right{
      position: fixed;
      top:500px;
      right: 130px;
    }

  }
   @media only screen and  (min-width:1201px) and (max-width: 1550px){
     .jumbotron {
      font-size: 4.5rem;
    }
    #area{
      margin-left: 35px;
    }
    .arrow-left {
      position: fixed;
      top:500px;
      left: 230px;
    }
    .arrow-right{
      position: fixed;
      top:500px;
      right: 230px;
    }

  }
   @media only screen and  (min-width:1552px) and (max-width: 1920px){
     .jumbotron {
      font-size: 4.5rem;
    }
    #area{
      margin-left: 35px;
    }
    .arrow-left {
      position: fixed;
      top:500px;
      left:400px;
    }
    .arrow-right{
      position: fixed;
      top:500px;
      right: 400px;
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
   var book = ePub("http://localhost/books_library/<?php echo str_replace("../","",$book_content); ?>");

  var rendition = book.renderTo("area", { width: "90%", height: "100%" });

   rendition.display();
</script>
</body></html>