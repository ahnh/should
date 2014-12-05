<?php include 'query-frontpage.php' ?>

<div id="heroCarousel" class="carousel slide" data-interval="3000">
   <!-- Indicators -->
   <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      <li data-target="#carousel-example-generic" data-slide-to="3"></li>
      <li data-target="#carousel-example-generic" data-slide-to="4"></li>
      <li data-target="#carousel-example-generic" data-slide-to="5"></li>
   </ol>

   <!-- Wrapper for slides -->
   <div class="carousel-inner">
      <!-- 1st slide -->
      <div class="item active">
          <div class="cropCarsouselImg">
            <img src="_/img/toronto_reflections_canada-wide.jpg" alt="">
          </div>
         <div class="carousel-caption"> 
            <h1>Highest Incidents of Crime: <?php echo "Sector " . $dangerous[0]['sector']; ?></h1>
         </div>
      </div>

       <div class="item">
          <div class="cropCarsouselImg">
            <img src="_/img/park.jpg" alt="">
          </div>
         <div class="carousel-caption"> 
            <h1>Lowest Incidents of Crime: <?php echo "Sector " . $safe[0]['sector']; ?></h1>
         </div>
      </div>

      <!-- 2nd slide - expensive detached -->
      <div class="item">
          <div class="cropCarsouselImg">
            <img src="_/img/bridle.jpg" alt="">
          </div>
         <div class="carousel-caption"> 
            <h1>Most Expensive Place to Buy a Detached House: <?php echo "Sector " . $expensiveBuy[0]['sector']; ?></h1>
         </div>
      </div>

      <!-- 3rd slide - cheap detached -->
      <div class="item">
          <div class="cropCarsouselImg">
            <img src="_/img/DSC07701.jpg" alt="">
          </div>
         <div class="carousel-caption"> 
            <h1>Cheapest Place to Buy a Detached House: <?php echo "Sector " . $cheapestBuy[0]['sector']; ?></h1>
         </div>
      </div>

      <!-- 4th slide - expensive 3-bedroom -->
      <div class="item">
          <div class="cropCarsouselImg">
            <img src="_/img/apartment.jpg" alt="">
          </div>
         <div class="carousel-caption"> 
            <h1>Most Expensive Place to Rent a Three-Bedroom Apartment: <?php echo "Sector " . $expensive[3]['sector']; ?></h1>
         </div>
      </div>

      <!-- 4th slide - cheapest 3-bedroom -->
      <div class="item">
          <div class="cropCarsouselImg">
            <img src="_/img/apartment2.jpg" alt="">
          </div>
         <div class="carousel-caption"> 
            <h1>Cheapest Place to Rent a Three-Bedroom Apartment: <?php echo "Sector " . $cheapest[3]['sector']; ?></h1>
         </div>
      </div>

   </div>

   <!-- Controls - Arrows on the side of the carosel -->
   <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
   </a>
   <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
   </a>
</div>