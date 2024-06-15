<?php
if (!isset($_SESSION)) {
    header("location: cart.php");
}
if(isset($_SESSION['username'])){
    include('../Server/connection.php');
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $user = $stmt->get_result();
    $_SESSION['username_id'] = $user['user_id'];
}
?>
<header id="header">
  <div id="pc-header">
    <div id="top-header">
      <div id="top-header-left">
        <a href="index.php"><img id="logo-image" src="../IMG/Logo.png" alt="Computers World Logo"></a>
      </div>
      <div id="top-header-middle">
        <form id="search-form">
          <input id="search-input-box" type="text" placeholder="Search the store">
        </form>
        <lord-icon
                src="https://cdn.lordicon.com/kkvxgpti.json"
                trigger="hover"
                colors="primary:#161880"
                style="width:40px;height:40px">
        </lord-icon>
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
          <a href="#">
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
                    <div><a href="#"><b>Xbox</b></a></div>
                    <a href="#"><div>Xbox One S</div></a>
                    <a href="#"><div>Xbox One X</div></a>
                    <a href="#"><div>Xbox One</div></a>
                    <a href="#"><div>Xbox 360</div></a>
                    <a href="#"><div>Xbox Accessories</div></a>
                  </div>

                  <div class="col1">
                    <div><a href="#"><b>Nintendo</b></a></div>
                    <a href="#"><div>Nintendo Switch</div></a>
                    <a href="#"><div>Nintendo Switch OLED</div></a>
                    <a href="#"><div>Nintendo Switch Lite</div></a>
                    <a href="#"><div>Nintendo Accessories</div></a>
                  </div>

                  <div class="col1">
                    <div><a href="#"><b>Playstation</b></a></div>
                    <a href="#"><div>Playstation 5 Pro</div></a>
                    <a href="#"><div>Playstation 5 Lite</div></a>
                    <a href="#"><div>Playstation Portable</div></a>
                    <a href="#"><div>Playstation 4 series</div></a>
                    <a href="#"><div>Playstation Accessories</div></a>
                  </div>


                  <div class="col1">
                    <div><a href="#"><b>Others</b></a></div>
                    <a href="#"><div>Old Consoles</div></a>
                    <a href="#"><div>Other Accessories</div></a>
                    <a href="#"><div>Portable Consoles</div></a>
                    <a href="#"><div>Consoles Parts</div></a>
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
          <a href="#">
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
                    <a href="#"><div>Computers CPU</div></a>
                    <a href="#"><div>Motherboards</div></a>
                    <a href="#"><div>Graphics Cards</div></a>
                    <a href="#"><div>Memories</div></a>
                    <a href="#"><div>Hard Drives</div></a>
                    <a href="#"><div>Power Supplies</div></a>

                  </div>

                  <div class="col1">
                    <div><a href="#"><b>Case Parts</b></a></div>
                    <a href="#"><div>Cases</div></a>
                    <a href="#"><div>CPU Coolers</div></a>
                    <a href="#"><div>GPU Coolers</div></a>
                    <a href="#"><div>RGB Lights</div></a>
                    <a href="#"><div>Case FANS</div></a>

                  </div>

                  <div class="col1">
                    <div><a href="#"><b>PCs & Monitors</b></a></div>
                    <a href="#"><div>Desktops</div></a>
                    <a href="#"><div>Workstations</div></a>
                    <a href="#"><div>Laptops</div></a>
                    <a href="#"><div>Tablets</div></a>
                    <a href="#"><div>Monitors</div></a>
                  </div>


                  <div class="col1">
                    <div><a href="#"><b>Accessories</b></a></div>
                    <a href="#"><div>Mouses</div></a>
                    <a href="#"><div>Keyboards</div></a>
                    <a href="#"><div>Headsets</div></a>
                    <a href="#"><div>Microphones</div></a>
                    <a href="#"><div>Speakers</div></a>
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
          <a href="#">
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
                  <img src="../IMG/cards1.jpg">
                  <img src="../IMG/cards2.jpg">
                  <img src="../IMG/cards3.jpg">
                  <img src="../IMG/cards4.jpg">
                  <img src="../IMG/cards5.jpg">
                  <img src="../IMG/cards6.jpg">
                  <img src="../IMG/cards7.jpg">
                  <img src="../IMG/cards8.jpg">

                </div>
              </div>
            </div>
          </div>
        </li>

        <li class="navPages-list-icons">
          <a href="#">
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
                    <a href="#"><div>Desks</div></a>
                    <a href="#"><div>Chairs</div></a>
                    <a href="#"><div>Printers</div></a>
                    <a href="#"><div>Routers</div></a>
                    <a href="#"><div>Bags</div></a>
                  </div>

                  <div class="col1">
                    <div><a href="#"><b>Phones</b></a></div>
                    <a href="#"><div>Chargers</div></a>
                    <a href="#"><div>Cases</div></a>
                    <a href="#"><div>Headphones</div></a>
                    <a href="#"><div>Car phone Accessories</div></a>
                  </div>

                  <div class="col1">
                    <div><a href="#"><b>PC Accessories</b></a></div>
                    <a href="#"><div>UPS</div></a>
                    <a href="#"><div>External Cables</div></a>
                    <a href="#"><div>External Hard Drives</div></a>
                    <a href="#"><div>Drawing Boards</div></a>
                    <a href="#"><div>Adapters & Hubs</div></a>
                  </div>


                  <div class="col1">
                    <div><a href="#"><b>Others</b></a></div>
                    <a href="#"><div>TVs</div></a>
                    <a href="#"><div>Mounts & Arms</div></a>
                    <a href="#"><div>Cameras</div></a>
                    <a href="#"><div>Software</div></a>
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
          <a href="#">
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
                    <a href="#"><div>About Us</div></a>
                    <a href="#"><div>Contact Us</div></a>
                    <a href="#"><div>Our team</div></a>
                    <a href="#"><div>Location</div></a>
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
