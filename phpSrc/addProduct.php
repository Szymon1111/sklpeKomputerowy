<form method='post' action='' enctype='multipart/form-data'>

    <input type="text" name="product-title" placeholder="Tytuł produktu">
    <input type="number" min="0.00" max="10000.00" step="0.01" name="product-price" placeholder="Cena produktu"/>
    <input type="text" name="product-description" placeholder="Opis">
    
    <?php showCategoriesList($db_connection); ?>

    <input type="file" name="file[]" id="file" class="flex-center-row" multiple>

    <button type="submit" name="add-product">Dodaj produkt</button>

</form>


<?php
    
    if(isset($_POST['add-product'])){

        $insert = 'INSERT INTO produkty (nazwa, cena, opis, kategoria)
        VALUES ("'.$_POST["product-title"].'","'.$_POST["product-price"].'","'.$_POST["product-description"].'","'.$_POST["category"].'")';

        if($db_connection->query($insert))
            echo "UDAŁO SIĘ DODAĆ";

        $que = 'SELECT id_produktu FROM produkty where nazwa="'.$_POST["product-title"].'" AND cena="'.$_POST["product-price"].'"';

        $product_id = $db_connection->query($que)->fetch_array()[0];

        $conn_id = ftp_connect('files.000webhost.com');
        ftp_pasv($conn_id, true); 
        $login_result = ftp_login($conn_id, 'stronaserweroweimg', 'Trek session 7');

        $countfiles = count($_FILES['file']['name']);

        ftp_mkdir($conn_id, $product_id);

        for($i=0;$i<$countfiles;$i++){
            
            $localFile = $_FILES['file']['tmp_name'][$i];
            
            $path_parts = pathinfo($_FILES["file"]["name"][$i]);
            $extension = $path_parts['extension'];

            $fileNameOnServer = $product_id."/".$i.".".$extension;

            if (@ftp_put($conn_id, $fileNameOnServer, $localFile, FTP_BINARY)) {
                
            } 
            else {
                echo "There was a problem while uploading: ".$_FILES['file']['name'][$i];
            }
            
             
        }

        ftp_close($conn_id);

    }


?>