<?php
include "connect.php";
$get_products = "SELECT * FROM products";
$get_categories = "SELECT * FROM category";
$products = mysqli_query($conn, $get_products);
$categories = [];

$category = mysqli_query($conn, $get_categories);
if ($category) {
    while ($row = mysqli_fetch_assoc($category)) {
        $categories[$row['id']] = $row['cate_name'];
    }
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./assets/style/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="">
</head>

<body>
    <!-- prodduct page -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ATN Toy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./create.php">New</a>
                    </li>


                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container-fluid text-center mt-2 ">
        <div class="row">


            <!-- lg la laptop banh ra 2 cot, md la ...banh ra 5 cot , sm la dien thoai banh ra 12 cot -->

            <?php foreach ($products as $product) {
            ?>
                <div class="col-sm-12 col-md-5 col-lg-2">
                    <div class="card" style=" margin-top: 12px; ">
                        <img src="<?php echo $product['thumbnail']; ?>" class="card-img-top" alt="<?php echo $product['prod_name']; ?>" height="150px">
                        <div class="card-body">
                            <h5 class="card-title "><?php echo $product['prod_name']; ?></h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="price text-primary fs-4"><?php echo $product['price']; ?></p>
                                <p class="text-secondary fs-5">
                                    <span class="badge bg-secondary "><?php echo  $categories[$product['category_id']]; ?>

                                    </span>
                                </p>
                            </div>
                            <a href="./update.php/<?php echo $product["id"];?>" class="btn btn-primary w-100">Update</a>
                            <button type="button" class="btn btn-danger mt-2 w-100" data-bs-toggle="modal" data-bs-target="#<?php echo $product["id"] ?>">
                                Delete
                            </button>
                            
                        </div>
                    </div>
                </div>
                <!-- modal -->
                <div class="modal fade" id="<?php echo $product["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to delete ?
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Once you delete, it will be removed from database
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, keep
                                                it</button>
                                            <button type="button" class="btn btn-danger">
                                                <a href="index.php?delete_product_id=<?php echo $product["id"]; ?>" class="text-white text-decoration-none">
                                                    Yes, delete it
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php }  ?>






        </div>
    </div>



</body>

</html>
<?php
if (isset($_GET['delete_product_id'])) {
    $product_id = $_GET['delete_product_id'];
    $delete_product = "delete from products where id='$product_id'";
    $execute = mysqli_query($conn, $delete_product);

    if ($execute) {
        echo "<script> window.open('index.php','_self')</script>";
    }
}
?>