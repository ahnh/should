<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
	var sectors = [];
	function getSectorDropdownList() {
		$.ajax({
			url : "_/components/php/formmenuquery.php",
			type : "POST",
			data : {'fname' : "getSectors"},
			success : function (response) {
				//console.log(response);
				response = JSON.parse(response);
				popSectorDropdownList(response);
			},
			error : function (response) {
				console.log(response);
			}
		});
	}

	function popSectorDropdownList(list) {
		  var e = document.getElementById('sectors');
		  e.options[0] = new Option('All Sectors');
		  e.options[0].value = 'All';
		  for (var i = 1; i < list.length+1; i++)
		  {
			  e.options[i] = new Option(list[i-1].name);
			  e.options[i].value = list[i-1].name;
			  sectors[i-1] = list[i-1].name;
		  }
	}

	function getHousingTypesDropdownList() {
		var owner = document.getElementById('owner').value;
		if (owner == "own")
		{
			$.ajax({
				url : "_/components/php/formmenuquery.php",
				type : "POST",
				data : {
					'fname' : "getHTypes"
				},
				success : function (response) {
					//console.log(response);
					response = JSON.parse(response);
					popHousingTypesDropdownList(response);
				},
				error : function (response) {
					console.log(response);
				}
			});
		}
		else
		{
			$.ajax({
				url : "_/components/php/formmenuquery.php",
				type : "POST",
				data : {
					'fname' : "getRHTypes"
				},
				success : function (response) {
					//console.log(response);
					response = JSON.parse(response);
					popHousingTypesDropdownList(response);
				},
				error : function (response) {
					console.log(response);
				}
			});
		}
	}

	function popHousingTypesDropdownList(list) {
		var e = document.getElementById('hTypes');

		while (e.length > 0)
		{
			e.remove(0);
		}

		for (var i = 0; i < list.length; i++)
		{
			e.options[i] = new Option(list[i].name);
			e.options[i].value = list[i].name;
		}
		updateHousingMap();
	}
</script>

<?php date_default_timezone_set('America/Toronto'); ?>
<div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <!-- GTA Sector Section -->
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        GTA Location
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <h5><b>Sector</b></h5>
                    <!-- GTA Sector Dropdown Menu -->
                    <select class="form-control" id="sectors" onChange="onSectorUpdate()">
                    </select><!-- dropdown - GTA Sectors -->
                </div>
            </div>
        </div> <!--panel - GTA Location -->
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Housing
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <h5><b>Average Cost Own vs Rent</b></h5>
                    <!-- Housing Dropdown Menu -->

                    <select class="form-control" id="owner" onChange="getHousingTypesDropdownList()">
                        <option value="own">Average Housing Cost</option>
                        <option value="rent">Average Rental Cost</option>
                    </select><!-- dropdown - housing cost -->
                    <h5><b>Housing Type</b></h5>
                    <!-- Housing Dropdown Menu -->
                    <select class="form-control" id="hTypes" onChange="updateHousingMap()"></select>
                    <!-- dropdown - housing type -->  
                </div>
            </div>
        </div> <!-- panel - Housing -->
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        Crime
                    </a>
                </h4>
            </div> <!-- panel title - crime -->
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <h5><b>Crime</b></h5>
                    <form>
                    	
	                    <div class="checkbox">
	                        <label>
	                            <input name="crime" value=1 type="checkbox" onclick="onCrimeCheckboxUpdate();"> Assault
	                        </label>
	                    </div>
	                    <div class="checkbox">
	                        <label>
	                            <input name="crime" value=2 type="checkbox" onclick="onCrimeCheckboxUpdate();"> Sexual Assault
	                        </label>
	                    </div>
	                    <div class="checkbox">
	                        <label>
	                            <input name="crime" value=3 type="checkbox" onclick="onCrimeCheckboxUpdate();"> Home Break-In
	                        </label>
	                    </div>
	                    <div class="checkbox">
	                        <label>
	                            <input name="crime" value=4 type="checkbox" onclick="onCrimeCheckboxUpdate();"> Robbery
	                        </label>
	                    </div>
	                    <div class="checkbox">
	                        <label>
	                            <input name="crime" value=5 type="checkbox" onclick="onCrimeCheckboxUpdate();"> Drug Charges
	                        </label>
	                    </div>
	                    <div class="checkbox">
	                        <label>
	                            <input name="crime" value=6 type="checkbox" onclick="onCrimeCheckboxUpdate();"> Vehicle Theft
	                        </label>
	                    </div>
	                    <div class="checkbox">
	                        <label>
	                            <input name="crime" value=7 type="checkbox" onclick="onCrimeCheckboxUpdate();"> Theft
	                        </label>
	                    </div>
	                    <div class="checkbox">
	                        <label>
	                            <input name="crime" value=8 type="checkbox" onclick="onCrimeCheckboxUpdate();"> Homicide
	                        </label>
	                    </div>
                        <hr>
                        <div class="checkbox">
	                        <label>
	                            <input name="crime" value=0 type="checkbox" onclick="onCrimeAllCheckboxUpdate();"> Display All
	                        </label>
	                    </div>
                    </form>
                </div>
            </div>
        </div> <!-- panel - Crime -->
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Display 
                    </a>
                </h4>
            </div> <!-- panel title - crime -->
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                    <h5><b>Toggle</b></h5>
                    <form>
                    	<div class="checkbox">
	                        <label>
	                            <input name="displayMLS" type="checkbox" onclick="onDisplayCheckboxUpdate();"> View Crime Only
	                        </label>
                    	</div>
                	</form>
                </div>
            </div>
        </div> <!-- panel - Display -->
    </div>
</div><!--/.well -->


