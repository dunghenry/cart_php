<?php
include 'connect.php';
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $des = $_POST["des"];
    if ($des != "" && $title != "") {
        $sql = "SELECT * FROM `categories` WHERE title='$title'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $err = "Title has been used";
        } else {
            $sql = "insert into `categories`(title,des) values('$title','$des')";
            $rs = mysqli_query($conn, $sql);
            if ($rs) {
                // header('location:display_category.php');
            } else {
                echo "Create category failed";
                die(mysqli_error($conn));
            }
        }
    } else {
        $error = "All fields cannot be left blank";
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
    <title>Create Category</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4">Create category</h2>
        <div class="mx-auto" style="width: 500px;">
            <form class="" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="col-md-3" style="width: 100%;">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="col-md-3 col mt-1" style="width: 100%;">
                    <label for="des" class="form-label">Description</label>
                    <input type="text" class="form-control" name="des" id="des">
                </div>
                <br>
                <div class="col-3 col">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                <p>
                    <?php if ($error != "") {
                        echo $error;
                    } ?>
                </p>
            </form>
        </div>
    </div>
</body>

</html>