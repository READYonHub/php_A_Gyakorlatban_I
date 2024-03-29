<?php
require_once("adatbazis.php");
print_r($_GET);

/* Menu osszeallitasa */

$sql            =  "SELECT id, allias, menunev
                    FROM cms_tartalom
                    WHERE statusz = 1
                    ORDER BY sorrend ASC";

$eredmenyek     =   mysqli_query($dbconn, $sql);

$menu           =   "<ul>\n";
/* ameddig kepes vagyok sorokat kesziteni addig vegrefoghajtodni  */
while ($sor     = mysqli_fetch_assoc($eredmenyek)) {
    $menu      .= "<li><a href=\"./?allias={$sor['allias']}\">{$sor['menunev']}</a></li>\n";
}
$menu          .=   "</ul>\n";

/* Tartalom elkeszitese */

/* az (int) egy tipus kenyszerites ami jol hasznalhato vedekezeskepp az sql injection ellen */
$allias         =  isset($_GET['allias']) ? $_GET['allias'] : 'bemutatkozas';
/*print*/
print $sql            =  "SELECT menunev, tartalom, letrehozas, modositas, leiras, kulcsszavak
                    FROM cms_tartalom
                    WHERE allias = \"{$allias}\"
                    LIMIT 1";

$eredmeny       =   mysqli_query($dbconn, $sql);

/*elkell dontenem, hogy van tartalmam vagy nincs tartalmam, ez lesz az ervenyes tartalom*/
if (mysqli_num_rows($eredmeny) == 1) {
    $sor            =   mysqli_fetch_assoc($eredmeny); // Ezután kellene inicializálni a $sor változót
    $leiras         =   $sor['leiras']; // A $sor változó csak ezen a ponton lesz értelmezhető
    $kulcsszavak    =   $sor['kulcsszavak'];
    $menunev        =   $sor['menunev'];
    $tartalom       =   $sor['tartalom'];
    $letrehozas     =   $sor['letrehozas'];
}
/* Az oldal nem talalhato, ha hulyeseget irnak be */
else{
    $leiras         =   ""; 
    $kulcsszavak    =   ""; 
    $menunev        =   "Hiba"; 
    $tartalom       =   "<p><em>A keresett oldal nem talalhato...</em></p>"; 
    $letrehozas     =   date("Y-m-d H:i:s");
}  

/* Modulok kezelese */
$oldalsav       =   "";

/* Sablonozo */
$sablon = file_get_contents("sablon.html"); //print file_get_contents gyakorlatilag csak átjátszóként beszippant egy fájlt
$sablon = str_replace("{{menu}}",           $menu,          $sablon);
$sablon = str_replace("{{menunev}}",        $menunev,       $sablon);
$sablon = str_replace("{{tartalom}}",       $tartalom,      $sablon);
$sablon = str_replace("{{letrehozas}}",     $letrehozas,     $sablon);
$sablon = str_replace("{{leiras}}",         $leiras,        $sablon);
$sablon = str_replace("{{kulcsszavak}}",    $kulcsszavak,   $sablon);
$sablon = str_replace("{{oldalsav}}",       $oldalsav,      $sablon);
print $sablon;
