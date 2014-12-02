<!DOCTYPE html>
<html>
	<head>
		<?php include("header.php"); ?>
	</head>
	<body><center>
		<table style="width : 75%">
			<tr><td>
				<h1>spice catalogue</h1>
			</td></tr>
	<form action="purchase.py">
<?php
	$maxcols = 3;
	$fp = fopen("spices.csv", 'r');
	$count = 0;
	$number = 0;
	echo '<tr>';
	while($contents = fgetcsv($fp, 1000, ",")) {
		$name = $contents[0];
		$quantity = $contents[1];
		$price = $contents[2];
		$url = $contents[3];
		$description = $contents[4];
		if ($quantity > 0) {
			if ($count > 2) {
				echo '<tr>';
			}
			echo '<td style="width : 33%">';
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
                <input type=\"integer\" name=\"quantity\" size=3c value=0> g at $price BTC/g
		<br>
        </div>
</div>\n";
			$number++;
			echo '</td>';
			if ($count > 2) {
				echo '</tr>';
				$count = 0;
			}
			$count++;
		} else {
			echo '</tr>';
		}
	}
?>
			</form>
		</table>
	</center></body>
</html>
