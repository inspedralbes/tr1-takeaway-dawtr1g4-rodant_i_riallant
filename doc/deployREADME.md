**COM DESPLEGAR RIENT I RIALLANT**:

**Important**: En cas de tenir establert l'entorn de prodcucció i preproducció, salteu al pas **x**

1. Crear domini (important que tingui support DNS)
2. Crear la base de dades remota**amb el mateix user que el domini**
3. L'estructura de la base de dades es pot obtenir fácilment fent un php artisan migrate en local, exportant la base de dades resultant, i important l'estructura i els continguts a la base de dades remota.
4. Executar les ordres **composer install**, **cp .env.example .env** i **php artisan key:generate** en el directori de api-laravel
5. editar el fitxer .env per a que inclogui les credencials d'inici de sessió del usuari creador de la base de dades remota.
6. 