**COM DESPLEGAR RIENT I RIALLANT**:

**Important**: En cas de tenir establert l'entorn de prodcucció i preproducció, salteu al pas **5**

1. Crear domini (important que tingui support DNS)
2. Crear la base de dades remota (**Important que el domini i la BBDD s'aixequin desde el mateix usuari, i que per tant es trobin en el mateix host**)
3. L'estructura de la base de dades es pot obtenir fácilment fent un php artisan migrate en local (amb XAMPP habilitat per mysql), exportant la base de dades resultant, i important l'estructura i els continguts a la base de dades remota.
5. Executar les ordres **composer install**, **cp .env.example .env** i **php artisan key:generate** en el directori de api-laravel
4. Editar el fitxer .env per a que inclogui les credencials de la base de dades remota.
6. Editar les rutes en **Content\Front\ComunicationManager.js** en funció de si el deployment será en producció o en preprod (**El propi arxiu té una explicació de l'us de les rutes**)
7. Per a comptes FTP, i per a actualitzacions de producció i preproducció, consulteu [aquesta guía](https://github.com/inspedralbes/tr1-takeaway-dawtr1g4-rodant_i_riallant/blob/main/doc/Deployment%20en%20filezilla.pdf), establiu els filtres de filezilla descrits i anoteu els vostres credencials abans de continuar.
8. Conectarse amb filezilla a **rirtr1g4.daw.inspedralbes.cat** amb les teves credencials y arrosegar el directori del projecte en **/public_html** o afegint **preprod.** a la ruta de conexió (recordeu que els credencials ftp son diferents per a prod que per a preprod).