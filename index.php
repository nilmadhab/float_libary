<?php
session_start();
require('all_fns.php');

do_html_header('Money In');
if(isset($_SESSION['flash'])){
  echo $_SESSION['flash'];
  unset($_SESSION['flash']);
}
$conn=db_connect();
?>

<?php 
if(isset($_POST["submit"])){
	echo "<pre>";
	echo $_POST;
	$amount = $_POST['amount'];
	$date = $_POST['bill_date'];
	$quantity = $_POST['quantity'];
	$particulars = $_POST['particulars'];

	echo "</pre>";
	$sql = "INSERT INTO `ebills` ( `bill_comp_id`, `bill_user_id`, `bill_amt`, `bill_transac_id`, `bill_status`, `bill_date`, `sno`,
	 `particulars`, `quantity`, `amount`, `bill_type`) VALUES
('1', '1', '{$amount}', '12ffff23', '123', '{$date} 18:30:00', 12,
 '{$particulars}', '{$quantity}', '{$amount}', 1)";

if (mysql_query($sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>
<h1>Home Page</h1>
<p> Here you can see the whole inventory</p>
<p> You can see all items, their particulars , quantity sold, date at 
which items were sold</p>
<?php 

$sql = "SELECT * FROM ebills";
if($result = mysql_query($sql,$conn)){
	echo "<table class=\"table table-striped\">";
	echo "<tr>";
						echo "<td>";
						echo "particulars";
						echo "</td>";
						echo "<td>";
						echo "quantity";
						echo "</td>";
						echo "<td>";
						echo "amount";
						echo "</td>";
						echo "<td>";
						echo "date";
						echo "</td>";

						echo "</tr>";

						while($row = mysql_fetch_array($result)){
							//print_r($row);
						echo "<tr>";
						echo "<td>";
						echo $row['particulars'];
						echo "</td>";
						echo "<td>";
						echo $row['quantity'];
						echo "</td>";
						echo "<td>";
						echo $row['amount'];
						echo "</td>";
						echo "<td>";
						echo $row['bill_date'];
						echo "</td>";

						echo "</tr>";
							
						}
//						print_r($first_array);

						echo "</table>";
					}
	  
	

?>
<h2> Enter new item here </h2>
<style type="text/css">
	.form-control {
  display: block;
  width: 100%;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
html textarea, html input[type="text"], html input[type="password"], html input[type="datetime"], html input[type="datetime-local"], html input[type="date"], html input[type="month"], html input[type="time"], html input[type="week"], html input[type="number"], html input[type="email"], html input[type="url"], html input[type="search"], html input[type="tel"], html input[type="color"], html .uneditable-input {

	 background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
	}
</style>
<form  action="" method="post" style="width:500px">
<div class="form-group">
    <label for="exampleInputEmail1">Particulars Of item</label>
    <input type="text" name="particulars" class="form-control" id="exampleInputEmail1" 
    placeholder="Enter name of item like mobile/coffe etc" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Amount</label>
    <input type="number" name="amount" class="form-control" id="exampleInputPassword1"
     required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Date of purchasing</label>
    <input type="date" name="bill_date"  class="form-control" id="exampleInputEmail1" 
    required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Quantity</label>
    <input type="number" name="quantity" class="form-control" id="exampleInputPassword1"
required>
  </div>
  <input class="btn btn-info"  name="submit" type="submit" value="Enter the item ">
</form>

