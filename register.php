<?php
require('connection.php');
require('functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])) {
        $name = validate($_POST['name']);
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
        $device = validate($_POST['device']);
        //validate input data

        $sql = "select username from users where username='$username'"; 
        //check if username is already taken by another user
		$result = $conn->query($sql);

		if ($result->num_rows == 1) {
			$error = "This username is taken";
		} else {
            $sql="insert into users(name, device, username, password) values('$name','$device','$username','$password')";//sql query to insert data into users table
            if($conn->query($sql)){
                $success="Account created. Please login to continue";
            } else{
                $error="Account not created";
            }
		}
	} else {
		$error = "Please fill all the fields";
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

<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">

<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content text-center">

            <div class="card">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <img src="assets/images/logo.png" alt="Agro" class="img-fluid" align="center">
                        <div class="card-body">

                            <h4 class="mb-3 f-w-400">Register</h4>
                            <form name="login_info" method="post">

                                <div class="input-group mb-3">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>

                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="device" name="device" class="form-control" placeholder="Device ID" required>

                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="username" name="username" class="form-control " placeholder="Username" required>

                                </div>
                                <div class="input-group mb-4">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="input-group mb-4">
                                    <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Confirm password" required>
                                </div>

                                <button type="submit" onclick="verify()" name="submit" class="btn btn-block btn-primary mb-4 rounded-pill">Register</button>
                            </form>
                            <p class="mb-2 text-muted">Have an account? <a href="/" class="f-w-400">Login</a></p>
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
    <script src="/assets/js/plugins/sweetalert.min.js"></script>
    <!-- <script>
        function verify() {
            var pass = document.getElementById('password');
            var repass = document.getElementById('repassword');
            if (pass != repass) {
                swal("Error", "Two passwords do not match", "error");
                return false;
            } else {
                return true;
            }
        }
    </script> -->

    <?php if (isset($error)) : ?>
        <script src="/assets/js/plugins/sweetalert.min.js"></script>
        <script>
            swal("Error", "<?php echo $error ?>", "error");
        </script>
    <?php endif; ?>

    <?php if (isset($success)) : ?>
        <script src="/assets/js/plugins/sweetalert.min.js"></script>
        <script>
            swal("Success", "<?php echo $success ?>", "success");
        </script>
    <?php endif; ?>
</body>

</html>