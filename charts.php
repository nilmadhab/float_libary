<?php
session_start();
$_SESSION['comp_id'] = "12345" ;
require('all_fns.php');

do_html_header('Charts');

if(isset($_SESSION['flash'])){
  echo $_SESSION['flash'];
  unset($_SESSION['flash']);
}
$conn=db_connect();
?>
<div class="row">
<script src="js/jquery.js" type="text/javascript"> </script> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.js"></script> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.resize.js"></script>
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.categories.js "></script>
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.pie.js"></script>
 

</head>

  <div class="row-fluid">
  		<div class="row">
        	<h3> Select Particulars Vs Total quantity sold 
on a given day </h3>
        	<form action="" method="get">
        	Enter the day :<input type="text" name="date"  />
            Enter the month :<input type="text" name="month"  />
            <p> <input type="submit" name="submit_day" value="submit_day" /></p>
            </form>
                    	<h3> Select Particulars Vs Total quantity sold 
on a given month </h3>
               <form action="" method="get">
        	
                	Enter the month :<input type="text" name="month"  />
            <p> <input type="submit" name="submit_month" value="submit_month" /></p>
            </form>
        </div>
        <div class="span8">
          <div class="box gradient">
            <div class="title">
            <?php 	if(isset($_GET['submit_day'])){
							$sql = "SELECT * FROM ebills WHERE DAYOFMONTH(bill_date) = '{$_GET['date']}' AND MONTH(bill_date) = '{$_GET['month']}' ";
					}
					else{
						if(isset($_GET['submit_month'])){
							$sql = "SELECT * FROM ebills WHERE  MONTH(bill_date) = '{$_GET['month']}' ";
						}
						else{
							$sql = "SELECT * FROM ebills ORDER BY bill_date ASC";
						}
						
					}
					
					$first_array = array();
					$month = array();
					$total_amount_vs_day = array();
					
					if($result = mysql_query($sql,$conn)){
						while($row = mysql_fetch_array($result)){
							//print_r($row);
							$first_array[] = array(date('d/m/Y', strtotime( $row['bill_date'])),$row['amount']);
							$date[] =  date('d/m/Y', strtotime( $row['bill_date']));
							$total_amount_vs_day[] = array($row['particulars'],$row['quantity']);
							
						}
//						print_r($first_array);
					}

					
			?>
             
              <h4> <i class="icon-globe"></i> <span>Graph</span> </h4>
            </div>
            <div class="content">
              <div id="line-chart" class="simple-chart" style="width:100%;height:250px;color:#FFF"></div>
             <div id="label"> Total amount Received Vs Day</div>
            </div>
            <!-- End content --> 
          </div>
          <!-- End .box --> 
        </div>
        <div class="span-4">
        <?php 
       	echo "<button class=\"btn btn-success\" onClick='first_graph(". json_encode($first_array) .")'> Plot Between Total Amount received Vs Day </button> &nbsp;";
					echo "<button class=\"btn btn-success\"  onClick='second_graph(". json_encode($total_amount_vs_day) .")'> Plot Between Particulars Vs Total quantity sold  </button>";?>
        </div>


         
    </div>
  </div> <!-- End .container -->
</div> <!-- End #main -->
<!-- Le javascript
    ================================================== -->
<script src="js/jquery.js" type="text/javascript"> </script>

<!-- Flot charts --> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.js"></script> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.resize.js"></script> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.spider.js"></script> 

<script type="text/javascript">
 
			 
			 function first_graph(x){
				 document.getElementById("label").innerHTML = "Plot Between Total Amount received Vs Day";
					var myData_x = new Array();
	var myData = new Array();
	for(var i=1; i<= x.length; i++){
		myData_x[i-1]= 	[i,x[i-1][0]];
		myData[i-1]= 	[i,x[i-1][1]];
	}
	
	
	var Options = {
		xaxis: {ticks: myData_x,color:"#FFF" },
		yaxis:{color:"#FFF"}

			}

		//var myData = [[1,2010], [2, 2543], [3, 2520], [4, 2354]];
		
     $.plot($("#line-chart"), [
          {
               data: myData,
			   bars: { show: true, fill: 1,fillColor: "#757dad" , align:"center"} ,
			   color: "#FFF"
          }
     ],Options);

		}


			
		function second_graph(x){
		 document.getElementById("label").innerHTML = "Plot Between Particulars Vs Total quantity sold";
			/*var Options = {
		xaxis: {ticks: [[1,"Spring"], [2, "Summer"], [3, "Autumn"], [4, "Winter"]],color:"#FFF" },
		yaxis:{color:"#FFF"}

			}

		var myData = [[1,2010], [2, 2543], [3, 2520], [4, 2354]];
		
     $.plot($("#line-chart"), [
          {
               data: myData,
			   bars: { show: true, fill: 1,fillColor: "#757dad" , align:"center"} ,
			   color: "#FFF"
          }
     ],Options);
	*/
	var myData_x = new Array();
	var myData = new Array();
	for(var i=1; i<= x.length; i++){
		myData_x[i-1]= 	[i,x[i-1][0]];
		myData[i-1]= 	[i,x[i-1][1]];
	}

	var Options = {
		xaxis: {ticks: myData_x,color:"#FFF" },
		yaxis:{color:"#FFF"}

			}

		//var myData = [[1,2010], [2, 2543], [3, 2520], [4, 2354]];
		
     $.plot($("#line-chart"), [
          {
               data: myData,
			   bars: { show: true, fill: 1,fillColor: "#757dad" , align:"center"} ,
			   color: "#FFF"
          }
     ],Options);

		}
			

	$(function() {

		var d1 = [];
		for (var i = 0; i < 14; i += 0.5) {
			d1.push([i, Math.sin(i)]);
		}

		var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];

		var d3 = [];
		for (var i = 0; i < 14; i += 0.5) {
			d3.push([i, Math.cos(i)]);
		}

		var d4 = [];
		for (var i = 0; i < 14; i += 0.1) {
			d4.push([i, Math.sqrt(i * 10)]);
		}

		var d5 = [];
		for (var i = 0; i < 14; i += 0.5) {
			d5.push([i, Math.sqrt(i)]);
		}

		var d6 = [];
		for (var i = 0; i < 14; i += 0.5 + Math.random()) {
			d6.push([i, Math.sqrt(2*i + Math.sin(i) + 5)]);
		}

		$.plot("#suggest", [{
			data: d1,
			lines: { show: true, fill: true }
		}, {
			data: d2,
			bars: { show: true }
		}, {
			data: d3,
			points: { show: true }
		}, {
			data: d4,
			lines: { show: true }
		}, {
			data: d5,
			lines: { show: true },
			points: { show: true }
		}, {
			data: d6,
			lines: { show: true, steps: true }
		}]);

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});

	</script>
</script>
