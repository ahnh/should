<?php include '_/components/php/carousel.php' ?>

<hr class="featurette-divider">

<div class="row featurette">
    <div class="col-md-7">
        <h3 class="featurette-heading">What is "Should I Live Here?"</h3>
        <p style="height:50px">
                An interactive tool to explore the average cost for renting or buying a housing type, and the incidents of major crime within sectors of the Greater Toronto Area.
        </p>
        <p style="height:50px">
               Find out which sectors suit your budget based on a type of home, or rental unit.  Or find out how many incidents of vehicle theft occurred within a given area.
        </p>
        <p style="height:50px">
               You'll sleep better knowing how much it will cost you and who's doing what, and where, after using Should I Live Here?
        </p>
        <p>
            Get started looking for your new place to live.  <a type="button" class="btn btn-success btn-sm" href="search.php">Search</a>
        </p>
    </div><!-- col -->

    <div class="col-md-5">
        <div style="width:500px; height: 360px; background-color: #233;">
            <img class="featurette-image img-responsive" src="_/img/screen.png" data-src="holder.js/500x500/auto" alt="">
        </div>
    </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
    <div class=" col-sm-12 col-md-7 col-lg-6">
        <br><br><br><!-- adjusting position of image -->
        <div style="width:500px; height: 360px; background-color: #333;">
            <img class="featurette-image img-responsive" src="_/img/police.jpg" data-src="holder.js/500x500/auto" alt="">
        </div>
    </div>
    <!-- <div class="col-sm-3 col-md-3 col-lg-1">
        
    </div> -->

    <div class="col-sm-12 col-md-5 col-lg-6">
        <h3>Crime By Sector</h3>
           <span class="text-muted">See the top 3 sectors with the lowest and highest incidents of crime.</span>

            <h5>Sectors With the Lowest Incidents of Crime</h5>
            <div class="table-responsive"> 
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sector</th>
                            <th>Crime Incidents</th>
                        </tr>
                    </thead>
                    <?php for($i = 0; $i < count($safe); $i++): ?>
                    <tbody>
                        <tr>
                            <td><?php echo $safe[$i]['sector']; ?></td>
                            <td><?php echo $safe[$i]['crimes']; ?></td>
                        </tr>
                    </tbody>
                    <?php endfor; ?>
                </table>
            </div><!-- table-responsive -->

            <h5>Sectors With the Highest Incidents of Crime</h5>
            <div class="table-responsive"> 
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sector</th>
                            <th>Crime Incidents</th>
                        </tr>
                    </thead>
                    <?php for($i = 0; $i < count($safe); $i++): ?>
                    <tbody>
                        <tr>
                            <td><?php echo $dangerous[$i]['sector']; ?></td>
                            <td><?php echo $dangerous[$i]['crimes']; ?></td>
                        </tr>
                    </tbody>
                    <?php endfor; ?>
                </table>
            </div><!-- table-responsive -->
        
    </div>

</div>



<?php include '_/components/php/db.php'; ?>
