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
  <div class="row-fluid">
  	<div class="row">
        	<h3> Select Particulars Vs Total quantity sold 
on a given day </h3>
        	<form action="" method="get">
            <h2> starting day and month </h2>
        	Enter the day :<input type="text" name="date1"  />
            Enter the month :<input type="text" name="month1"  />
           
        	            <h2> Ending day and month </h2>
                        Enter the day :<input type="text" name="date2"  />
                	Enter the month :<input type="text" name="month2"  />
            <p> <input type="submit" name="submit" value="submit" /></p>
            </form>
        </div>
      	<div id="donut" style="width:100%;height:250px;"></div>
        <div class="span8">
          <div class="ROW">
            <div class="title">

            </div>
            <div class="content">

               <?php 	if(isset($_GET['submit'])){
							$fromDate="2015-{$_GET['month1']}-{$_GET['date1']}"; 
							$toDate="2015-{$_GET['month2']}-{$_GET['date2']}";
							$sql = "SELECT * FROM ebills WHERE bill_date  BETWEEN '$fromDate' AND '$toDate' ";
							//$sql = "SELECT * FROM ebills WHERE bill_date BETWEEN '2010-01-07 12:43:09' AND '2015-05-07 12:43:09' ";
							//`DateTime`>='2012-08-08 00:00:00'BETWEEN '2010-01-07 12:43:09' AND '2015-05-07 12:43:09'
							

							//;DAYOFMONTH(bill_date) = '{$_GET['date']}' AND MONTH(bill_date) = '{$_GET['month']}' ";
							//date BETWEEN '$fromDate' AND '$toDate';
					}
					else{

							$sql = "SELECT * FROM ebills ORDER BY bill_date ASC";
						}
						
					
					
					
					$first_array = array();
					$month = array();
					$total_amount_vs_day = array();
					
					if($result = mysql_query($sql,$conn)){

						while($row = mysql_fetch_array($result)){

							$first_array[] = array(date('d/m/Y', strtotime( $row['bill_date'])),$row['amount']);
							$date[] =  date('d/m/Y', strtotime( $row['bill_date']));
							$total_amount_vs_day[] = array($row['particulars'],$row['quantity']);
							
						}

				
					}
				echo "<script type=\"text/javascript\">first_graph(" . json_encode($total_amount_vs_day) .")</script>";

					
			?>
            </div>
            <!-- End content --> 
          </div>
          <!-- End .box --> 
        </div>

    </div>

  </div> <!-- End .container -->
          <?php 
       //	echo "<button class=\"btn btn-success\" onClick='first_graph(". json_encode($first_array) .")'> Plot Between Total Amount received Vs Day </button> &nbsp;";
					echo "<button class=\"btn btn-success\" style=\"margin-left:150px; margin-bottom:200px;\" onClick='first_graph(". json_encode($total_amount_vs_day) .")'> Click to see graph  </button>";?>
</div> <!-- End #main -->
<!-- Le javascript
    ================================================== -->
<script src="js/jquery.js" type="text/javascript"> </script>

<!-- Flot charts --> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.js"></script> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.resize.js"></script> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.spider.js"></script> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.pie.js"></script>
<script type="text/javascript">
	
			 

 
			 
			 function first_graph(x){
				 
//				 alert("entered ");
					
	var myData = new Array();
	for(var i=1; i<= x.length; i++){
		if(i%2 ==0){
			
		myData[i-1]= 	 { label: x[i-1][0],  data: x[i-1][1], color: "#4572A7"};//[i,x[i-1][0]];
		}
		else{
			myData[i-1]= 	 { label: x[i-1][0],  data: x[i-1][1], color: "#AA4643"};//[i,x[i-1][0]];
		}
//		myData[i-1]= 	[i,x[i-1][1]];
		
	}


		$.plot($("#donut"), myData, {
         series: {
            pie: {
                show: true,
				
     label: {show: true}
            }
         },
        
    });
	
		}
		

		 
</script>
