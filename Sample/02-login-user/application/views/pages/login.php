<html>
<head>
	<title>Mesosfer-Login</title>
</head>
<body>
	<form action="<?php echo site_url('user/signin'); ?>" method="POST">
		<table>
			<tr>
				<td>Username</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="submit">
				</td>
			</tr>
		</table>
    </form>
    <?php if($this->session->flashdata('error_message')) : ?>
    	<p style="color:red;"><?php echo $this->session->flashdata('error_message'); ?></p>
	<?php endif; ?>
</body>
</html>