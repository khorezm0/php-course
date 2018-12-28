<?php
require_once 'db.php';
require_once 'utils.php';

if(!$_SESSION["isAdmin"]){
    header("Location: /coursephp/login.php?admin");
    die();
}


if(isset($_GET['del'])) {
    $id = parseGet($_GET['del']);
    $q = "UPDATE item_image SET `hidden` = 1 WHERE `id` = '$id'";
    $result = mysql_query($q);
    if ($result) {
        die('1');
    } else {
        die('0');
    }
}else if(isset($_GET['upload'])){
    $id = parseGet($_GET['upload']);

    foreach ($_FILES["images"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {

            if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) {
                //continue;
                die("Upload failed with error code " . $_FILES['file']['error'][$key]);
            }
            $info = getimagesize($_FILES['images']['tmp_name'][$key]);
            if ($info === FALSE) {
                //continue;
                die("Unable to determine image type of uploaded file");
            }
            if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
                //continue;
                die("Not a gif/jpeg/png");
            }

            $uniquesavename= time().uniqid(rand()) . "." . pathinfo(basename($_FILES["images"]["name"][$key]))['extension'];
            $tmp_name = $_FILES["images"]["tmp_name"][$key];
            $full_path = "../images/shop/$uniquesavename";

            if(move_uploaded_file($tmp_name, $full_path)){
                $full_path = "/coursephp/images/shop/$uniquesavename";
                $q = "INSERT INTO item_image (`item_id`, `url`) VALUE ('$id', '$full_path')";
                $result = mysql_query($q);
            }else{
            }
        }
    }

    echo "1";

}else{
    header("Location: /coursephp/index.php");
}

?>