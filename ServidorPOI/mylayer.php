<?php
	
	$dbhost = "mysql"; 
	$dbdata = "guia"; 
	$dbuser = "root"; 
	$dbpass = "Vilade840"; 

	/* connect to the MySQL server. */
	$db = new PDO( "mysql:host=$dbhost; dbname=$dbdata", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );

	// set the error reporting attribute to throw Exception .
	$db->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

	// Put needed parameter names from GetPOI request in an array called $keys.
	$keys = array( "layerName", "lat", "lon", "radius");

	// Initialize an empty associative array.
	$value = array();
	try {
	
		// Retrieve parameter values using $_GET and put them in $value array with
		// parameter name as key.

		foreach( $keys as $key ) {
			if ( isset($_GET[$key]) )
				$value[$key] = $_GET[$key];
			else
	
			throw new Exception($key ." parameter is not passed in GetPOI request.");
		}
	}

	catch(Exception $e) {
		echo 'Message: ' .$e->getMessage();
	}

    
	// Create an empty array named response.
	
	$strsql = "SELECT tipus,id,attribution,title,lat,lon,imageURL,line4,line3,line2,type,dimension,(((acos(sin((:lat1 * pi() / 180)) * sin((lat * pi() / 180)) + cos((:lat2 * pi() / 180)) * cos((lat * pi() / 180)) * cos((:long - lon) * pi() / 180))) * 180 / pi()) * 60 * 1.1515 * 1.609344 * 1000) as distance FROM POI HAVING distance < :radius AND tipus='" . $category . "' ORDER BY distance ASC LIMIT 0, 50";
	echo $strql;
	
	
	
	$response = array();
	
	$category = $_GET['CHECKBOXLIST'];
	
	// Assign cooresponding values to mandatory JSON response keys.

	$response["layer"] = $value["layerName"];

	// Use Gethotspots() function to retrieve POIs with in the search range.

	$response["hotspots"] = Gethotspots( $db, $value, $category );
	
	// if there is no POI found, return a custom error message.

	
	if ( empty( $response["hotspots"] ) ) {
		$response["errorCode"] = 20;
		$response["errorString"] = $strsql;
		//$response["errorString"] = "No POI found. Please adjust the range.";
	}
	else {
		$response["errorCode"] = 0;
		$response["errorString"] = "ok";
	}
	



	function Gethotspots( $db, $value, $category ) {
	
		//AIXO FA FALTA 
		
		$i=0;
		
		if (strlen($category) == 0)
		{
			//Mostrar tots
			$strsqlint="";
		}
		else
		{
			$strsqlint = "AND (tipus='";
			$primer = 0;
			while ($i < strlen($category))
			{
				$rest = substr($category,$i,1);
				if ($rest != ",")
				{
					if ($primer == 0)
					{
						$strsqlint = $strsqlint . $rest . "'";
						$primer = 1;
					}
					else
					{
						$strsqlint = $strsqlint . " OR tipus = '" . $rest . "'";
					}
				}
		
				$i = $i + 1;
			}
			$strsqlint = $strsqlint . ")";
		}
				
		$strsql = "SELECT tipus,id,attribution,title,lat,lon,imageURL,line4,line3,line2,type,dimension,(((acos(sin((:lat1 * pi() / 180)) * sin((lat * pi() / 180)) + cos((:lat2 * pi() / 180)) * cos((lat * pi() / 180)) * cos((:long - lon) * pi() / 180))) * 180 / pi()) * 60 * 1.1515 * 1.609344 * 1000) as distance FROM POI HAVING distance < :radius " . $strsqlint ." ORDER BY distance ASC LIMIT 0, 50";
		$sql = $db->prepare($strsql);
		
		echo $strql;
		
		//$sql = $db->prepare("SELECT tipus,id,attribution,title,lat,lon,imageURL,line4,line3,line2,type,dimension,(((acos(sin((:lat1 * pi() / 180)) * sin((lat * pi() / 180)) + cos((:lat2 * pi() / 180)) * cos((lat * pi() / 180)) * cos((:long - lon) * pi() / 180))) * 180 / pi()) * 60 * 1.1515 * 1.609344 * 1000) as distance FROM POI HAVING distance < :radius AND tipus='1' ORDER BY distance ASC LIMIT 0, 50");
		//$sql = $db->prepare("SELECT id,attribution,title,lat,lon,imageURL,line4,line3,line2,type,dimension FROM POI");
	
		//AIXO FA FALTA 
		$sql->bindParam( ':lat1', $value['lat'], PDO::PARAM_STR );
		//AIXO FA FALTA 
		$sql->bindParam( ':lat2', $value['lat'], PDO::PARAM_STR );
		//AIXO FA FALTA 
		$sql->bindParam( ':long', $value['lon'], PDO::PARAM_STR );
		//AIXO FA FALTA 
		$sql->bindParam( ':radius', $value['radius'], PDO::PARAM_INT );

		// Use PDO::execute() to execute the prepared statement $sql.
		$sql->execute();

		// Iterator for the response array.
		$i = 0;

		// Use fetchAll to return an array containing all of the remaining rows
		// in the result set.
		// Use PDO::FETCH_ASSOC to fetch $sql query results and return each row
		// as an array indexed by column name.

		$pois = $sql->fetchAll(PDO::FETCH_ASSOC);
		
		/* Process the $pois result */
		// if $pois array is empty, return empty array.
		if ( empty($pois) ) {
			$response["hotspots"] = array ();
		}
		else {

			// Put each POI information into $response[“hotspots”] array.
			foreach ( $pois as $poi ) {

				// If not used, return an empty actions array.
				// AIXO ESTAVA ABANS $poi["actions"] = array();
				$poi["actions"] = Getactions ( $poi, $db );

				// Store the integer value of “lat” and “lon” using predefined function
				// ChangetoIntLoc.
				$poi["lat"] = ChangetoIntLoc( $poi["lat"] );
				$poi["lon"] = ChangetoIntLoc( $poi["lon"] );
			
				// Change to Int with function ChangetoInt.
				$poi["type"] = ChangetoInt( $poi["type"] );
				$poi["dimension"] = ChangetoInt( $poi["dimension"] );

				// Change to demical value with function ChangetoFloat
				$poi["distance"] = ChangetoFloat( $poi["distance"] );
			
				// Put the poi into the response array.
				$response["hotspots"][$i] = $poi;
			
				$i++;
			}
		}

		return $response["hotspots"];
	}





	function ChangetoIntLoc( $value_Dec ) {
		return $value_Dec * 1000000;
	}


	function ChangetoInt( $string ) {
		if ( strlen( trim( $string ) ) != 0 ) {
			return (int)$string;
		}
		else
			return NULL;
	}


	function ChangetoFloat( $string ) {
		if ( strlen( trim( $string ) ) != 0 ) {
			return (float)$string;
		}
		else
			return NULL;
	}

	
	function ChangetoBool( $value_Tinyint ) {
		if ( $value_Tinyint == 1 )
			$value_Bool = TRUE;
		else
			$value_Bool = FALSE;

		return $value_Bool;
	}

	// Put the JSON representation of $response into $jsonresponse.
	$jsonresponse = json_encode( $response );

	// Declare the correct content type in HTTP response header.
	header( "Content-type: application/json; charset=utf-8" );

	// Print out Json response.
	echo $jsonresponse;

	/* Close the MySQL connection.*/
	// Set $db to NULL to close the database connection.
	$db=null;

	
	
	
	
	
	
	
	
	
	// ACCIONS
	
	function Getactions( $poi, $db ) {

	$sql_actions = $db->prepare("SELECT label,uri,autoTriggerRange,autoTriggerOnly,contentType,method,activityType,params,closeBiw,showActivity,activityMessage FROM ACTION WHERE poiID = :id " );
	// Binds the named parameter markers “:id” to the specified
	// parameter values “$poi[‘id’]”.
	
	$sql_actions->bindParam( ':id', $poi['id'], PDO::PARAM_INT );

	// Use PDO::execute() to execute the prepared statement $sql_actions.

	$sql_actions->execute();
	
	// Iterator for the $poi[“actions”] array.
	$count = 0;
	
	// Fetch all the poi actions.
	$actions = $sql_actions->fetchAll( PDO::FETCH_ASSOC );

	/* Process the $actions result */
	// if $actions array is empty, return empty array.
	if ( empty( $actions ) ) {
		$poi["actions"] = array();
	}
	else {

		// Put each action information into $poi[“actions”] array.
		foreach ( $actions as $action ) {

			// Assign each action to $poi[“actions”] array.
			$poi["actions"][$count] = $action;

			// put ‘params’ into an array of strings
			$paramsArray = array();

			if ( substr_count( $action['params'],',' ) ) {
				$paramsArray = explode( ",", $action['params'] );
			}
			else if( strlen( $action['params'] ) ) {
				$paramsArray[0] = $action['params'];
			}

			$poi["actions"][$count]['params'] = $paramsArray;
			
			// Change ‘activityType’ to Integer.
			$poi["actions"][$count]['activityType'] = ChangetoInt( $poi["actions"][$count]['activityType'] );

			// Change the values of closeBiw into boolean value.
			$poi["actions"][$count]['closeBiw'] = ChangetoBool( $poi["actions"][$count]['closeBiw'] );

			// Change the values of “showActivity” into boolean value.
			$poi["actions"][$count]['showActivity'] = ChangetoBool( $poi["actions"][$count]['showActivity'] );

			// Change ‘autoTriggerRange’ to Integer, if the value is NULL,
			// return NULL.

			$poi["actions"][$count]['autoTriggerRange'] = ChangetoInt( $poi["actions"][$count]['autoTriggerRange'] );

			// Change the values of “autoTriggerOnly” into boolean value,
			// if the value is NULL, return NULL.

			$poi["actions"][$count]['autoTriggerOnly'] = ChangetoBool( $poi["actions"][$count]['autoTriggerOnly'] );
			$count++;

		}
	}

	return $poi["actions"];
}
	
	
	
	
	
	
	
?>