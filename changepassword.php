<?php
require('auth.php');
require('connection.php');
require('functions.php');
require('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    if (isset($_POST['password']) && isset($_POST['newpassword']) && isset($_POST['repassword'])) {
        //validate input data first
        $password = validate($_POST['password']);
        $newpassword = validate($_POST['newpassword']);
        $repassword = validate($_POST['repassword']);

        $username = $_SESSION['username'];  //get username from session
        if ($newpassword != $repassword) {
            $error = "The new passwords do not match";
        } else {
            $sql = "select password from users where username='$username'";  //check if user exists in database
            $result = $conn->query($sql);
            if ($conn->query($sql)) {
                $sql = "update users set password='$newpassword' where username='$username'"; //sql query to update password
                $result = $conn->query($sql);
                if ($conn->query($sql)) {
                    $success = "Password changed successfully";
                }
                else {
                    $error = "Password not changed";
                }
            } 
            
        }
    } else {
        $error = "Please fill all the fields";
    }
}
?>

<div class="card ">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="mb-4 f-w-400">Change your password</h4>
                </div>
                <form method="post">
                    <div class="row">
                        <div class="col-xl-3"></div>
                        <div class="col-xl-6">

                            <div class="input-group mb-4">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Current password" required>

                            </div>
                            <div class="input-group mb-4">
                                <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="New password" required>

                            </div>
                            <div class="input-group mb-4">
                                <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Confirm password" required>

                            </div>
                            <button class="btn btn-block btn-primary mb-4 rounded-pill">Change password</button>
                        </div>
                    </div>
                </form>
                <div class="col-xl-3"></div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.php');
?>