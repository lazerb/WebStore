<!DOCTYPE html>

<html>
	<head>
		<?php include("header.php"); ?>
	</head>
	<body><center>
		<table style="width : 75%">
			<form action="purchase.py" method="GET">
			<tr><td>
				<h1>spice catalogue</h1>
			</td><td></td>
			<td style="text-align:right;">
				<br>
				<br>
				<?php
					#Check if username is present in the webpage
					if ($_GET['username'] != "") {
						echo '<input type="submit" value="Purchase" style="font-size : 40px;;font-family : Verdana, Helvetica, sans-serif">';
						echo "<br>Logged in as " . $_GET['username'];
					}
?>
			</td>
			</tr>
	<?php
	echo '
<input type="hidden" name="username" value="' . $_GET['username'] . '"/>';
	$maxcols = 3;
	$fp = fopen("spices.csv", 'r');
	$count = 0;
	$number = 0;
	echo '<tr>';
	#Load spices
	while($contents = fgetcsv($fp, 1000, ",")) {
		$name = $contents[0];
		$quantity = $contents[1];
		$price = $contents[2];
		$url = $contents[3];
		$description = $contents[4];
		if ($quantity > 0) {
			#If amount of spices in store greater than 0
			if ($count == 0) {
				#Create new table row
				echo '<tr>';
			}
			echo '
<td style="width : 33%">';
			echo "
<div class=\"spicebox\" id=$number>
        <h2 style=\"text-align:center\">$name</h2>
        <div style=\"text-align:center;\">
                <img src=\"$url\"  style=\"width:128px;height:128px;overflow:hidden;\">
        </div>
        <p style=\"text-align:center\">
                $description
        </p>
        <div style=\"text-align:center;\">
		Quantity:<br>
                <input type=\"integer\" name=\"$name\" size=3c value=0> kg at $price BTC/kg
		<br>
        </div>
</div>";
			$number++;
			echo '</td>';
			$count++;
			if ($count > 2) {
				echo '</tr>';
				$count = 0;
			}
		}
	}
?>
			</form>
		
		</table>
	</center></body>
</html>
