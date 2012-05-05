<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Login</title>
<!-- CSS -->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<form action="loginaction.do" method="post">
		<article id="login">
			<header>Login</header>
			<section>
				<div>
					<div>
						<label>Email</label>
					</div>
					<div>
						<input type="text" name="username" maxlength="40" value="" />
					</div>
				</div>
				<div>
					<div>
						<label>Password</label>
					</div>
					<div>
						<input type="text" name="password" maxlength="40" value="" />
					</div>
				</div>
				<div>
					<div>
						<input type="submit" name="submit" value="Login" />
					</div>
					<div>
						<input type="checkbox" name="remember_me" value="remember_me"
							placeholder="Remember me" /> Remember Me
					</div>
				</div>
			</section>
		</article>
	</form>
</body>
</html>
