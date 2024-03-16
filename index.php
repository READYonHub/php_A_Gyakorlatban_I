<?php
require_once("adatbazis.php");

/* Menu osszeallitasa */

$sql            =  "SELECT id, allias, menunev
                    FROM cms_tartalom
                    WHERE statusz = 1
                    ORDER BY sorrend ASC";

$eredmenyek     =   mysqli_query($dbconn, $sql);

$menu           =   "<ul>\n";
/* ameddig kepes vagyok sorokat kesziteni addig vegrefoghajtodni  */
while ($sor     = mysqli_fetch_assoc($eredmenyek)) {
    $menu      .=   "<li><a href=\"index.php?id={$sor['id']}\">{$sor['menunev']}</a></li>\n";
}
$menu          .=   "</ul>\n";
/* Tartalom elkeszitese */

/* az (int) egy tipus kenyszerites ami jol hasznalhato vedekezeskepp az sql injection ellen */
$id             =  (isset($_GET['id'])) ? (int)$_GET['id'] : 1;
/*print*/
$sql            =  "SELECT menunev, tartalom, modositas, leiras, kulcsszavak
                    FROM cms_tartalom
                    WHERE id = {$id} 
                    LIMIT 1";

$eredmeny       =   mysqli_query($dbconn, $sql);
$sor            =   mysqli_fetch_assoc($eredmeny); // Ezután kellene inicializálni a $sor változót
$leiras         =   $sor['leiras']; // A $sor változó csak ezen a ponton lesz értelmezhető
$kulcsszavak    =   $sor['kulcsszavak'];
$menunev        =   $sor['menunev'];
$tartalom       =   $sor['tartalom'];


/* Modulok kezelese */
$oldalsav       =   "";

/* Sablonozo */
$sablon = file_get_contents("sablon.html"); //print file_get_contents gyakorlatilag csak átjátszóként beszippant egy fájlt
$sablon = str_replace("{{leiras}}",         $leiras,        $sablon);
$sablon = str_replace("{{kulcsszavak}}",    $kulcsszavak,   $sablon);
$sablon = str_replace("{{menunev}}",        $menunev,       $sablon);
$sablon = str_replace("{{menu}}",           $menu,          $sablon);
$sablon = str_replace("{{tartalom}}",       $tartalom,      $sablon);
$sablon = str_replace("{{oldalsav}}",       $oldalsav,      $sablon);
print $sablon;
