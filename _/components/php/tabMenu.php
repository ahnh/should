 <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#mapTab" role="tab" data-toggle="tab">Map</a>
    </li>
    <li role="presentation">
        <a href="#graphTab" role="tab" data-toggle="tab">Graph</a>
    </li>
    <li role="presentation">
        <a href="#statisticTab" role="tab" data-toggle="tab">Statistics</a>
    </li>
</ul>

<!-- Nav Tab Content -->
<div class="tab-content">
    <!-- Google Map -->
    <div role="tabpanel" class="tab-pane active" id="mapTab">
        <?php include '_/components/php/map.php' ?>
    </div><!--tabpanel-->
    
    <!-- Google Chart -->
    <div role="tabpanel" class="tab-pane" id="graphTab">
        <?php include '_/components/php/graph.php'?>
    </div><!--tabpanel-->
    
    <!-- Statistics Summary -->
    <div role="tabpanel" class="tab-pane" id="statisticTab">
        <?php include '_/components/php/stats.php'?>
    </div><!--tabpanel-->
</div>