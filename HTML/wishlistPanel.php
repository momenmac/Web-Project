
<?php
if (!isset($_SESSION)) {
    header("location: wishlist.php");
}
?>
<div class="wishlist-right-panel">
    <div class="close-icon" style="cursor: pointer" onclick="hideCartPanel()">
        <div style="width: 50%">
            <lord-icon
                src="https://cdn.lordicon.com/nqtddedc.json"
                trigger="hover"
                style="width:35px;height:35px">
            </lord-icon>

        </div>
        <div style="width: 50%; text-align: left; padding-left: 7px; display: flex; justify-content: right; align-items: center; padding-right: 35px; font-size: 18px;">
            <a href="wishlist.php" class="edit-cart" >Edit Wishlist</a>
        </div>

    </div>
    <b>Wishlist</b>
    <div class="cart-product-container" style="padding: 7px 7px; height: 85%">
        <?php
        if (isset($_SESSION['wishlist']) && !empty($_SESSION['wishlist'])) {
            foreach ($_SESSION['wishlist'] as $item) {
                ?>
                <div class="product-in-cart">
                    <div class="product-in-cart-left">
                        <img src="../Admin/ProductsImages/<?php echo $item['product_image']?>" alt="">
                    </div>
                    <div class="product-name-in-cart">
                        <a href="category.php?category=<?php echo $item['product_category'];?>" ><div style="color: #0a6cdc; margin-top: 15px; font-size: 11px"><?php echo $item['product_category'];?></div></a>
                        <a href="singleProduct.php?product_id=<?php echo $item['product_id']?>">
                            <div class="name">
                                <?php echo $item['product_name']?>
                            </div>
                        </a>

                        <div class="product-price">
                            <?php if ($item['product_special_offer']>0){?>
                                <small style="width: 100%">₪<?php echo $item['product_price']?><br></small>
                            <?php }?>
                            ₪<?php echo $item['product_price']- $item['product_special_offer']?>
                        </div>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class='empty-cart-panel'>Your wishlist is empty</div>

        <?php }
        ?>
    </div>

</div>