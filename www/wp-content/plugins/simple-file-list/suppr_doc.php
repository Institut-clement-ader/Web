<?php 
    if(isset($_GET['del'])){
        $delurl=$_GET['del'];
        echo $delurl
        //unlink($delurl);
    }
?>
