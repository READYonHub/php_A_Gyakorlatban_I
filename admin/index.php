<?php
session_start();

$kimenet    =   "";
/* Űrlap feldolgozása */
if (isset($_POST['belepes'])) {

    //Változók tisztitása
    require_once("../adatbazis.php");
    $email  =   mysqli_real_escape_string($dbconn, strip_tags(strtolower(trim($_POST['email']))));
    $jelszo =   mysqli_real_escape_string($dbconn, $_POST['jelszo']);

    //Változók ellenőrzése
    //EMAIL
    if (empty($email))
        $hibak[]    =   "Nem adott meg e-mail címet!";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $hibak[]    =   "Nem megfelelő az e-mail formátuma!";

    if (empty($jelszo))
        $hibak[]    =   "Nem adott meg jelszót";

    //JELSZO
    if (!preg_match("/^[a-zA-Z0-9]*$/", $jelszo))
        $hibak[]    =   "A jelszó csak ékezet nélküli betűket és számokat tartalmazhat!";

    // Hibák összegyűjtése
    if (isset($hibak)) {
        $kimenet    =   "<ul>\n";
        foreach ($hibak as $hiba) {
            $kimenet    .=  "<li>{$hiba}</li>\n";
        }
        $kimenet    .=  "</ul>";
    }
    //Beléptetés kezelése
    else {
        $sql    =   "SELECT id
                    FROM cms_admin
                    WHERE email =   '{$email}'
                    AND jelszo = '" . sha1($jelszo) . "'
                    LIMIT 1";

        $eredmeny   =   mysqli_query($dbconn, $sql);

        if (mysqli_num_rows($eredmeny) == 1) {
            $_SESSION['belepett']   = true;
            header("Location: szerkesztes.php");
        } else {
            $kimenet    =   "<p><em>Rossz e-mail címet vagy jelszót adtál meg!</em></p>\n";
        }
    }
}

$belepes   =   <<<BELEPES

<form method="post" action="">
    {$kimenet}
    <!--    E-mail    -->
    <p>
    <label for="email">E-mail:*</label>
    <br>
    <input type="email" id="email" name="email" required>
    </p>

    <!--    Jelszo    -->
    <p>
    <label>Jelszó:*</label>
    <br>
    <input type="password" id="jelszo" name="jelszo" required>
    </p>
    <p><em>A csillaggal jelölt mezőt kitöltése kötelező!</em></p>
    <input type="submit" id="belepes" name="belepes" value="Belépés">
</form>

BELEPES;
/* Sablonozo */
$sablon = file_get_contents("sablon.html"); //print file_get_contents gyakorlatilag csak átjátszóként beszippant egy fájlt
$sablon = str_replace("{{menu}}",           "",                         $sablon);
$sablon = str_replace("{{menunev}}",        "Belépés",                  $sablon);
$sablon = str_replace("{{tartalom}}",       $belepes,                   $sablon);
$sablon = str_replace("{{oldalsav}}",       "",                         $sablon);

print $sablon;
