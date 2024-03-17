<?php
/*  heredoc in PHP */
$urlap  =   <<<URLAP

<form method="post" action="">
    <h3>Uj oldal letrehozasa</h3>

    <!--Allias input-->
    <p>
        <label for="allias">Allias:</label>
        <br>
        <input type="text" id="allias" name="allias">
        <br>
    </p>

    <!--Sorrend input-->
    <p>
        <label for="sorrend">Sorrend:</label>
        <br>
        <input type="number" id="sorrend" name="sorrend" min="1">
        <br>
    </p>

    <!--Menunev input-->
    <p>
        <label for="menunev">Menunev:</label>
        <br>
        <input type="text" id="menunev" name="menunev" required>
        <br>
    </p>

    <!--Tartalom input-->
    <p>
        <label for="tartalom">Tartalom:</label>
        <br>
        <textarea id="tartalom" name="tartalom"></textarea>
        <br>
    </p>

    <!--Leiras input-->
    <p>
        <label for="leiras">Leiras:</label>
        <br>
        <textarea id="leiras" name="leiras"></textarea>
        <br>
    </p>

    <!--Kulcsszavak input-->
    <p>
        <label for="kulcsszavak">Leiras:</label>
        <br>
        <textarea id="kulcsszavak" name="kulcsszavak"></textarea>
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
        <input type="submit" id="rendben" name="rendben" value="Rendben">
        <br>
        <input type="reset" value="Megse">
    </p>
</form>
URLAP;

/* Sablonozo */
$sablon = file_get_contents("sablon.html"); //print file_get_contents gyakorlatilag csak átjátszóként beszippant egy fájlt
$sablon = str_replace("{{menu}}",           "",                         $sablon);
$sablon = str_replace("{{menunev}}",        "Uj oldal letrehozasa",     $sablon);
$sablon = str_replace("{{tartalom}}",       $urlap,                     $sablon);
$sablon = str_replace("{{oldalsav}}",       "",                         $sablon);

print $sablon;
