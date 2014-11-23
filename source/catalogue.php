<!DOCTYPE html>
<html>
	<head>
		<?php include("header.php"); ?>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body><center>
		<table style="width : 75%">
			<tr><td>
				<h1>Spice Catalogue</h1>
			</td></tr>
<?php
	$maxcols = 3;
	$fp = fopen("spices.csv", 'r');
	$count = 0;
	echo '<tr>';
	while($contents = fgetcsv($fp, 1000, ",")) {
		$name = $contents[0];
		$url = $contents[3];
		$description = $contents[4];
		if (strlen($name) > 0) {
			if ($count > 2) {
				echo '<tr>';
			}
			echo '<td style="width : 33%">';
			echo "
<div class=\"spicebox\">
        <h2 style=\"text-align:center\">$name</h2>
        <div style=\"text-align:center;\">
                <img src=\"$url\"  style=\"width:128px;height:128px;overflow:hidden;\">
        </div>
        <p style=\"text-align:center\">
                $description
        </p>
        <div style=\"text-align:center;\">
        <form> Quantity:<br>
                <input type=\"integer\" name=\"quantity\" size=3c value=0>
                g <br>
        </form>
        </div>
</div>\n";
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
		</table>
	</center></body>
</html>
