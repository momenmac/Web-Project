<div class="cart-right-panel">
    <b>CART</b>
    <div class="cart-product-container">
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {?>
                <div class="product-in-cart">
                    <div class="product-in-cart-left">
                        <img src="../Server/ProductsImages/<?php echo $item['product_image']?>" alt="">
                    </div>
                   <div class="product-name-in-cart">
                       <div class="name">
                       <?php echo $item['product_name']?>
                       </div>
                       <a href="category.php?category=<?php echo $item['product_category'];?>" style="color: #0a6cdc"><span><?php echo $item['product_category'];?></span></a>

                       <div class="product-price">
                           <?php if ($item['product_special_offer']>0){?>
                               <small style="width: 100%">₪<?php echo $item['product_price']?><br></small>
                           <?php }?>
                           ₪<?php echo $item['product_price']- $item['product_special_offer']?>
                       </div>
                   </div>
                    <div class="quantity-product">
                        <?php echo $item['product_quantity'];?>
                    </div>

                </div>
            <?php }
        } else { ?>
        <div class='empty-cart-panel'>Your cart is empty</div>

        <?php }
        ?>
    </div>

</div>