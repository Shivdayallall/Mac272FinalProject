<?php
    require __DIR__ . "/dbConnection.php";
    session_start();


    if(filter_input(INPUT_GET, 'action') == 'delete') {
        // iterate over all products in shopping cart until it matches the get id
        foreach($_SESSION['shopping_cart'] as $key => $product) {
            if($product['id'] == filter_input(INPUT_GET, 'id')) {
                // remove product frpm the cart if the id matches
                unset($_SESSION['shopping_cart'][$key]);
            }
        }
        // reset array keys to match with products id
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- Bootstrap css link, css link must be place before your own css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="table-style.css">


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

<body class="bg-dark">

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

    <!-- <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Navbar</a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Page-1.php">Home</a>
                        </li>
                    </ul>
                </div>
        </nav>
    </header> -->

    <div class="container-fluid">
        <table class="table table-dark table-striped" id="cart">
            <thead>
                <tr>
                    <th scope="col">Item Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(!empty($_SESSION["shopping_cart"])):
                        $total = 0;
                        foreach($_SESSION["shopping_cart"] as $key => $product):
                ?>
                <tr>
                    <td><?php echo $product['foodname']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td>$<?php echo $product['foodprice']; ?></td>
                    <td>$<?php echo number_format ($product['quantity'] * $product['foodprice'], 2); ?></td>
                    <td>
                        <a href="cart.php?action=delete&id=<?php echo $product['id'];?>">
                            <button class="btn-danger">
                                remove
                            </button
                        </a>
                    </td>

                </tr>
                <?php 
                    $total = $total + ($product['quantity'] * $product['foodprice']);
                        endforeach;
                        
                ?>
                <tr>
                    <td colspan="4" align="right">SubTotal:<td>$<?php echo number_format($total, 2); ?></td>
                </tr>

                <tr>
                    <td colspan="4" align="right">  
                        <div class="d-grid gap-2" id="btn">
                            <button class="btn btn-info" type="button">checkout</button>
                        </div>
                    </td>

                </tr>

                <tr>
                    <!-- show the checkout button only if the shopping cart is not empty -->
                    <?php 
                        if(isset($_SESSION['shopping_cart'])):
                        if(count($_SESSION['shopping_cart']) > 0):
                    ?>
                    <?php endif; endif; ?>
                </tr>
                <?php 
                    endif;
                ?>
                
            </tbody>

        </table>
    </div>






    <!-- Bootstrap js links, js links must be placed before your own js script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/ tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>