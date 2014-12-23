<?php
	
	session_start();
	
	if(empty($_SESSION['username'])) { // comprobamos que las variables de sesión estén vacías 
		if(isset($_POST['username']) && isset($_POST['password'])){
			$adServer = "ldap://129.200.9.102";
			$ldap = ldap_connect($adServer) or exit(header('Location: index.php?error=1'));; //conectamos con el servidor o mostramos error
			$username = $_POST['username'];
			$password = $_POST['password'];
			$ldaprdn = 'ajv' . "\\" . $username;
			ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
			$bind = @ldap_bind($ldap, $ldaprdn, $password) or exit (header('Location: index.php?error=2'));; //buscamos usuario en servidor, si la contraseña no coincide damos error
			
			if ($bind) {
				$filter="(sAMAccountName=$username)";
				$result = ldap_search($ldap,"DC=intranet,DC=viladecans,DC=es",$filter) or exit(header('Location: index.php?error=3'));; //buscamos usuario y si no existe damos error
				ldap_sort($ldap,$result,"sn");
				$info = ldap_get_entries($ldap, $result);
				for ($i=0; $i<$info["count"]; $i++){
					if($info['count'] > 1)
						break;
						//$idUsuari = $info[$i]["givenname"][0] . " " . $info[$i]["sn"][0];
						$_SESSION["Variable"] = $info[$i]["givenname"][0] . " " . $info[$i]["sn"][0];
						header("Location: inicigeneral.php");
						//echo "<html><head><meta http-equiv='REFRESH' content='0;url=./inicigeneral.php'></head></html>";
						//echo "<p>Está conectado como <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
						$userDn = $info[$i]["distinguishedname"][0]; 
						exit();
				}
				$_SESSION['NOMUSUARI']=$info[0]["samaccountname"][0];
				@ldap_close($ldap);
				//echo $info[0]["sn"][0];
				//echo $info[0]["givenname"][0];
			} else {
					//$msg = "Usuario o contraseña incorrectos";
					echo "<html><head><meta http-equiv='REFRESH' content='0;url=index.php?error=3'></head></html>";
					
					}
		}else{
		}
	} 

	
?> 