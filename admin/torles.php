<?php

if (isset($_GET['id'])) {
    $id =   (int)$_GET['id'];
    require_once("../adatbazis.php");
    $sql    =   "DELETE FROM cms_tartalom
                    WHERE id    =   {$id}
                    LIMIT 1";
    $eredmeny   =   mysqli_query($dbconn, $sql);
}
header("Location: szerkesztes.php");
