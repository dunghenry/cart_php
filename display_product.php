<?php include 'connect.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        table,
        th,
        td {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <h2 class="text-center">All Product</h2>
        <button class="btn btn-primary">
            <a href="add_product.php" class="text-light text-decoration-none">Create Product</a>
        </button>
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th scope=" col">Mã hàng</th>
                    <th scope="col">Tên hàng</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Chọn mua</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['productname'];
                        $amount = $row['amount'];
                        $price = $row['price'];
                        $img = $row['image'];
                        $image = "<img src='./images/$img' style='height: 100px'>";
                        echo '<tr>
                <th scope="row">' . $id . '</th>
                <td>' . $name . '</td>
                <td>' . $amount . '</td>
                <td>' . $price . '</td>
                <td>' . $image . '</td>
                <td>
                    <button class="btn btn-primary">Mua</button>
                </td>
               </tr>';
                    }
                } else {
                    echo "0 results";
                }

                ?>

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>