<h1>Statistics Summary</h1>
<?php include '_/components/php/query-statistics.php'; ?>
<?php setlocale(LC_MONETARY, 'en_CA'); ?>

<!-- Statistics Content -->
<div class="col col-xs-12 col-sm-6 col-md-6"> 

    <legend>Rental Costs</legend>

    <!-- 2nd most recent year rental housing data -->
    <h5>
    Average Costs of Rental Units For 
    <?php  
        if($rental[4]['quarter'] == 1)
        {
            echo $rental[4]['quarter'] . "st Quarter 2014";
        }
        elseif($rental[4]['quarter'] == 2)
        {
            echo $rental[4]['quarter'] . "nd Quarter 2014";
        }
        elseif($rental[4]['quarter'] == 3)
        {
            echo $rental[4]['quarter'] . "rd Quarter 2014";
        }
        elseif($rental[4]['quarter'] == 4)
        {
            echo $rental[4]['quarter'] . "th Quarter 2014";
        }
    ?>
    </h5>
    <div class="table-responsive"> 
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <?php for($i = 4; $i < 8; $i++): ?>
            <tbody>
                <tr>
                    <td><?php echo $rental[$i]['name']; ?></td>
                    <td><?php echo "$".number_format($rental[$i]['cost'])?></td>
                </tr>
            </tbody>
            <?php endfor; ?>
        </table>
    </div><!-- table-responsive -->

    <!-- most 2nd most recent year buyable housing data -->
    <h5>
    Average Costs of Buyable Units For 
    <?php  
        if($rental[4]['quarter'] == 1)
        {
            echo $rental[4]['quarter'] . "st Quarter 2014";
        }
        elseif($rental[4]['quarter'] == 2)
        {
            echo $rental[4]['quarter'] . "nd Quarter 2014";
        }
        elseif($rental[4]['quarter'] == 3)
        {
            echo $rental[4]['quarter'] . "rd Quarter 2014";
        }
        elseif($rental[4]['quarter'] == 4)
        {
            echo $rental[4]['quarter'] . "th Quarter 2014";
        }
    ?>
    </h5>
    <div class="table-responsive"> 
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <?php for($i = 0; $i < 9; $i++): ?>
            <tbody>
                <tr>
                    <td><?php echo $buying[$i]['name']; ?></td>
                    <td><?php echo "$".number_format($buying[$i]['cost'])?></td>
                </tr>
            </tbody>
            <?php endfor; ?>
        </table>
    </div><!-- table-responsive -->

</div> <!-- col 1 -->
<div class="col col-xs-12 col-sm-6 col-md-6">

    <legend>Buying Costs</legend>
    
    <!-- most recent year rentable housing data -->
    <h5>
    Average Costs of Rental Units For 
    <?php  
        if($rental[0]['quarter'] == 1)
        {
            echo $rental[0]['quarter'] . "st Quarter 2014";
        }
        elseif($rental[0]['quarter'] == 2)
        {
            echo $rental[0]['quarter'] . "nd Quarter 2014";
        }
        elseif($rental[0]['quarter'] == 3)
        {
            echo $rental[0]['quarter'] . "rd Quarter 2014";
        }
        elseif($rental[0]['quarter'] == 4)
        {
            echo $rental[0]['quarter'] . "th Quarter 2014";
        }
    ?>
    </h5>
    <div class="table-responsive"> 
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <?php for($i = 0; $i < 4; $i++): ?>
            <tbody>
                <tr>
                    <td><?php echo $rental[$i]['name']; ?></td>
                    <td><?php echo "$".number_format($rental[$i]['cost'])?></td>
                </tr>
            </tbody>
            <?php endfor; ?>
        </table>
    </div><!-- table-responsive -->

    <!-- most recent year buyable housing data -->
    <h5>
    Average Costs of Buyable Units For 
    <?php  
        if($rental[0]['quarter'] == 1)
        {
            echo $rental[0]['quarter'] . "st Quarter 2014";
        }
        elseif($rental[0]['quarter'] == 2)
        {
            echo $rental[0]['quarter'] . "nd Quarter 2014";
        }
        elseif($rental[0]['quarter'] == 3)
        {
            echo $rental[0]['quarter'] . "rd Quarter 2014";
        }
        elseif($rental[0]['quarter'] == 4)
        {
            echo $rental[0]['quarter'] . "th Quarter 2014";
        }
    ?>
    </h5>
    <div class="table-responsive"> 
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <?php for($i = 9; $i < count($buying); $i++): ?>
            <tbody>
                <tr>
                    <td><?php echo $buying[$i]['name']; ?></td>
                    <td><?php echo "$".number_format($buying[$i]['cost'])?></td>
                </tr>
            </tbody>
            <?php endfor; ?>
        </table>
    </div><!-- table-responsive -->
</div> <!-- col 2 -->
<div>
<legend>Crime Statistics</legend>
</div>

<div class="col col-xs-12 col-sm-6 col-md-6">
    <!-- 2010 crime data -->
    <h5>
    Incidents by Crime Type for the Year  
    <?php  
        echo date('Y', strtotime($crime[0]['date']) - 1);
    ?>
    </h5>
    <div class="table-responsive"> 
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Crime Type</th>
                    <th>Incidents</th>
                </tr>
            </thead>
            <?php for($i = (count($crime)/2); $i < count($crime); $i++): ?>
            <tbody>
                <tr>
                    <td><?php echo $crime[$i]['crime']; ?></td>
                    <td><?php echo $crime[$i]['count']; ?></td>
                </tr>
            </tbody>
            <?php endfor; ?>
        </table>
    </div><!-- table-responsive -->
</div>
<div class="col col-xs-12 col-sm-6 col-md-6">
    <!-- 20011 crime data -->
    <h5>
    Incidents by Crime Type for the Year  
    <?php  
        echo date('Y', strtotime($crime[0]['date']));
    ?>
    </h5>
    <div class="table-responsive"> 
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Crime Type</th>
                    <th>Incidents</th>
                </tr>
            </thead>
            <?php for($i = 0; $i < (count($crime)/2); $i++): ?>
            <tbody>
                <tr>
                    <td><?php echo $crime[$i]['crime']; ?></td>
                    <td><?php echo $crime[$i]['count']; ?></td>
                </tr>
            </tbody>
            <?php endfor; ?>
        </table>
    </div><!-- table-responsive -->
</div>
</div>