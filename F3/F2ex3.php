<?php
	//Skapa variabel med default-värde
	$disabled = "disabled";
	$bgColor = "#ffffff"; //background-color white
	$fgColor = "#000000"; //color black

	//Här skriver vi koden för hela lösningen!

	//Om användaren har tryckt på submit-knappen btnSend
	if( isset( $_POST["btnSend"]) ) {

		$bgColor = $_POST["backgroundcolor"];
		$fgColor = $_POST["foregroundcolor"];

		setcookie("bgColor", $bgColor);
		setcookie("fgColor", $fgColor);

		$disabled = "";

	}

	//Om användare har tryckt på submit-knappen btnReset och kakorna bgColor och fgColor kommer till servern.
	if( isset( $_POST["btnReset"]) && isset( $_COOKIE["bgColor"]) && isset( $_COOKIE["fgColor"])) {

		setcookie("bgColor", "", time() - 3600);
		setcookie("fgColor", "", time() - 3600);

	}

	//Om användare inte har tryckt på submit-knapparna btnSend eller btnReset och kakorna bgColor och fgColor kommer till servern.
	if( !isset( $_POST["btnSend"]) && !isset( $_POST["btnReset"]) && isset($_COOKIE["bgColor"]) && isset($_COOKIE["fgColor"]) ) {


		$bgColor = $_COOKIE["bgColor"];
		$fgColor = $_COOKIE["fgColor"];

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
				Här kommer lite dummy text för att illustrera att kakorna faktiskt gör skillnad.
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