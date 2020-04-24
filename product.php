<?php include('header.php')?>

<?php
        $productId = $_GET['productId'];

        $que = 'SELECT * FROM produkty WHERE id_produktu="'.$productId.'"';
        $answer = $db_connection->query($que);
        $answer = $answer->fetch_array();

    // getProductImages($productId);
?>

    <div class="product-container">
        <div class="product-title"><?php echo $answer[1]; ?></div>
        <div class="product-price"><?php echo $answer[2]; ?></div>
        <div class="product-description"><?php echo $answer[3]; ?></div>

        <img src="<?php echo "http://stronaserweroweimg.000webhostapp.com/".$productId."/0.jpg" ?>" alt="">
        <img src="<?php echo "http://stronaserweroweimg.000webhostapp.com/".$productId."/0.png" ?>" alt="">
        <img src="<?php echo "http://stronaserweroweimg.000webhostapp.com/".$productId."/0.jpeg" ?>" alt="">
        
    </div>

<?php include('footer.php')?>