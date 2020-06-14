<?php
require('connection.php');
require('functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$username = validate($_POST['username']);
		$password = validate($_POST['password']);
		//validate input data

		$sql = "select id, username, password from users where username='$username' and password ='$password'"; //sql query to insert new user
		$result = $conn->query($sql);

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			session_start();
			//start session and set session variables
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = $row['id'];
			header('Location: home.php');  //redirect to user home page if logged in
		} else {
			$error = "Invalid credentials";
		}
	} else {
		$error = "Username and password fields are required";
	}
}
?>
<html lang="en">
<title>Soilyze</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">

<link rel="icon" href="/assets/images/favicon.png" type="image/x-icon">

<link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
	<div class="auth-wrapper">
		<div class="auth-content text-center">

			<div class="card">
				<div class="row align-items-center">
					<div class="col-md-12">
						<img src="assets/images/logo.png" alt="Agro" class="img-fluid" align="center">
						<div class="card-body">

							<h4 class="mb-3 f-w-400">Signin</h4>
							<form name="login_info" method="post">

								<div class="input-group mb-3">
									<input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
								</div>
								<div class="input-group mb-4">
									<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
								</div>

								<button type="submit" name="submit" class="btn btn-block btn-primary mb-4 rounded-pill">Signin</button>
							</form>
							<p class="mb-2 text-muted">Want an account? <a href="register.php" class="f-w-400">Register</a></p>
							<!-- <p class="mb-2 text-muted">Forgot password? <a href="reset-password" class="f-w-400">Reset</a></p> -->

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>


	<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/js/plugins/bootstrap.min.js"></script>
	<script src="assets/js/waves.min.js"></script>
	<script src="assets/js/pages/TweenMax.min.js"></script>
	<script src="assets/js/pages/jquery.wavify.js"></script>

	<?php if (isset($error)) : ?>
		<script src="/assets/js/plugins/sweetalert.min.js"></script>
		<script>
			swal("Error", "<?php echo $error ?>", "error");
		</script>
	<?php endif; ?>
</body>

</html>