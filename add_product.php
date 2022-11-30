<?php
include "connect.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname =  $_POST["pname"];
    $category_id = (int)$_POST["category_id"];
    $amount = (int)$_POST["amount"];
    $price = (float)$_POST["price"];
    $extensions = ['png', 'jpg', 'jpeg', 'gif'];
    $file_name = $_FILES['image']['name'];
    if ($pname != "" && $category_id > 0 && $amount > 0 && $price > 0 && !empty($file_name)) {
        $file_size = $_FILES['image']['size'];
        $file_tmp_name = $_FILES['image']['tmp_name'];
        $file_full_path = $_FILES['image']['full_path'];
        $generated_file_name = time() . '_' . $file_name;
        $destination_path = "./images/${generated_file_name}";
        $file_extension = explode('.', $file_name);
        $file_extension = strtolower(end($file_extension));
        if (in_array($file_extension, $extensions)) {
            if ($file_size <= 1000000) {
                move_uploaded_file($file_tmp_name, $destination_path);
                $sql = "insert into `products`(productname,category_id,amount,price,image) values('$pname','$category_id','$amount','$price','$generated_file_name')";
                $rs = mysqli_query($conn, $sql);
            } else {
                $error = "Upload image failed!";
            }
        } else {
            $error =  "File uploaded invalid";
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
    <title>Create Product</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4">Create Product</h2>
        <div class="mx-auto" style="width: 500px;">
            <form method="POST" enctype="multipart/form-data">
                <div class="col-md-3" style="width: 100%;">
                    <label for="pname" class="form-label">Product name</label>
                    <input type="text" class="form-control" name="pname" id="pname">
                </div>
                <div class="col-md-3 mt-2" style="width: 100%;">
                    <label class="form-label">Product group</label>
                    <select class="form-select" name="category_id" aria-label="Default select example">
                        <option selected>Choose product group</option>
                        <?php
                        $sql = "SELECT * FROM categories";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $title = $row['title'];
                                echo '<option value="' . $id . '">' . $title . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 col mt-2" style="width: 100%;">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" name="amount" id="amount">
                </div>
                <div class="col-md-3 col mt-2" style="width: 100%;">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" id="price">
                </div>
                <div class="col-md-3 col mt-2" style="width: 100%;">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <br>
                <div class="col-3 col">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                <!-- <p><?php if ($err != "") {
                            echo $err;
                        } ?></p> -->
            </form>
        </div>

    </div>
</body>

</html>