<?php

/* Lapvédelem */
session_start();
if (!isset($_SESSION['belepett'])) {
    header("Location: index.php");
}

/* ha megnyomtak az oke gombot */

if (isset($_POST['rendben'])) {

    //Valtozok tisztitasa

    $_POST          =       array_map("trim",   $_POST);

    $allias         =      strtolower(strip_tags($_POST['allias']));
    $sorrend        =      (int)$_POST['sorrend'];
    $menunev        =      strip_tags($_POST['menunev']);
    $tartalom       =      $_POST['tartalom'];
    $leiras         =      strip_tags($_POST['leiras']);
    $kulcsszavak    =      strip_tags($_POST['kulcsszavak']);
    $statusz        =      (int)$_POST['statusz'];


    //valtozok ellenorzese
    if (empty($allias))
        $hibak[]   =       "uresen hagytad az alliasokat!";
    if (!preg_match("/^[a-z-_]*$/", $allias))
        $hibak[]   =       "rossz allias nevet adtal meg!";
    if (empty($menunev))
        $hibak[]   =       "nem adtad meg a munupont nevet!";

    //hibak osszegyujtese
    if (isset($hibak)) {
        $kimenet    =   "<ul>\n";
        foreach ($hibak as $hiba) {
            $kimenet    .=  "<li>{$hiba}</li>";
        }
        $kimenet    .=   "</ul>\n";
    }
    // beszuras az adatbazisba
    else {
        require_once("../adatbazis.php");
        $sql    =   "INSERT INTO cms_tartalom 
                     (allias, sorrend, menunev, tartalom, letrehozas, leiras, kulcsszavak, statusz)
                     VALUES
                     ('{$allias}',{$sorrend} , '{$menunev}', '{$tartalom}',
                      NOW(), '{$leiras}', '{$kulcsszavak}', '{$statusz}')";

        $eredmeny   =   mysqli_query($dbconn, $sql);

        header("Location: szerkesztes.php");
    }
}

$kimenet    =   isset($kimenet) ?   $kimenet    :   "";
$allias         =      (isset($allias))         ?    $allias        :   "";
$sorrend        =      (isset($sorrend))        ?    $sorren        :   "";
$menunev        =      (isset($menunev))        ?    $menunev       :   "";
$tartalom       =      (isset($tartalom))       ?   $tartalom       :   "";
$leiras         =      (isset($leiras))         ?   $leiras         :   "";
$kulcsszavak    =      (isset($kulcsszavak))    ?   $kulcsszavak    :   "";
$statusz        =      (isset($statusz))        ?   $statusz        :   "";

/*  heredoc in PHP */
$urlap  =   <<<URLAP

<form method="post" action="">

    {$kimenet}

    <!--Allias input-->
    <p>
        <label for="allias">Allias:*</label>
        <br>
        <input type="text" id="allias" name="allias" required pattern="^[a-z-_]+$" value="{$allias}">
        <br>
    </p>

    <!--Sorrend input-->
    <p>
        <label for="sorrend">Sorrend:</label>
        <br>
        <input type="number" id="sorrend" name="sorrend" min="1" value="{$sorrend}">
        <br>
    </p>

    <!--Menunev input-->
    <p>
        <label for="menunev">Menunev:</label>
        <br>
        <input type="text" id="menunev" name="menunev" required value="{$menunev}">
        <br>
    </p>

    <!--Tartalom input-->
    <p>
        <label for="tartalom">Tartalom:</label>
        <br>
        <textarea id="tartalom" name="tartalom" rows="20">{$tartalom}</textarea>
        <br>
    </p>

    <!--Leiras input-->
    <p>
        <label for="leiras">Leiras:</label>
        <br>
        <textarea id="leiras" name="leiras">{$leiras}</textarea>
        <br>
    </p>

    <!--Kulcsszavak input-->
    <p>
        <label for="kulcsszavak">Leiras:</label>
        <br>
        <textarea id="kulcsszavak" name="kulcsszavak">{$kulcsszavak}</textarea>
        <br>
    </p>

    <!--Statusz input-->
    <p>
        <label for="statusz">Leiras:</label>
        <br>
        <select id="statusz" name="statusz">
            <option value="1">Aktiv</option>
            <option value="0">Passziv</option>
        </select>
        <p><em>A csillaggal jelolt mezok kitoltese kotelezo!</em></p>
        <input type="submit" id="rendben" name="rendben" value="Rendben">
        <br>
        <input type="reset" value="Megse">
    </p>
</form>
URLAP;

$menu   =   "<ul>
                <li><a href=\"tartalom-szerkesztes.php\">Vissza</a></li>
                <li></li>
            </ul>";

/* Sablonozo */
$sablon = file_get_contents("sablon.html"); //print file_get_contents gyakorlatilag csak átjátszóként beszippant egy fájlt
$sablon = str_replace("{{menu}}",           $menu,                         $sablon);
$sablon = str_replace("{{menunev}}",        "Uj oldal letrehozasa",     $sablon);
$sablon = str_replace("{{tartalom}}",       $urlap,                     $sablon);
$sablon = str_replace("{{oldalsav}}",       "",                         $sablon);

print $sablon;
