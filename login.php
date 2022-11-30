<?php
session_start();
include 'connect.php';
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM `users` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($password != "" && $email != "") {
        if ($row) {
            if (password_verify($password, $row['password'])) {
                $error = "";
                $_SESSION['name'] = $row["name"];
                header('location:display_product.php');
            } else {
                $error = "Incorrect password";
            }
        } else {

            $error = "Email not already registered";
        }
    } else {
        $error = "Email and password can not be blank";
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
    <title>Login</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4">Login</h2>
        <div class="mx-auto" style="width: 500px;">
            <form class="" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="col-md-3" style="width: 100%;">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="col-md-3 col mt-1" style="width: 100%;">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <br>
                <div class="col-3 col">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <p>
                    <?php if ($error != "") {
                        echo $error;
                    } ?>
                </p>
            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>