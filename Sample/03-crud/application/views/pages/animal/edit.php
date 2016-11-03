<html>
<head>
	<title></title>
</head>
<body>
	<form action="<?php echo site_url('animal/update/'.$animal->objectId);?>" method="POST">
		<table>
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $animal->metadata->name; ?>"></td>
			</tr>
			<tr>
				<td>Foot</td>
				<td><input type="text" name="foot" value="<?php echo $animal->metadata->foot; ?>"></td>
			</tr>
			<td>
				<td><input type="submit" value="submit"></td>
			</td>
		</table>
	</form>
</body>
</html>