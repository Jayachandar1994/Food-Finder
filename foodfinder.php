<?php
	
	require_once("foodfinderDBConnect.php"); 
	require_once("generateMap.php");
	require_once("generateMainPage.php"); 
	
	
	$table = "restaurants"; 
	$title = "Food Finder";
	$body = "";

	if(!empty($_POST['typeOfFood']) && isset($_POST['submit'])) {
	    
	    $typesOfFood = $_POST['typeOfFood'];
		$conn = new mysqli($host, $user, $password, $database);

	    foreach($typesOfFood as $food) {

	    	$sql = "select address, city, latitude, longitude from $table where is$food = \"TRUE\"";
	    	$sqlQuery = sprintf($sql);
			$data = $conn->query($sql);
			$result = mysqli_query($db, $sqlQuery);
	    	
	    	if ($result) {
	    		if ($data->num_rows > 0) {
				    while($row = $data->fetch_assoc()) {

				    	$address = $row["address"];
				    	$city = $row["city"];
				    	$lat = $row["latitude"];
				    	$long = $row["longitude"];

				    	$body .= "[\"$address\", \"$city\", $lat, $long, \"$food\"],";
				    }
				}
			} else { 				   
				echo "ERROR: ".mysqli_error($db);
			}
	    }
		
		$body = rtrim($body, ",");
		$body = generateMap($body, $title);

	} 
	echo generatePage($body, $title); 

?>



