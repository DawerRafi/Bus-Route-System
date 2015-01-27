
<html>
<head>        
    <script type="text/javascript" src="../RGraph/libraries/RGraph.common.core.js" ></script>
    <script type="text/javascript" src="../RGraph/libraries/RGraph.bar.js" ></script>
	<script src="../jquery/jquery-1.11.1.min.js"></script>
    <!--[if lt IE 9]><script src="../excanvas/excanvas.js"></script><![endif]-->    
    <title>Bar chart</title>    
	<style>
	#right{
		position:relative;
		left:50px;
		top:0px;
	}
	</style>
</head>
<body>
	<?php 
	include 'connection.php';
	
$counts= array_fill(0, 6, NULL);
$months= array_fill(0, 6, NULL);
$arraycounter=0;
$date2=date("d-M-Y",strtotime("first day of this month"));
$enddate2=date("d-M-Y",strtotime("last day of this month"));
	for ($counter = -5; $counter <= 0; $counter++) {
	$strtdate = date("d-M-Y",strtotime("first day of ".$counter." month"));
	$enddate = date("d-M-Y",strtotime("last day of ".$counter." month"));
	
	//echo $strtdate;
	//echo $enddate;
	$query="SELECT NVL(COUNT(RES_ID),0) FROM RESERVATIONS WHERE DATEOFRES>='".$strtdate."' AND DATEOFRES<='".$enddate."'";
	//echo $query;
	$temp = explode("-",$strtdate);
	$months[$arraycounter]= $temp[1];
	$stmt=oci_parse($conn,$query);
	oci_execute($stmt);
	oci_fetch($stmt);
	$counts[$arraycounter]=oci_result($stmt,1);
	$arraycounter=$arraycounter+1;
	
	
	}
	$strcount="";
	$strmonth="";
	for($c=0;$c<5;$c++){
		$strcount .="[".$counts[$c]."],";
		$strmonth .= "'".$months[$c]."',";
	}
	$strcount .="[".$counts[5]."]";
	$strmonth .="'".$months[5]."'";
	//echo $strtdate;
	//echo $enddate;
	//------------------------------------------------------------------------------------------
	$query2="
select A.CNAME,B.CNAME,count(RESERVATIONS.route_id) from reservations,route,CITIES A,CITIES B where 
ROUTE.STARTCITY=A.CITY_ID AND ROUTE.ENDCITY=B.CITY_ID AND
ROUTE.ROUTE_ID=RESERVATIONS.ROUTE_ID AND DATEOFRES>='".$date2."' AND DATEOFRES<='".$enddate2."' GROUP BY A.CNAME,B.CNAME ";
$stmt2=oci_parse($conn,$query2);
oci_execute($stmt2);

$edges= array_fill(0, 6, NULL);
$edgecount= array_fill(0, 6, NULL);
$c2=0;
while(oci_fetch($stmt2)){
	if($c2==6){
	break;
	}
	else{
	$str="";
	$str .=substr(oci_result($stmt2,1),0,3);
	$str .="-";
	$str .=substr(oci_result($stmt2,2),0,3);
	$edges[$c2]=$str;
	$edgecount[$c2]=oci_result($stmt2,3);
	$c2=$c2+1;
}
}
$c3=$c2-1;
	$strecount="";
	$stredge="";
	for($c=0;$c<$c3;$c++){
		$strecount .="[".$edgecount[$c]."],";
		$stredge .= "'".$edges[$c]."',";
	}
	$strecount .="[".$edgecount[$c3]."]";
	$stredge .="'".$edges[$c3]."'";


	?>
    <h3>Monthly Reservations</h3>
    <canvas id="cvs" width="600" height="250">[No canvas support]</canvas>
    <script>
        $(document).ready(function ()
        {
            var bar = new RGraph.Bar({
                id: 'cvs',
                data: [<?php echo $strcount; ?>],
                options: {
                    labels: [<?php echo $strmonth; ?>],
                    hmargin: 15,
                    background: {
                        grid: {
                            autofit: {
                                numvlines: 5
                            }
                        }
                    }
                }
            }).draw()
        })
    </script>
	 
	 
	 
	 <canvas id="right" width="600" height="250">[No canvas support]</canvas>
    <script>
        $(document).ready(function ()
        {
            var bar = new RGraph.Bar({
                id: 'right',
                data: [<?php echo $strecount; ?>],
                options: {
                    labels: [<?php echo $stredge; ?>],
                    hmargin: 15,
                    background: {
                        grid: {
                            autofit: {
                                numvlines: 5
                            }
                        }
                    }
                }
            }).draw()
        })
    </script>
	</body>
</html>