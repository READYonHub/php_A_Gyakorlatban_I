# php_A_Gyakorlatban_I - III

## PHP a gyakor_01_Specifikáció, Front End elkészítése 1

### bemelegitésnek
* wampserver
* vscode
* böngésző

tartalomkezelo lesz a neve ennek a gyakorlatnak

specifikaciokban hatarozzuk meg mit fogunk csinalni

sablon.html
html alap weboldal, hogy hogyan nezzen ki 

adatbazis
php_a_gyakorlatban.db   utf8mb4_general_ci
minden kezdodleges beallitast orokolnek a tablak

htaccess - ez gyakorlatilag egy olyan fajl aminek nincs neve csak kiterjesztese es ide lehet megadni a kulonbozo reguralis kifejezeseket
<!--

# BEGIN WordPress
<IfModule mod_rewrite.c> /* ha nincs bekapcsolva az apache moduleban a rewrie_module, akkor egy fatal error kap, es ezzel kilehet kuszolbulni */

RewriteEngine On /* beallithatjuk a url cim attirast */
RewriteBase / /* ha tobb konyvtari szintre leteszem akkor meglehet adni kezdeti alapkonyvtar elereset */

RewriteRule ^index\.php$ - [L]

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]

</IfModule>

# END WordPress

https://htaccess.petertoth.hu/htaccess-cms-rendszerben/
-->

* kesz egy frontend oldal ahol elkeszult egy statikus html, css oldal 
* tervezve lett egy adatbazis, minta adatokkal
* keszult 4 aloldal
* minimalis url cimek hangolasa

# PHP a gyakor_04_Back End funkciók létrehozása 1

* crud oldallakkal es listazas
* WYSIWYG - what you see is what you get
* minimalis admin felulet

bemenet ellenorzesere
https://www.html5pattern.com/