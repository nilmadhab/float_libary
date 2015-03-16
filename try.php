<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Flot Examples</title>
    <link href="layout.css" rel="stylesheet" type="text/css">
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.js" type="text/javascript"> </script> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.js"></script> 
<script language="javascript" type="text/javascript" src="js/plugins/flot/jquery.flot.resize.js"></script>
<style>
	#mycanvas {
     width: 500px;
     height: 300px;
}
</style>
 </head>
    <body>
    
<div id="mycanvas">

</div>

<script>
	var Options = {
		xaxis: {ticks: [[1,"Spring"], [2, "Summer"], [3, "Autumn"], [4, "Winter"]] }

}
	$(function() {
		var myData = [[1,2010], [2, 2543], [3, 2520], [4, 2354]];
		
     $.plot($("#mycanvas"), [
          {
               data: myData,
			   bars: { show: true, fill: 1,fillColor: "#757dad" } ,
			   color: "#454d7d"
          }
     ],Options);
	})
</script>
    </body>
</html>