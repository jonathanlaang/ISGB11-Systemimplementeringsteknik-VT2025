<?php
	//Skapa variabel med default-värde
	$disabled = "disabled";
	$bgColor = "#ffffff"; //background-color white
	$fgColor = "#000000"; //color black

	//Här skriver vi koden för hela lösningen!

	//Ny funktion som både avslutar en session och "tar bort" sessionskakan på klienten.
	function deleteSession() {

		session_unset();

		if( ini_get("session.use_cookies") ) {

			$sessionCookieData = session_get_cookie_params();

			$path = $sessionCookieData["path"];
			$domain = $sessionCookieData["domain"];
			$secure = $sessionCookieData["secure"];
			$httponly = $sessionCookieData["httponly"];

			$name = session_name();

			setcookie($name, "", time() - 3600, $path, $domain, $secure, $httponly);

		}

		session_destroy();

	}

	//Starta en ny session alt. ge tillträde till en redan befintlig session
	session_start();

	//Användaren har tryckt på submit-knappen btnSend
	if( isset( $_POST["btnSend"] ) ) {

		//Hämta inkommande data från formuläret input type=color
		$bgColor = $_POST["backgroundcolor"];
		$fgColor = $_POST["foregroundcolor"];

		//Skapa två kakor med färgerna
		//setcookie("fgColor", $fgColor, time() + 3600);
		//setcookie("bgColor", $bgColor, time() + 3600);

		//Skapa två sessionsvariabeler
		$_SESSION["fgColor"] = $fgColor;
		$_SESSION["bgColor"] = $bgColor;
		//Sätt om variabelvärdena
		$disabled = "";
	}

	//Användaren har tryckt på submit-knappen btnReset OCH kakorna kommer till servern
	if( isset( $_POST["btnReset"]) && isset( $_SESSION["bgColor"]) && isset( $_SESSION["fgColor"] ) ) {

		//Radera kakorna
		//setcookie("fgColor", "", time() - 3600);
		//setcookie("bgColor", "", time() - 3600);

		deleteSession();


	}

	//Användaren har inte tryckt på varken btnSend eller btnReset men i requesten till servern kommer 
	//kakorna bgColor och fgColor med.
	if( !isset( $_POST["btnSend"] ) && 
		!isset( $_POST["btnReset"] ) && 
		isset( $_SESSION["bgColor"] ) && 
		isset( $_SESSION["fgColor"]) ) {

		//Hämta data från kakorna
		$bgColor = $_SESSION["bgColor"];
		$fgColor = $_SESSION["fgColor"];

		//Sätt om variabelvärden
		$disabled = "";
	}


?>
<!doctype html>
<html lang="en" >
	<head>
		<meta charset="utf-8" />
		<title>Kakor exempel 3</title>
		<style>
			body { 	color: <?php echo($fgColor); ?>; 
					background-color: <?php echo($bgColor); ?>;
			}
		</style>
	</head>
	<body>

		<div>

			<div>
				Här kommer lite dummy text för att illustrera att kakorna faktiskt gör skillnad. :-)
			 </div>
			
			<form action="<?php echo( $_SERVER["PHP_SELF"] ); ?>" method="post">
		
				<input type="color" name="backgroundcolor" value="<?php echo( $bgColor ); ?>" > <!-- Skriv ut färgvärdet -->
				<input type="color" name="foregroundcolor" value="<?php echo( $fgColor ); ?>" > <!-- Skriv ut färgvärdet -->

				<input type="submit" name="btnSend" value="Send" >
				<input type="submit" name="btnReset" value="Reset" <?php echo( $disabled ); ?> > <!-- Skriv ut disabled eller en tom sträng -->
			
			</form>
			
		</div>
	</body>
</html>