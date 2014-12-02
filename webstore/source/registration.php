<html>
	<head>
		<?php include("header.php"); ?>
	</head>
	<br />
	<br />
	<body>
		<center><table style="width:75%">
		<tr><td>
			<h1>register</h1>
			<br>
			<form action="/~tbotwi/cgi-bin/uregister.cgi" method="POST">
				Full name:
				<br>
				<input type="text" name="fullname"/>
				<br>
				Age:
				<br>
				<input type="text" size=3c/>
				<br>
				Username:
				<br>
				<input type="text" name="username" />
				<br>
				Password:
				<br>
				<input type="password" name="password" />
				<br>
				Confirm password:
				<br>
				<input type="password" name="confirmpassword" />
				<br>
				<br>
				<input type="submit"/>
			</form>
		</td></tr>
		</table></center>
	</body>
</html>
