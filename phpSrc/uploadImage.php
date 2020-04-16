<?php

    if(isset($_POST['upload-image']) && isset($_FILES['image'])){

        $conn_id = ftp_connect('files.000webhost.com');
        ftp_pasv($conn_id, true); 
        $login_result = ftp_login($conn_id, 'stronaserwerowe', 'Trek session 7');
        $localFile = $_FILES['image']['tmp_name'];
        $fileNameOnServer = $_FILES['image']['name'];

        echo $localFile;
        echo $fileNameOnServer;

        if (ftp_put($conn_id, $fileNameOnServer, $localFile, FTP_BINARY)) {
            echo "successfully uploaded";
        } else {
            echo "There was a problem while uploading";
        }

        ftp_close($conn_id);

    }


?>
<form action="" method="POST" enctype="multipart/form-data">
      <input type="file" name="image" class="flex-center-row"/>
      <button type="submit" name="upload-image">Upload Image</button>
</form>