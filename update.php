<link href="/assets/style/index.css" rel="stylesheet">
<?php
include "connect.php";//Embeds a database connection file
$get_categories = "SELECT * FROM category";
//declare an SQL query to get all the categories from the "category" table in the database
$categories = mysqli_query($conn, $get_categories);
///executes the query to get the category and stores the results in the variable `$categories`
$categoriesArr = [];
//initialize an empty array to store the catalog.
if ($categories) {
    while ($row = mysqli_fetch_assoc($categories)) {//Check if the directory query was executed successfully
        $categoriesArr[$row['id']] = $row['cate_name'];
    }
}
//This 'while' loop will iterate through each row of results from the category query 
//and store the category information in the `$categories` array. 
//Each element in the `$categories` array will have the key `id` of the category 
//and the value `cate_name` of the category

$get_products = "SELECT * FROM products";
//declare an SQL query to get all the products from the "products" table in the database
$products = mysqli_query($conn, $get_products);
///executes the query to get the products and stores the results in the variable `$products`

$currentURL = $_SERVER['REQUEST_URI']; //get the current URL of the page
$parts = explode('/', $currentURL); //split URL into parts with "/"
$id = end($parts);//get the last element in the array `$parts`, which is the product ID

$getProductById = "SELECT * FROM products WHERE id='$id'"; 
//declare an SQL query to get information of the product with the corresponding ID from the "products" table
$currentProduct = mysqli_query($conn, $getProductById);
//execute the query and store the result in the variable `$currentProduct`

if ($currentProduct && mysqli_num_rows($currentProduct) > 0) {
    $productData = mysqli_fetch_assoc($currentProduct);
}
//checks if the query was successful and has at least one row of data returned. 
//If so, get the product's data and store it in the `$productData` variable.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $thumbnail = $_FILES['thumbnail'];
    $thumbnailName = $thumbnail["name"];
    $thumbnailImpName = $thumbnail["tmp_name"];
    $thumbnailPath = "assets/img" . $thumbnailName;
    move_uploaded_file($thumbnailImpName, $thumbnailPath);

    $sql = "UPDATE products SET prod_name =? ,price=?,category_id=?,thumbnail=? WHERE id=? ";
    //declare a SQL query to update the product information in the "products" table in the database
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdisi", $title, $price, $category, $thumbnailPath, $id);
    //binds the values of variables to the parameters in the SQL query
    if ($stmt->execute()) {
        header("Location:../index.php");
        exit();
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/assets/style/update.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="">
</head>

<body>
   
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

    <form class="row container  " style="margin-left: auto; margin-right: auto;" method="POST" enctype="multipart/form-data">

        <h5 style="text-align: center;letter-spacing: 2px;font-family: Arial
Helvetica; font-size: 22px; margin-top: 16px;  color: black; padding-bottom: 22px;" >UPDATE A PRODUCT</h5>
        <?php foreach ($currentProduct as $product) { ?>
            <div class="row">
                <div class="col-2 mb-3">
                    <label for="product_name" class="form-label" 
                style="font-family: Arial Helvetica; font-weight: 600; font-size: 17px;">Product name</label>
            </div>
                <div class="col-10 mb-2">
                <input type="text" class="form-control" id="product_name" name="name" placeholder="Input product name"
                 value="<?php echo $product["prod_name"]?>">
                </div>
               
            </div>
            <div class="row">
                <div class="col-2 mb-3">
                    <label for="price" class="form-label" 
                style="font-family: Arial Helvetica; font-weight: 600; font-size: 17px;">Price</label>
            </div>
                <div class="col-10 mb-2">
                <input type="number" class="form-control" id="price" name="price" placeholder="Input price" 
                value="<?php echo $product["price"]?>">
                </div>        
            </div>
            <div class="row">
                <div class="col-2 mb-3">
                <label for="category" class="form-label" 
                style="font-family: Arial Helvetica; font-weight: 600; font-size: 17px;">Category</label>
            </div>
                <div class="col-10 mb-2">
                <select class="form-select" id="category" name="category" required>
                    <option selected disabled value="<?php echo $product["category_id"] ?>">
                        <?php echo "#".$categoriesArr[$product["category_id"]] ?>
                    </option>
                    <?php foreach ($categories as $category) { ?>
                        <option class="text-dark" value="<?php echo $category["id"] ?>">
                        <?php echo "#". $category["cate_name"] ?></option>
                    <?php    } ?>
                </select>
                </div>              
            </div>
            <div class="row">
                <div class="col-2 mb-3">
                    <label for="img" class="form-label" 
                style="font-family: Arial Helvetica; font-weight: 600; font-size: 17px;">Image</label>
            </div>
                <div class="col-10 mb-2">
                <input type="file" class="form-control" id="img" name="thumbnail"  
                value="<?php echo $product["thumbnail"]?>">
                </div>           
            </div>
        <?php } ?>
        <div class="d-flex justify-content-center mt-3 gap-3">
            <button type="submit" class="btn btn-success ">Update </button>
            <a href="./index.php" class="btn btn-secondary " type="button">Back to homepage</a>
        </div>

    </form>
    

</body>

</html>