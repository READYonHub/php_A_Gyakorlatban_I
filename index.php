<?php
require_once("adatbazis.php");

/* Menu osszeallitasa */

$sql            =  "SELECT id, allias, menunev, 
                    FROM cms_tartalom
                    WHERE statusz = 1
                    ORDER BY sorrend ASC";

/* tartalom elkeszitese */

$sql            =  "SELECT menunev, tartalom, modositas, leiras, kulcsszavak
                    FROM cms_tartalom
                    WHERE id = ".$id."
                    LIMIT 1";


$leiras         =   "az oldal pár mondatos leírása";
$kulcsszavak    =   "kulcsszó1, kulcsszó2, kulcsszó3, ... kulcsszó25";
$menu           =   "<ul>
                        <li><a href=\"#\" class=\"aktiv\">Bemutatkozás</a></li>
                        <li><a href=\"#\">Kedvencek</a></li>
                        <li><a href=\"#\">Képgaléria</a></li>
                        <li><a href=\"#\">Kapcsolat</a></li>
                    </ul>";
$menunev        =   "Hello Virág!";
$tartalom       =   "<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>";

$oldalsav = "";

$sablon = file_get_contents("sablon.html"); //print file_get_contents gyakorlatilag csak átjátszóként beszippant egy fájlt
$sablon = str_replace("{{leiras}}",         $leiras,        $sablon);
$sablon = str_replace("{{kulcsszavak}}",    $kulcsszavak,   $sablon);
$sablon = str_replace("{{menunev}}",        $menunev,       $sablon);
$sablon = str_replace("{{menu}}",           $menu,          $sablon);
$sablon = str_replace("{{tartalom}}",       $tartalom,      $sablon);
$sablon = str_replace("{{oldalsav}}",       $oldalsav,      $sablon);
print $sablon;
