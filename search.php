<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link href="_/css/bootstrap.css" rel="stylesheet">
    <link href="_/css/mystyles.css" rel="stylesheet">
    
    <!-- Google API Script (Needs to be loaded before "myscript.js") -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
    <!--  google map api -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGHfbO0-f12Zl2IhbFRp6NFEvtyY1zgGE"></script>
    
    
    
  </head>
  <body id="search">
    <section class="container">
      <?php include '_/components/php/header.php' ?> 
      <div class="searchComp row">
        <div class="col-sm-12 col-md-3 col-lg-3 ">
          <?php include '_/components/php/formMenu.php' ?>
        </div><!-- col-md-3 -->
        <div class="col-sm-12 col-md-9 col-lg-9 ">
          <?php include '_/components/php/tabMenu.php' ?>
        </div><!-- col-md-9 -->
      </div><!-- row -->
    </section><!-- container -->
    
    <!-- Scripts -->
    <script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>
    <!--<script src="_/js/graph.js"></script>
      <script src="_/js/statisticSummary.js"></script> -->
  </body>
</html>