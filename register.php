<?php
include 'connect.php';
$err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cfpassword = $_POST["cfpassword"];
    $address = $_POST["address"];
    if ($name != '' && $email != '' && $password != '' && $cfpassword != '' && $address != '') {
        $sql = "SELECT * FROM `users` WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $err = "Email has been used";
        } else {
            if ($password != $cfpassword) {
                $err = "Password not match";
            } else {
                $hashedPassowrd = password_hash($password, PASSWORD_DEFAULT);
                echo $hashedPassowrd;
                $sql = "insert into `users`(name,email,password,address) values('$name','$email','$hashedPassowrd','$address')";
                $rs = mysqli_query($conn, $sql);
                if ($rs) {
                    header('location:login.php');
                } else {
                    echo "Register failed";
                    die(mysqli_error($conn));
                }
            }
        }
    } else {
        $err = "All fields cannot be left blank";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4">Register</h2>
        <div class="mx-auto" style="width: 500px;">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="col-md-3" style="width: 100%;">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="col-md-3 mt-2" style="width: 100%;">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="col-md-3 col mt-2" style="width: 100%;">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="col-md-3 col mt-2" style="width: 100%;">
                    <label for="cfpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="cfpassword" id="cfpassword">
                </div>
                <div class="col-md-3 col mt-2" style="width: 100%;">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Nhu Hoa - Kim Son - Ninh Binh">
                </div>
                <br>
                <div class="col-3 col">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <p><?php if ($err != "") {
                        echo $err;
                    } ?></p>
            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>