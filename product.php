<?php include('header.php')?>

<?php
    if(isset($_GET['goToProduct'])){
        $productId = $_GET['goToProduct'];

        $que = 'SELECT * FROM produkty WHERE id_produktu="'.$productId.'"';
        $answer = $db_connection->query($que);
        $answer = $answer->fetch_array();
    }

    // getProductImages($productId);
?>

    <div class="product-container">
        <div class="product-title"><?php echo $answer[1]; ?></div>
        <div class="product-price"><?php echo $answer[2]; ?></div>
        <div class="product-description"><?php echo $answer[3]; ?></div>

        <!-- <img src="img/product/1.png" alt=""> -->
    </div>

<?php include('footer.php')?>