<!DOCTYPE HTML>
<html>
	<head>
		<?php include("header.php"); ?>
	</head>

	<body>
		<br>
		<center><table style="width:75%">
			<tr> <td>
				<h1>login</h1>
				<form name = "input" action="../../cgi-bin/log.cgi" method="POST">
					Username<br>
					<input type="text" name="username"> 
					<br>
					Password<br>
					<input type="password" name="password"></br>
					<br>
					<input type="submit" value="Submit">
					<br>
				</form>
			</td></tr>
		</table></center>
	</body>

<html>
