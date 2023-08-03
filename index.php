<?php
include "connect.php"; 
//Embeds a database connection file, which helps to establish a connection to the database.
$get_products = "SELECT * FROM products";  
//declare an SQL query to get all products from the "products" table in the database.
$get_categories = "SELECT * FROM category"; 
//declare an SQL query to get all the categories from the "category" table in the database.
$products = mysqli_query($conn, $get_products);
//executes the query to get products and stores the results in the variable `$products`.
$categories = [];
//initialize an empty array to store the catalog.
$category = mysqli_query($conn, $get_categories);
//executes the query to get the category and stores the results in the variable `$category`.
if ($category) {  //Check if the directory query was executed successfully.
    while ($row = mysqli_fetch_assoc($category)) {
        $categories[$row['id']] = $row['cate_name'];
    }
}
//This 'while' loop will iterate through each row of results from the category query 
//and store the category information in the `$categories` array. 
//Each element in the `$categories` array will have the key `id` of the category 
//and the value `cate_name` of the category.
?>
<style>
        .flexMain {
    display:flex;
    align-items: center;
    background: linear-gradient(#e66465, #9198e5);
  }
  .flex1 { flex:1 }
  .flex2 { flex:2 }
  .flex3 { flex:12 }
  
  button.siteLink {
    margin-left:-5px;
    border:none;
    padding:24px;
    display:inline-block;
    min-width:115px;
  }
  .whiteLink {
    background : #568afa;
  }
  .whiteLink:active {
    background : #000;
    color: #fff;
  }
  .blackLink {
    color: #fff;
    background:#232323;
    transition: all 300ms linear;
  }
  
  .blackLink:active {
    color: #000;
    background:#fff
  }
  #siteBrand {
    font-family: impact;
    letter-spacing : -1px;
    font-size:32px;
    color:#252525;
    line-height : 1em;
  }
  #menuDrawer {
    background:#fff;
    position:fixed;
    height:100vh;
    overflow:auto;
    z-index:12312;
    top:0;
    left:0;
    border-right:1px solid #eaeaea;
    min-width:25%;
    max-width:320px;
    width:100%;
    transform : translateX(-100%);
    transition : transform 200ms linear;
  }
  #mainNavigation {
    transition : transform 200ms linear;
    background : #fff;
  }
  .drawMenu > #menuDrawer {
    transform : translateX(0%);
  }
  .drawMenu > #mainNavigation {
    transform : translateX(25%);
  }
  .fa-times {
    cursor : pointer
  }
  a.nav-menu-item:hover {
    margin-left:2px;
    border-left:10px solid black;
  }
  a.nav-menu-item{
    transition:border 200ms linear;
    text-decoration:none;
    display:block;
    padding:18px;
    padding-left:32px;
    border-bottom:1px solid #eaeaea;
    font-weight:bold;
    color:#343434
  }
  select.noStyle {
    border:none;
    outline:none
  }
    </style>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./assets/style/index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="">
</head>

<body>
    <!-- prodduct page -->

    <!-- menu -->
    <div id="menuHolder">
        <div role="navigation" class="sticky-top border-bottom border-top" id="mainNavigation">
            <div class="flexMain">
                <div class="flex2">
                    <button class="whiteLink siteLink" style="border-right:1px solid #eaeaea" onclick="menuToggle()"><i class="fas fa-bars me-2"></i> MENU</button>
                </div>
                
                <div class="flex3 text-center" id="siteBrand">ATN STORE</div>
                <div class="flex2 text-end d-block d-md-none">
                    <button class="whiteLink siteLink"><i class="fas fa-search"></i></button>
                </div>


            </div>
        </div>

        <div id="menuDrawer" style="background-color: white;">
            <div class="p-3 border-bottom">
                ATN Store
            </div>
            <div>
                <a href="./index.php" class="nav-menu-item"><i class="fas fa-home me-3"></i>Home</a>
                <a href="./create.php" class="nav-menu-item"><i class="fab fa-product-hunt me-3"></i>New</a>

            </div>
        </div>
    </div>

    <script>
        var siteBrand = document.getElementById('siteBrand')

        function menuToggle() {
            if (menuHolder.className === "drawMenu") menuHolder.className = ""
            else menuHolder.className = "drawMenu"
        }
        if (window.innerWidth < 426) siteBrand.innerHTML = "MAS"
        window.onresize = function() {
            if (window.innerWidth < 420) siteBrand.innerHTML = "MAS"
            else siteBrand.innerHTML = "ATN STORE"
        }
    </script>
    <!-- menu -->

    <!-- bodyhead -->
    <h5 style="text-align: center;letter-spacing: 5px;font-family: Arial
Helvetica; font-size: 30px; margin-top: 5px; background-color: black; color: white;">CATEGORIES</h5>
    <div style="display: flex; justify-content: space-evenly;">
        <div class="row" style="justify-content: space-evenly;margin-top: 10px">
            <div class="col-sm-12 col-md-5 col-lg-3" style="position: relative;">
                <div class="card"  style="position: relative;width:100%">
                    <img class="card-img-top" src="https://m.media-amazon.com/images/I/91SXHJRqWqL.jpg" alt="Card image">
                    <div class="card-img-overlay" style=" text-align:center;" >
                        <div class="content" style=" position: absolute; left: 50%;  top: 76%;  transform: translate(-50%, -50%);" >
                            <h4 class="card-title" >LEGO</h4>
                            <a href="#" class="btn btn-success" >Shop now</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-3" style="position: relative;">
                <div class="card"  style="position: relative;width:100%">
                    <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVx21Bxu7CBdCkg6OAMT1lK3n9QBouZBQq3w&usqp=CAU" alt="Card image">
                    <div class="card-img-overlay" style=" text-align:center;" >
                        <div class="content" style=" position: absolute; left: 50%;  top: 76%;  transform: translate(-50%, -50%);" >
                            <h4 class="card-title" >CAR TOY</h4>
                            <a href="#" class="btn btn-success" >Shop now</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-3" style="position: relative;">
                <div class="card"  style="position: relative;width:100%">
                    <img class="card-img-top" src="https://m.media-amazon.com/images/I/81tbaTxFkqL._AC_UF894,1000_QL80_.jpg" alt="Card image">
                    <div class="card-img-overlay" style=" text-align:center;" >
                        <div class="content" style=" position: absolute; left: 50%;  top: 76%;  transform: translate(-50%, -50%);" >
                            <h4 class="card-title" >OTHES</h4>
                            <a href="#" class="btn btn-success" >Shop now</a>
                        </div>

                    </div>
                </div>
            </div>
  


        </div>
    </div>







    <!-- bodyhead -->



    <h5 style="text-align: center;letter-spacing: 5px;font-family: Arial Helvetica; 
font-size: 30px; margin-top: 15px;">
        PRODUCTS</h5>
    <h5 style="text-align: center;letter-spacing: 5px;font-family: Arial Helvetica; 
font-size: 15px; margin-top: 5px;">
        --New & Hot--</h5>

    <div class="container-fluid text-center mt-2 ">
        <div class="row" style="margin-bottom: 20px;">


            <!-- lg la laptop banh ra 2 cot, md la ...banh ra 5 cot , sm la dien thoai banh ra 12 cot -->

            <?php foreach ($products as $product) {
            ?>
                <div class="col-sm-12 col-md-5 col-lg-2">
                    <div class="card" style=" margin-top: 12px; ">
                        <img src="<?php echo $product['thumbnail']; ?>"  
                        class="card-img-top" alt="<?php echo $product['prod_name']; ?>" height="150px">
                        <!-- the path is taken from the `thumbnail` field  in the `$product` array. -->
                        <!-- the product name is taken from the `prod_name` field in the `$product` array. -->
                        <div class="card-body">
                            <h5 class="card-title "><?php echo $product['prod_name']; ?></h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="price text-primary fs-4" style="font-size: 0.9rem!important;">
                                <strong><?php echo $product['price']; ?></strong></p>
                                <!-- the price is taken from the `price` field in the `$product` array. -->
                                <p class="text-secondary fs-5">
                                    <span class="badge bg-info text-dark " style="padding: 3px; margin-left: 3px;">
                                    <?php echo  $categories[$product['category_id']]; ?>
                                    <!-- category names are retrieved from the `$categories` 
                                    array using the `category_id` keyword in the `$product` array. -->
                                    </span>
                                </p>
                            </div>
                            <a href="./update.php/<?php echo $product["id"]; ?>" class="btn btn-primary w-100">Update</a>
                            <!-- redirect to the product update page with the corresponding ID -->
                            <button type="button" class="btn btn-danger mt-2 w-100" data-bs-toggle="modal" 
                            data-bs-target="#<?php echo $product["id"] ?>">
                                Delete
                            </button>
                            <!-- opens the confirmation dialog to delete the product with the corresponding ID -->

                        </div>
                    </div>
                </div>
                <!-- modal -->
                <div class="modal fade" id="<?php echo $product["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel" >Are you sure to delete ?
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Once you delete, it will be removed from database
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">No, keep
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



<!-- thanh chuyen so trang -->
            <nav aria-label="Page navigation example" >
  <ul class="pagination" style="  margin-top: 34px; text-align: center; justify-content: center;">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

        </div>
    </div>

    <!-- footer -->
    <footer class="text-center text-lg-start bg-white text-muted" style=" background: linear-gradient(#e66465, #9198e5);">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span><strong>Connected with us on social networks:</strong> </span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3 text-secondary"></i>ATN STORE
          </h6>
          <p>
            ATN Store is a best place where have diversity of toys for kids. 
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
            <a href="#!" class="text-reset">LEGO</a>
          </p>
          <p>
            <a href="#!" class="text-reset">CAR TOY</a>
          </p>
          <p>
            <a href="#!" class="text-reset">ORTHERS</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="#!" class="text-reset">Home</a>
          </p>
          <p>
            <a href="#!" class="text-reset">New</a>
          </p>
        
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3 text-secondary"></i> Viet Nam, Ho Chi Minh</p>
          <p>
            <i class="fas fa-envelope me-3 text-secondary"></i>
            atnstore@example.com
          </p>
          <p><i class="fas fa-phone me-3 text-secondary"></i> 0935195087</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
    © 2023 Copyright:
    <a class="text-reset fw-bold" href="#">ATNStore.com</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->


<style>
  .modal-header {
    background-color: #5dc5dd;
}
</style>

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