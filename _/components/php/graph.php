<!-- Google Chart -->
<div id="visualization"></div>

<script type="text/javascript">
    Array.prototype.chunk = function(chunkSize) {
        var array = this;
        return [].concat.apply([],
                array.map(function(elem, i) {
                    return i % chunkSize ? [] : [array.slice(i, i + chunkSize)];
                })
                );
    }

    var chartData;
    var chart;
    var option;
    /* Google Chart */
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawVisualization);

//function setChart(list) {

//var googleData = new google.visualization.DataTable();
//}

    function addHousingData(data, sector) {
        /*
         chartData.addColumn('string', 'sectors');
         chartData.addColumn('number', 'crime1');
         chartData.addColumn('number', 'crime2');
         chartData.addColumn('number', 'crime3');*/

        for (i = 0; i < sector.length; i++) {
        }
        return data;
    }

    function getSectorNames(sectorData, sector, list) {
        listLength = list.length;
        quarter = parseInt(listLength/4);
        third = parseInt(listLength/3);
        middle = parseInt(listLength/2);
        

        //Get the highest average cost
        sector.push(list[0].sectorId);
        
        //Get average costs
        //sector.push(list[quarter].sectorId);
        sector.push(list[third].sectorId);
        sector.push(list[middle].sectorId);
        
        
        //Get the lowest average cost
        sector.push(list[listLength - 1].sectorId);        
        
        return sector;
    }
    function getSectorInfo(sectorData, list) {
        listLength = list.length;
        quarter = parseInt(listLength/4);
        third = parseInt(listLength/3);
        middle = parseInt(listLength/2);
        
        
        sectorData.push([list[0].sectorId, list[0].name, list[0].avgCost]);
        //sectorData.push([list[quarter].sectorId, list[quarter].name, list[quarter].avgCost]);
        sectorData.push([list[third].sectorId, list[third].name, list[third].avgCost]);
        sectorData.push([list[middle].sectorId, list[middle].name, list[middle].avgCost]);
        sectorData.push([list[listLength-1].sectorId, list[listLength-1].name, list[listLength-1].avgCost]);
        
        //console.log("sectorData = " + sectorData[0][1]);
        
        return sectorData;
    }

    function getCrimeForSector(sectors,list) {
        $.ajax({
            url: "_/components/php/graphquery.php",
            type: "POST",
            data: {
                'fname': "getCrimeData",
                'sectors': sectors
            },
            success: function(response) {
            	//console.log(response);
                crimeData = JSON.parse(response);
                var temp = [];
                var sectorData = [];
                
                                
                chartData.addColumn('string', 'Sectors');
                chartData.addColumn('number', 'Sector Average Housing Price');
                chartData.addColumn('number', 'Assault');
                chartData.addColumn('number', 'Sexual Assault');
                chartData.addColumn('number', 'Home Break-In');
                chartData.addColumn('number', 'Robbery');
                chartData.addColumn('number', 'Drug Charges');
                chartData.addColumn('number', 'Vehicle Theft');
                chartData.addColumn('number', 'Theft');
                chartData.addColumn('number', 'Homocide');
                
        //alert(crimeData.length);
                
                /*var res = [];
                if (crimeData.length / 8)
                    res = crimeData.chunk(8);
                console.log(res);*/
        
                sectorData = getSectorInfo(sectorData, list);
                
                var y = 0;
                for (var x = 0; x < sectors.length; x++) {
                    
                    var crimeNum = 1;
                    y = 0;
                    
                    //console.log("Sectors are = " + sectors + " sector data = " + sectorData);
                    
                    temp.push(sectorData[x][1]);
                    temp.push(parseInt(sectorData[x][2]));
                    
                    while (crimeData[y].sector_id != sectors[x]) {
                        y++;
                        //console.log("y = " + y + " crimeData[y].sector_id  = " + crimeData[y].sector_id + " sectors[x = " + sectors[x]);
                        if (y > crimeData.length) {
                            break;
                        }
                    }
                    
                    //console.log("crime sector looking at = " + crimeData[y].sector_id + " current sector = " + sectors[x]);
                    while (crimeData[y].sector_id == sectors[x]) {
                        
                        temp.push(parseInt(crimeData[y].crimeTotal));
                        //console.log("crime type = " + crimeData[y].crime_type + " crime type counter = " + crimeNum +  " total crime = " + parseInt(crimeData[y].crimeTotal));
                        
                        if (parseInt(crimeData[y].crime_type) != crimeNum) {
                    //console.log("HRERE2222222222");        
                    temp.push(0);
                            
                            crimeNum++;
                        }
                        
                        y++;
                        crimeNum++;
                        
                        if (crimeNum > 8) {
                            //console.log("HRERE");
                            break;
                        }
                        

                    }
                    if (temp.length < 10) {
                        temp.push(0);
                    }
                    
                    //console.log("current row of info in temp " + temp);
                    
                    chartData.addRow(temp);
                    temp = [];
                    /*
                    if ((i % 8) == 0) {
                        temp.push(sectors[i]);
                        console.log("HERE" + crimeData.length);
                    }
                    if ((crimeData[i].crime_type % i) != 0) {
                        
                    }
                    temp.push(parseInt(crimeData[i].crimeTotal));
                    console.log(parseInt(crimeData[i].crimeTotal));*/
                }
                //console.log("current row of info in temp " + temp);
                //console.log("current row of info in temp " + chartData);
                
                chart.draw(chartData, options);


                /*
                 sectors = getSectorNames(sectors, list);
                 chartData = addHousingData(chartData, sectors);*/
            },
            error: function(response) {
                console.log(response);
            }
        });

    }

    function drawVisualization() {
        var sectors = [];
        var sectorData = [];
        // Create and populate the data table.
        //var data = new google.visualization.DataTable();

        chartData = new google.visualization.DataTable();
        chart = new google.visualization.ComboChart(document.getElementById('visualization'));

        options = {
            title: 'Average Housing Price',
            seriesType: "line",
            curveType: "none",
            vAxes: {
                0: {logScale: false,
                    title: "Average Housing Cost"},
                1: {logScale: false, 
                    maxValue: 2,
                    title: "Number of Crime"}},
            hAxis: {title: "Sectors"},
            series: {
                0: {targetAxisIndex: 0,
                    type: "bars"},
                1: {targetAxisIndex: 1},
                2: {targetAxisIndex: 1},
                3: {targetAxisIndex: 1},
                4: {targetAxisIndex: 1},
                5: {targetAxisIndex: 1},
                6: {targetAxisIndex: 1},
                7: {targetAxisIndex: 1},
                8: {targetAxisIndex: 1}},
            legend:'none',
            width: 900,
            height: 500
        };

        $.ajax({
            url: "_/components/php/graphquery.php",
            type: "POST",
            data: {'fname': "getHousingData"},
            success: function(response) {
            	//console.log(response);
                list = JSON.parse(response);
                getCrimeForSector(getSectorNames(sectorData, sectors, list),list);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

//Adding Data 

//console.log(response[response.length - 1]);
    /*googleData.addColumn('string', 'x');
     googleData.addColumn('number', response[0].name);
     googleData.addColumn('number', response[response.length-1].name);
     googleData.addColumn('number', 'Blanket 2');
     
     //Bars should be housing
     
     //Lines should be about crime
     googleData.addRow([response[0].name, 1, response[0].avgCost, response[response.length-1].avgCost]);*/
//data.addRow([response[0].name, 1, 0.5, 1]);
    /*data.addRow(["B", 2, 0.5, 1]);
     data.addRow(["C", 4, 1, 0.5]);
     data.addRow(["D", 8, 0.5, 1]);
     data.addRow(["E", 7, 1, 0.5]);
     data.addRow(["F", 7, 0.5, 1]);
     data.addRow(["G", 8, 1, 0.5]);
     data.addRow(["H", 4, 0.5, 1]);
     data.addRow(["I", 2, 1, 0.5]);
     data.addRow(["J", 3.5, 0.5, 1]);
     data.addRow(["K", 3, 1, 0.5]);
     data.addRow(["L", 3.5, 0.5, 1]);
     data.addRow(["M", 1, 1, 0.5]);
     data.addRow(["N", 1, 0.5, 1]);*/

//chart.draw(chartData, options);


    /*var data = google.visualization.arrayToDataTable([
     ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
     ['2004/05', 165, 938, 522, 998, 450, 614.6],
     ['2005/06', 135, 1120, 599, 1268, 288, 682],
     ['2006/07', 157, 1167, 587, 807, 397, 623],
     ['2007/08', 139, 1110, 615, 968, 215, 609.4],
     ['2008/09', 136, 691, 629, 1026, 366, 569.6]
     ])*/

//data.addRow(['2005/06', 135, 1120, 599, 1268, 288, 682]);


// Chart options (axis, titles, scale, curve)
</script>