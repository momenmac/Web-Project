<?php
if (!isset($_SESSION)) {
    header("location: index.php");
}
if(isset($_SESSION['username'])){
    include('../Server/connection.php');
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username_id'] = $user['user_id'];
    }
    unset($_SESSION['username']);
}
elseif (isset($_POST['signInButton'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if ($stmt = $conn->prepare("SELECT user_id, user_password,role FROM users WHERE user_name = ?")) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id, $hashed_password,$role);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                echo '<div id="success-message" style="background-color: forestgreen; color: white">Signed in successfully</div>';
                echo '<script>
        setTimeout(function() {
            document.getElementById("success-message").style.display = "none";
        }, 3000);
      </script>';
                $_SESSION['username_id'] = $user_id;
                $_SESSION['logged_in'] = true;
                $_SESSION['role'] = $role;
                unset($_SESSION['cart']);
                // Prepare SQL statement to fetch cart items with product details for the logged-in user
                $stmt = $conn->prepare("SELECT ci.product_id, p.product_name, p.product_price, p.product_image,
                            p.product_special_offer, p.product_category, p.quantity_in_stock, ci.quantity
                            FROM cart_items ci
                            INNER JOIN products p ON ci.product_id = p.product_id
                            WHERE ci.user_id = ?");
                $stmt->bind_param("i", $_SESSION['username_id']);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if cart items exist for the user
                if ($result->num_rows > 0) {
                    // Initialize cart array in session
                    $_SESSION['cart'] = array();

                    // Fetch and add cart items with product details to the session
                    while ($row = $result->fetch_assoc()) {
                        $product = [
                            'product_id' => $row['product_id'],
                            'product_name' => $row['product_name'],
                            'product_price' => $row['product_price'],
                            'product_image' => $row['product_image'],
                            'product_special_offer' => $row['product_special_offer'],
                            'product_category' => $row['product_category'],
                            'quantity_in_stock' => $row['quantity_in_stock'],
                            'product_quantity' => $row['quantity']
                        ];

                        $_SESSION['cart'][$row['product_id']] = $product;
                    }

                }
                //wishlist
                $stmt = $conn->prepare("SELECT wi.product_id, p.product_name, p.product_price, p.product_image,
                            p.product_special_offer, p.product_category
                            FROM wishlist_items wi
                            INNER JOIN products p ON wi.product_id = p.product_id
                            WHERE wi.user_id = ?");
                $stmt->bind_param("i", $_SESSION['username_id']);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if wishlist items exist for the user
                if ($result->num_rows > 0) {
                    $_SESSION['wishlist'] = array();

                    // Fetch and add wishlist items with product details to the session
                    while ($row = $result->fetch_assoc()) {
                        $product = [
                            'product_id' => $row['product_id'],
                            'product_name' => $row['product_name'],
                            'product_price' => $row['product_price'],
                            'product_image' => $row['product_image'],
                            'product_special_offer' => $row['product_special_offer'],
                            'product_category' => $row['product_category']
                        ];

                        $_SESSION['wishlist'][$row['product_id']] = $product;
                    }

                }
            }else{
                $_SESSION['logged_in'] = false;
                echo '<div id="success-message" style="background-color: red; color: white">Something went wrong</div>';
                echo '<script>
        setTimeout(function() {
            document.getElementById("success-message").style.display = "none";
        }, 3000);
      </script>';

            }
        } else {
            $_SESSION['logged_in'] = false;
            echo '<div id="success-message" style="background-color: red; color: white">Something went wrong</div>';
            echo '<script>
        setTimeout(function() {
            document.getElementById("success-message").style.display = "none";
        }, 3000);
      </script>';

        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
<header id="header">
  <div id="pc-header">
    <div id="top-header">
      <div id="top-header-left">
        <a href="index.php"><img id="logo-image" src="../IMG/Logo.png" alt="Computers World Logo"></a>
      </div>
      <div id="top-header-middle">
        <form id="search-form" method="get" action="products.php">
          <input id="search-input-box" name="search" type="text" placeholder="Search the store">
        </form>
          <a>
        <lord-icon
                src="https://cdn.lordicon.com/kkvxgpti.json"
                trigger="hover"
                colors="primary:#161880"
                style="width:40px;height:40px">
        </lord-icon>
          </a>
      </div>

      <div class="top-header-right">
        <a href="javascript:showWishlistPanel()" class="top-header-right-icons">
          <lord-icon
                  src="https://cdn.lordicon.com/xyboiuok.json"
                  trigger="hover"
                  target=".top-header-right-icons"
                  colors="primary:#FFBC03"
                  style="width:35px;height:35px">
          </lord-icon>
          <div>Wish List</div>
        </a>
          <?php echo isset($_SESSION['username_id'])
              ? '<a href="account.php" class="top-header-right-icons">'
              : '<a href="javascript:showLoginPanel()" class="top-header-right-icons">';?>
          <lord-icon
                  src="https://cdn.lordicon.com/kthelypq.json"
                  trigger="hover"
                  target=".top-header-right-icons"
                  colors="primary:#FFBC03"
                  style="width:35px;height:35px">
          </lord-icon>

          <div><?php echo isset($_SESSION['username_id']) ? 'Account' : 'Sign in'; ?></div>
        </a>


        <a href="javascript:showCartPanel()" class="top-header-right-icons">
          <div class="cart-button">
            <lord-icon
                    src="https://cdn.lordicon.com/mfmkufkr.json"
                    trigger="hover"
                    target=".top-header-right-icons"
                    colors="primary:#FFBC03"
                    style="width:35px;height:35px;">
            </lord-icon>
            <span class="cart-badge"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
          </div>
          <div>Cart</div>
        </a>
      </div>
    </div>
  </div>



  <div id="mobile-header">

  </div>
</header>
<div id="down-header">


  <div class="logo-fixed">
    <a href="index.php"><img id="logo-image2" src="../IMG/Logo.png" alt="Computers World Logo"></a>    </div>
  <div class="navPages-container"></div>

  <div class="down-header-container">
    <nav class="navPages">

      <ul class="navPages-list" data-level-list="1">
        <li class="navPages-list-icons active-navbar" id="home-navPage"><a href="index.php">Home
          <span class="test">New</span></a> </li>
        <li class="navPages-list-icons">
          <a href="products.php?search=console">
            Console&nbsp;
            <lord-icon
                    src="https://cdn.lordicon.com/rmkahxvq.json"
                    trigger="hover"
                    target=".navPages-list-icons"
                    state="hover-arrow-down-2"
                    colors="primary:#ffffff"
                    style="width:20px;height:20px">
            </lord-icon></a>
          <div class="navPages-hidden">
            <div class="transparent">.</div>
            <div class="navPages-hidden-container">
              <div class="navPages-hidden-container-inside">
                <div class="navPages-hidden-container-inside-top">
                  <div class="col1">
                    <div><a href="products.php?search=Xbox"><b>Xbox</b></a></div>
                    <a href="products.php?search=Xbox One S"><div>Xbox One S</div></a>
                    <a href="products.php?search=Xbox One X"><div>Xbox One X</div></a>
                    <a href="products.php?search=Xbox Onproducts.php?search=Xbox 360"><div>Xbox One</div></a>
                    <a href="products.php?search=Xbox 360"><div>Xbox 360</div></a>
                    <a href="products.php?search=Xbox Accessories"><div>Xbox Accessories</div></a>
                  </div>

                  <div class="col1">
                    <div><a href="products.php?search=Nintendo"><b>Nintendo</b></a></div>
                    <a href="products.php?search=Nintendo Switch"><div>Nintendo Switch</div></a>
                    <a href="products.php?search=Nintendo Switch OLED"><div>Nintendo Switch OLED</div></a>
                    <a href="products.php?search=Nintendo Switch Lite"><div>Nintendo Switch Lite</div></a>
                    <a href="products.php?search=Nintendo Accessories"><div>Nintendo Accessories</div></a>
                  </div>

                  <div class="col1">
                    <div><a href="products.php?search=Playstation"><b>Playstation</b></a></div>
                    <a href="products.php?search=Playstation 5 Pro"><div>Playstation 5 Pro</div></a>
                    <a href="products.php?search=Playstation 5 Lite"><div>Playstation 5 Lite</div></a>
                    <a href="products.php?search=Playstation Portable"><div>Playstation Portable</div></a>
                    <a href="products.php?search=Playstation 4 series"><div>Playstation 4 series</div></a>
                    <a href="products.php?search=Playstation Accessories"><div>Playstation Accessories</div></a>
                  </div>


                  <div class="col1">
                    <div><a href="products.php?search=console others"><b>Others</b></a></div>
                    <a href="products.php?search=Old Consoles"><div>Old Consoles</div></a>
                    <a href="products.php?search=Other Accessories console"><div>Other Accessories</div></a>
                    <a href="products.php?search= Portable Consoles"><div>Portable Consoles</div></a>
                    <a href="products.php?search=Consoles Parts"><div>Consoles Parts</div></a>
                  </div>



                </div>
                <div class="navPages-hidden-container-inside-bottom">
                  <img src="../IMG/console1.jpg">
                  <img src="../IMG/console3.jpg">
                  <img src="../IMG/console2.jpg">
                  <img src="../IMG/console4.jpg">

                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="navPages-list-icons">
          <a href="products.php?search=computers">
            Computers&nbsp;
            <lord-icon
                    src="https://cdn.lordicon.com/rmkahxvq.json"
                    trigger="hover"
                    target=".navPages-list-icons"
                    state="hover-arrow-down-2"
                    colors="primary:#ffffff"
                    style="width:20px;height:20px">
            </lord-icon>
          </a>
          <div class="navPages-hidden">
            <div class="transparent">.</div>
            <div class="navPages-hidden-container">
              <div class="navPages-hidden-container-inside">
                <div class="navPages-hidden-container-inside-top">
                  <div class="col1">
                    <div><a href="#"><b>Hardware</b></a></div>
                    <a href="products.php?search=cpu"><div>Computers CPU</div></a>
                    <a href="products.php?search=motherboards"><div>Motherboards</div></a>
                    <a href="products.php?search=graphics cards"><div>Graphics Cards</div></a>
                    <a href="products.php?search=memories"><div>Memories</div></a>
                    <a href="products.php?search=hard drives"><div>Hard Drives</div></a>
                    <a href="products.php?search=power supplies"><div>Power Supplies</div></a>

                  </div>

                  <div class="col1">
                    <div><a href="#"><b>Case Parts</b></a></div>
                    <a href="products.php?search=cases"><div>Cases</div></a>
                    <a href="products.php?search=cpu cooler"><div>CPU Coolers</div></a>
                    <a href="products.php?search=gpu cooler"><div>GPU Coolers</div></a>
                    <a href="products.php?search=rgb lights"><div>RGB Lights</div></a>
                    <a href="products.php?search=case fans"><div>Case FANS</div></a>

                  </div>

                  <div class="col1">
                    <div><a href="products.php?search=monitors"><b>PCs & Monitors</b></a></div>
                    <a href="products.php?search=desktops"><div>Desktops</div></a>
                    <a href="products.php?search=workstation"><div>Workstations</div></a>
                    <a href="products.php?search=laptop"><div>Laptops</div></a>
                    <a href="products.php?search=tablet"><div>Tablets</div></a>
                    <a href="products.php?search=monitors"><div>Monitors</div></a>
                  </div>


                  <div class="col1">
                    <div><a href="#"><b>Accessories</b></a></div>
                    <a href="products.php?search=mouses"><div>Mouses</div></a>
                    <a href="products.php?search=keyboards"><div>Keyboards</div></a>
                    <a href="products.php?search=headsets"><div>Headsets</div></a>
                    <a href="products.php?search=microphones"><div>Microphones</div></a>
                    <a href="products.php?search=speakers"><div>Speakers</div></a>
                  </div>



                </div>
                <div class="navPages-hidden-container-inside-bottom">
                  <img src="../IMG/Computers1.jpg">
                  <img src="../IMG/Computers2.jpg">
                  <img src="../IMG/Computers3.jpg">
                  <img src="../IMG/computers4.jpg">

                </div>
              </div>
            </div>
          </div>
        </li>


        <li class="navPages-list-icons">
          <a href="products.php?search=cards">
            Cards&nbsp;
            <lord-icon
                    src="https://cdn.lordicon.com/rmkahxvq.json"
                    trigger="hover"
                    target=".navPages-list-icons"
                    state="hover-arrow-down-2"
                    colors="primary:#ffffff"
                    style="width:20px;height:20px">
            </lord-icon></a>
          <div class="navPages-hidden">
            <div class="transparent">.</div>
            <div class="navPages-hidden-container">
              <div class="navPages-hidden-container-inside">
                <div class="navPages-hidden-container-inside-bottom" style="height: 80%; margin-top: 60px">
                  <img src="../IMG/cards1.jpg" onclick="window.location.href = 'products.php?search=Playstation cards';">
                  <img src="../IMG/cards2.jpg" onclick="window.location.href = 'products.php?search=Xbox cards';">
                  <img src="../IMG/cards3.jpg" onclick="window.location.href = 'products.php?search=Nintendo cards';">
                  <img src="../IMG/cards4.jpg" onclick="window.location.href = 'products.php?search=Google store cards';">
                  <img src="../IMG/cards5.jpg" onclick="window.location.href = 'products.php?search=Itunes cards';">
                  <img src="../IMG/cards6.jpg" onclick="window.location.href = 'products.php?search=Steam cards';">
                  <img src="../IMG/cards7.jpg" onclick="window.location.href = 'products.php?search=Amazon cards';">
                  <img src="../IMG/cards8.jpg" onclick="window.location.href = 'products.php?search=other cards';">

                </div>
              </div>
            </div>
          </div>
        </li>

        <li class="navPages-list-icons">
          <a href="products.php?search=Accessories">
            Accessories&nbsp;
            <lord-icon
                    src="https://cdn.lordicon.com/rmkahxvq.json"
                    trigger="hover"
                    target=".navPages-list-icons"
                    state="hover-arrow-down-2"
                    colors="primary:#ffffff"
                    style="width:20px;height:20px">
            </lord-icon>
            <span class="test" id="accessories-badge">Sale</span></a>
          <div class="navPages-hidden">
            <div class="transparent">.</div>
            <div class="navPages-hidden-container">
              <div class="navPages-hidden-container-inside">
                <div class="navPages-hidden-container-inside-top">
                  <div class="col1">
                    <div><a href="#"><b>Office</b></a></div>
                    <a href="products.php?search=desks"><div>Desks</div></a>
                    <a href="products.php?search=chairs"><div>Chairs</div></a>
                    <a href="products.php?search=printers"><div>Printers</div></a>
                    <a href="products.php?search=routers"><div>Routers</div></a>
                    <a href="products.php?search=bags"><div>Bags</div></a>
                  </div>

                  <div class="col1">
                    <div><a href="#"><b>Phones</b></a></div>
                    <a href="products.php?search=charger"><div>Chargers</div></a>
                    <a href="products.php?search=cases"><div>Cases</div></a>
                    <a href="products.php?search=headphones"><div>Headphones</div></a>
                    <a href="products.php?search=car"><div>Car phone Accessories</div></a>
                  </div>

                  <div class="col1">
                    <div><a href="#"><b>PC Accessories</b></a></div>
                    <a href="products.php?search=ups"><div>UPS</div></a>
                    <a href="products.php?search=external cables"><div>External Cables</div></a>
                    <a href="products.php?search=hard drives"><div>External Hard Drives</div></a>
                    <a href="products.php?search=drawing boards"><div>Drawing Boards</div></a>
                    <a href="products.php?search=adapters"><div>Adapters & Hubs</div></a>
                  </div>


                  <div class="col1">
                    <div><a href="#"><b>Others</b></a></div>
                    <a href="products.php?search=tv"><div>TVs</div></a>
                    <a href="products.php?search=mounts"><div>Mounts & Arms</div></a>
                    <a href="products.php?search=cameras"><div>Cameras</div></a>
                    <a href="products.php?search=software"><div>Software</div></a>
                  </div>



                </div>
                <div class="navPages-hidden-container-inside-bottom">
                  <img src="../IMG/Accessories1.jpg">
                  <img src="../IMG/Accessories2.jpg">
                  <img src="../IMG/Accessories3.jpg">
                  <img src="../IMG/Accessories4.jpg">

                </div>
              </div>
            </div>
          </div>

        </li>
        <li class="navPages-list-icons">
          <a href="http://localhost/Web-Project/HTML/about.php">
            About&nbsp;
            <lord-icon
                    src="https://cdn.lordicon.com/rmkahxvq.json"
                    trigger="hover"
                    target=".navPages-list-icons"
                    state="hover-arrow-down-2"
                    colors="primary:#ffffff"
                    style="width:20px;height:20px">
            </lord-icon></a>
          <div class="navPages-hidden" style="width: 170px; left:auto;">
            <div class="transparent">.</div>
            <div class="navPages-hidden-container" style="height:auto; gap: 0; display: block">
              <div class="navPages-hidden-container-inside">
                <div class="navPages-hidden-container-inside-top" style="width: 100%; padding-left: 32px; padding-right: 0; margin-top: 0">
                  <div class="col1" style="width: 100%">
                      <a href="http://localhost/Web-Project/HTML/about.php#about-us"><div>About Us</div></a>
                      <a href="http://localhost/Web-Project/HTML/about.php#contact-us"><div>Contact Us</div></a>
                      <a href="http://localhost/Web-Project/HTML/about.php#our-team"><div>Our Team</div></a>
                      <a href="http://localhost/Web-Project/HTML/about.php#location"><div>Location</div></a>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </li>

      </ul>
    </nav>
    <div class="header-bottom-fixed"></div>
  </div>

  <div class="header-bottom-right">
    <div class="top-header-right" id="top-header-right">
      <a href="javascript:showWishlistPanel()" class="top-header-right-icons">
        <lord-icon
                src="https://cdn.lordicon.com/xyboiuok.json"
                trigger="hover"
                target=".top-header-right-icons"
                colors="primary:#FFBC03"
                style="width:35px;height:35px">
        </lord-icon>
      </a>

        <?php echo isset($_SESSION['username_id'])
            ? '<a href="account.php" class="top-header-right-icons">'
            : '<a href="javascript:showLoginPanel()" class="top-header-right-icons">';?>        <lord-icon
                src="https://cdn.lordicon.com/kthelypq.json"
                trigger="hover"
                target=".top-header-right-icons"
                colors="primary:#FFBC03"
                style="width:35px;height:35px">
        </lord-icon>
      </a>


      <a href="javascript:showCartPanel()" class="top-header-right-icons">
        <div class="cart-button">
          <lord-icon
                  src="https://cdn.lordicon.com/mfmkufkr.json"
                  trigger="hover"
                  target=".top-header-right-icons"
                  colors="primary:#FFBC03"
                  style="width:35px;height:35px;">
          </lord-icon>
          <span class="cart-badge"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
        </div>
      </a>
    </div>

  </div>

</div>
