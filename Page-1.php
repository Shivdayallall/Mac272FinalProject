<?php
session_start();
require __DIR__ . "/dbConnection.php";



$itemIds = array();
//session_destroy();




// check if add to cart button have been press
if (filter_input(INPUT_POST, 'add_to_cart')) {

  if (isset($_SESSION['shopping_cart'])) {

    // keep track of the number of items in the shopping cart
    $count = count($_SESSION['shopping_cart']);

    // create an array for matching keys to the product id
    $itemIds = array_column($_SESSION['shopping_cart'], 'id');

    // check if the product with the current id exist in the array
    if (!in_array(filter_input(INPUT_GET, 'id'), $itemIds)) {
      $_SESSION['shopping_cart'][$count] = array(
        'id' => filter_input(INPUT_GET, 'id'),
        'foodname' => filter_input(INPUT_POST, 'foodname'),
        'foodprice' => filter_input(INPUT_POST, 'foodprice'),
        'quantity' => filter_input(INPUT_POST, 'quantity')
      );
    } else {
      // if product in cart already, increase the quanity
      // match key to product to cart
      for ($i = 0; $i < count($itemIds); $i++) {
        if ($itemIds[$i] == filter_input(INPUT_GET, 'id')) {

          // add item quantity to existing product to the array
          $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
        }
      }
    }
  } else {
    $_SESSION['shopping_cart'][0] = array(
      'id' => filter_input(INPUT_GET, 'id'),
      'foodname' => filter_input(INPUT_POST, 'foodname'),
      'foodprice' => filter_input(INPUT_POST, 'foodprice'),
      'quantity' => filter_input(INPUT_POST, 'quantity')
    );
  }
}



// pre_r($_SESSION);

// function pre_r($array)
// {
//   echo '<pre>';
//   print_r($array);
//   echo '</pre>';
// }

?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">

  <title>Page 1</title>

  <!-- Bootstrap css link, css link must be place before your own css link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Custome food container styles -->
  <link rel="stylesheet" href="homePage.css">



  <link rel="stylesheet" href="nicepage.css" media="screen">
  <link rel="stylesheet" href="Page-1.css" media="screen">

  <link rel="stylesheet" href="homePage.css" media="screen">

  <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
  <meta name="generator" content="Nicepage 4.19.3, nicepage.com">
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">

  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "",
      "logo": "images/default-logo.png"
    }
  </script>
  <meta name="theme-color" content="#478ac9">
  <meta property="og:title" content="Page 1">
  <meta property="og:type" content="website">
</head>

<body class="u-body u-overlap u-xl-mode" data-lang="en">
<header class="u-clearfix u-header u-header" id="sec-6ab4">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <a href="https://nicepage.com" class="u-image u-logo u-image-1">
        <img src="images/default-logo.png" class="u-logo-image u-logo-image-1">
      </a>
      <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1">
        <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
          <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
            <svg class="u-svg-link" viewBox="0 0 24 24">
              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use>
            </svg>
            <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
              <g>
                <rect y="1" width="16" height="2"></rect>
                <rect y="7" width="16" height="2"></rect>
                <rect y="13" width="16" height="2"></rect>
              </g>
            </svg>
          </a>
        </div>
        <div class="u-nav-container">
          <ul class="u-nav u-unstyled u-nav-1">

            <li class="u-nav-item">
              <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="cart.php" style="padding: 10px 20px;">Cart
                <!-- display the shopping cart with the amount of items in the cart -->
                <?php 
                  if(isset($_SESSION['shopping_cart'])) {
                    $count = count($_SESSION["shopping_cart"]);
                    echo "<span id='cart_count' class='text-warning bg-info'>$count</span>";
                  } else {
                    echo "<span id='cart_count' class='text-warning bg-info'>0</span>";
                  }
                
                
                ?>
            </a>
            </li>
          </ul>
        </div>
        <div class="u-nav-container-collapse">
          <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
            <div class="u-inner-container-layout u-sidenav-overflow">
              <div class="u-menu-close"></div>
              <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="cart.php">Cart</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
        </div>
      </nav>
    </div>
  </header>






  <?php
  $sql = "SELECT * FROM foodtable";
  $result = mysqli_query($conn, $sql);
  ?>


  <!-- Banner image -->
  <section class="u-clearfix u-image u-shading u-section-1" id="carousel_020b">
    <div class="u-container-style u-expanded-width u-group u-image u-image-1">
      <div class="u-container-layout u-container-layout-1">
        <img src="images/bd59666e996bb8829ad08ab39512bc92.png" alt="" class="u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-image u-image-contain u-image-default u-image-2">
        <div class="u-shape u-shape-circle u-white u-shape-1"></div>
      </div>
    </div>
    <div class="u-align-center u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-container-style u-group u-group-2">
      <div class="u-container-layout u-valign-middle u-container-layout-2">
        <h1 class="u-text u-text-body-alt-color u-text-1">Our Passion<br> For Delicious<br> food
        </h1>
      </div>
    </div>
  </section>

  <section class="u-clearfix u-section-2" id="carousel_8173">
    <div class="u-clearfix u-sheet u-sheet-1">
      <div class="u-align-center u-container-style u-group u-group-1">
        <div class="u-container-layout u-container-layout-1"><span class="u-icon u-icon-circle u-text-grey-40 u-icon-1"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 58 58" style="">
              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-28aa"></use>
            </svg><svg class="u-svg-content" viewBox="0 0 58 58" x="0px" y="0px" id="svg-28aa" style="enable-background:new 0 0 58 58;">
              <g>
                <path d="M45.768,6.161c-1.884-0.244-3.766-0.099-5.608,0.432C37.517,3.106,33.399,1.047,29,1.047s-8.517,2.06-11.16,5.546   c-1.842-0.529-3.724-0.675-5.608-0.432C5.318,7.057,0.06,12.974,0.001,19.925c-0.055,6.503,4.307,12.141,10.608,13.709   c1.496,0.372,2.6,1.653,2.746,3.188l0.838,8.803l-0.001,0l0.479,5.029c0.204,2.146,2.92,3.619,4.062,4.147   c0.163,0.075,0.294,0.131,0.381,0.167c3.142,1.323,6.514,1.984,9.886,1.984c3.371,0,6.74-0.661,9.877-1.982   c0.702-0.29,4.215-1.864,4.449-4.316l0.479-5.029l-0.001,0l0.838-8.803c0.146-1.535,1.25-2.816,2.746-3.188   C53.692,32.065,58.055,26.428,58,19.925C57.94,12.974,52.682,7.057,45.768,6.161z M38.108,53.125   c-5.789,2.438-12.429,2.439-18.222-0.002c-1.247-0.52-3.134-1.724-3.223-2.658l-0.124-1.298c3.955,1.912,8.137,2.88,12.46,2.88   s8.505-0.968,12.46-2.88l-0.124,1.298C41.248,51.399,39.36,52.604,38.108,53.125z M46.908,31.692   c-2.317,0.577-4.027,2.563-4.254,4.94l-0.968,10.162c-4.004,2.151-8.268,3.252-12.686,3.252s-8.682-1.101-12.686-3.252   l-0.968-10.162c-0.227-2.378-1.937-4.363-4.254-4.94c-5.4-1.344-9.139-6.176-9.092-11.75c0.051-5.958,4.56-11.029,10.489-11.797   c0.504-0.065,1.009-0.099,1.513-0.099c1.313,0,2.621,0.222,3.903,0.663l0.724,0.249l0.43-0.634C21.298,5.021,25.014,3.047,29,3.047   s7.702,1.974,9.941,5.278l0.43,0.634l0.724-0.249c1.774-0.61,3.596-0.8,5.416-0.564C51.439,8.913,55.949,13.984,56,19.942   C56.047,25.517,52.308,30.349,46.908,31.692z">
                </path>
                <path d="M18.876,35.055c-0.548,0.068-0.937,0.568-0.868,1.116l1,8c0.063,0.506,0.494,0.876,0.991,0.876   c0.042,0,0.083-0.003,0.125-0.008c0.548-0.068,0.937-0.568,0.868-1.116l-1-8C19.923,35.374,19.418,34.992,18.876,35.055z">
                </path>
                <path d="M26,37.047c-0.552,0-1,0.447-1,1v8c0,0.553,0.448,1,1,1s1-0.447,1-1v-8C27,37.494,26.552,37.047,26,37.047z">
                </path>
                <path d="M39.124,35.055c-0.543-0.063-1.048,0.319-1.116,0.868l-1,8c-0.068,0.548,0.32,1.048,0.868,1.116   c0.042,0.005,0.084,0.008,0.125,0.008c0.497,0,0.928-0.37,0.991-0.876l1-8C40.061,35.623,39.672,35.123,39.124,35.055z">
                </path>
                <path d="M32,37.047c-0.552,0-1,0.447-1,1v8c0,0.553,0.448,1,1,1c0.552,0,1-0.447,1-1v-8C33,37.494,32.552,37.047,32,37.047z">
                </path>
                <path d="M16.011,11.047c-8.348-0.071-9.973,6.717-9.987,6.786c-0.119,0.539,0.223,1.072,0.762,1.19   c0.072,0.016,0.145,0.023,0.215,0.023c0.459,0,0.874-0.318,0.976-0.786c0.012-0.053,1.211-5.329,8.013-5.214   c0.535-0.037,1.005-0.438,1.011-0.989S16.563,11.053,16.011,11.047z">
                </path>
                <path d="M23.389,7.255c-0.437,0.338-0.518,0.966-0.18,1.403c0.337,0.437,0.966,0.516,1.403,0.181   c0.041-0.033,4.222-3.182,8.816,0.027c0.174,0.122,0.374,0.181,0.572,0.181c0.316,0,0.626-0.149,0.821-0.428   c0.316-0.452,0.206-1.076-0.247-1.392C29.943,3.994,25.233,5.833,23.389,7.255z">
                </path>
              </g>
            </svg></span>
          <h3 class="u-text u-text-1">Menu</h3>
        </div>
      </div>


      <!-- Food card container -->
      <div class="foodContainer">

        <?php
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>


            <div class="card mb-3" style="max-width: 540px;">

              <form method="POST" action="page-1.php?action=add&id=<?php echo $row['id']; ?>">

                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="./images/4d5c47276771815f2c8e0f5db9b245f2.jpeg" class="img-fluid rounded-start" alt="...">
                  </div>

                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row['foodname']; ?></h5>
                      <p class="card-text"><?php echo $row['fooddescription']; ?></p>
                      <p class="card-text text-muted">$<?php echo $row['foodprice']; ?></p>

                      <input type="number" name="quantity" class="form-control" value="1" />
                      <input type="hidden" name="foodname" value="<?php echo $row['foodname']; ?>" />
                      <input type="hidden" name="foodprice" value="<?php echo $row['foodprice']; ?>" />
                      <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                    </div>
                  </div>

                </div>

              </form>

            </div>

        <?php
          }
        } else {
          echo "no data";
        }


        mysqli_close($conn);
        ?>





      </div>


    </div>
  </section>

    <!-- Bootstrap js links, js links must be placed before your own js script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

</body>

</html>