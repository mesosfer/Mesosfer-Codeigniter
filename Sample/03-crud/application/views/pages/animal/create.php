<html>
<head>
	<title></title>
</head>
<body>
	<form action="<?php echo site_url('animal/store'); ?>" method="POST">
		<table>
			<tr>
				<td>Name</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>Foot</td>
				<td><input type="text" name="foot"></td>
			</tr>
			<td>
				<td><input type="submit" value="submit"></td>
			</td>
		</table>
	</form>
</body>
</html>