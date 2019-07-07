<html>
	<head>
		<title>Forgot Password Email</title>
	</head>
	<body>
		<table>
			<tr><td>Dear {{ $name }}!</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>Your account has been successfully updated.<br>
			Your account information is as below with new password:</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>Email: {{ $email }}</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>New Password: {{ $password }}</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>Thanks & Regards,</td></tr>
			<tr><td>E-com website</td></tr>
	</body>
</html>