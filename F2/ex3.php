<?php
	//Skapa variabel med default-värde
	$disabled = "disabled";
	$bgColor = "#ffffff"; //background-color white
	$fgColor = "#000000"; //color black

	//Här skriver vi koden för hela lösningen!

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
			
			<form action="<?php echo( $_SERVER["PHP_SELF"] ); ?>" method="post">
		
				<input type="color" name="backgroundcolor" value="<?php echo( $bgColor ); ?>" > <!-- Skriv ut färgvärdet -->
				<input type="color" name="foregroundcolor" value="<?php echo( $fgColor ); ?>" > <!-- Skriv ut färgvärdet -->

				<input type="submit" name="btnSend" value="Send" >
				<input type="submit" name="btnReset" value="Reset" <?php echo( $disabled ); ?> > <!-- Skriv ut disabled eller en tom sträng -->
			
			</form>
			
		</div>
	</body>
</html>
