<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('descripcio');
            $table->bigInteger('categoria')->unsigned();
            $table->foreign('categoria')->references('id')->on('categorias');
            $table->string('img');
            $table->integer('estoc');
            $table->decimal('preu', 8, 2);
            $table->integer('pendent')->default(0);
            $table->timestamps();
        });

        DB::table('productes')->insert([
            [
                'id' => 1,
                'nom' => 'Pilota de futbol (soccer)',
                'descripcio' => 'Pilota utilitzada en el futbol, és esfèrica i generalment està feta de cuir o materials sintètics.',
                'estoc' => 25,
                'img' => 'public/storage/img/soccer.jpg',
                'categoria' => 1,
                'preu' => 29.99
            ],
            [
                'id' => 2,
                'nom' => 'Pilota de basquet',
                'descripcio' => 'Pilota utilitzada en el basquet, és una pilota esfèrica de goma o cuir.',
                'estoc' => 30,
                'img' => 'public/storage/img/basket.jpg',
                'categoria' => 1,
                'preu' => 44.99
            ],
            [
                'id' => 3,
                'nom' => 'Pilota de voleibol',
                'descripcio' => 'Pilota utilitzada en el voleibol, és esfèrica i sovint està feta de cuir o material sintètic.',
                'estoc' => 20,
                'img' => 'public/storage/img/volley.jpg',
                'categoria' => 1,
                'preu' => 21.99
            ],
            [
                'id' => 4,
                'nom' => 'Pilota de beisbol',
                'descripcio' => 'Pilota utilitzada en el beisbol, és una pilota dura coberta de cuir amb una base interior de suro o goma.',
                'estoc' => 40,
                'img' => 'public/storage/img/beisbol.jpg',
                'categoria' => 1,
                'preu' => 35.99
            ],
            [
                'id' => 5,
                'nom' => 'Pilota de tennis',
                'descripcio' => 'Pilota utilitzada en el tennis, és una pilota groga o blanca amb una coberta exterior de feltre.',
                'estoc' => 35,
                'img' => 'public/storage/img/tennis.jpg',
                'categoria' => 1,
                'preu' => 25.99
            ],
            [
                'id' => 6,
                'nom' => 'Pilota de golf',
                'descripcio' => 'Pilota utilitzada en el golf, és petita i dura, dissenyada per recorrer distàncies llargues.',
                'estoc' => 50,
                'img' => 'public/storage/img/golf.jpg',
                'categoria' => 1,
                'preu' => 42.99
            ],
            [
                'id' => 7,
                'nom' => 'Pilota de criquet',
                'descripcio' => 'Pilota utilitzada en el criquet, és dura i cosida amb costures.',
                'estoc' => 15,
                'img' => 'public/storage/img/cricket.jpg',
                'categoria' => 1,
                'preu' => 19.99
            ],
            [
                'id' => 8,
                'nom' => 'Pilota de ping-pong (tenis de taula)',
                'descripcio' => 'Pilota utilitzada en el tennis de taula, és petita i lleugera.',
                'estoc' => 60,
                'img' => 'public/storage/img/pingpong.jpg',
                'categoria' => 1,
                'preu' => 31.99
            ],
            [
                'id' => 9,
                'nom' => 'Pilota de rugbi',
                'descripcio' => 'Pilota utilitzada en el rugbi, és ovalada i s\'utilitza per passades i cops de peu.',
                'estoc' => 25,
                'img' => 'public/storage/img/rugby.jpg',
                'categoria' => 1,
                'preu' => 28.99
            ],
            [
                'id' => 10,
                'nom' => 'Pilota de softbol',
                'descripcio' => 'Pilota utilitzada en el softbol, és similar a la pilota de beisbol però més gran y més suau.',
                'estoc' => 30,
                'img' => 'public/storage/img/softbol.jpg',
                'categoria' => 1,
                'preu' => 32.99
            ],
            [
                'id' => 11,
                'nom' => 'Pilota d\'waterpolo',
                'descripcio' => 'Pilota utilitzada en l\'waterpolo, és pesada y està dissenyada per flotar a l\'aigua.',
                'estoc' => 10,
                'img' => 'public/storage/img/waterpolo.jpg',
                'categoria' => 1,
                'preu' => 23.99
            ],
            [
                'id' => 12,
                'nom' => 'Pilota de squash',
                'descripcio' => 'Pilota utilitzada en el squash, és petita y de goma.',
                'estoc' => 25,
                'img' => 'public/storage/img/squash.jpg',
                'categoria' => 1,
                'preu' => 18.99
            ],
            [
                'id' => 13,
                'nom' => 'Pilota de racquetbol',
                'descripcio' => 'Pilota utilitzada en el racquetbol, és petita y dura.',
                'estoc' => 20,
                'img' => 'public/storage/img/raquetball.jpg',
                'categoria' => 1,
                'preu' => 29.99
            ],
            [
                'id' => 14,
                'nom' => 'Pilota de futbol americà',
                'descripcio' => 'Pilota utilitzada en el futbol americà, és ovalada y punxeguda als extrems.',
                'estoc' => 20,
                'img' => 'public/storage/img/football.jpg',
                'categoria' => 1,
                'preu' => 22.99
            ],
            [
                'id' => 15,
                'nom' => 'Pilota d\'handbol',
                'descripcio' => 'Pilota utilitzada en el handbol, és petita y dura.',
                'estoc' => 15,
                'img' => 'public/storage/img/handball.jpg',
                'categoria' => 1,
                'preu' => 24.99
            ],
            [
                'id' => 16,
                'nom' => 'Pilota de petanca',
                'descripcio' => 'Pilota utilitzada en l\'esport de bitlles, és metàllica y pesada.',
                'estoc' => 10,
                'img' => 'public/storage/img/petanca.jpg',
                'categoria' => 1,
                'preu' => 20.99
            ],
            [
                'id' => 17,
                'nom' => 'Pilota de lacrosse',
                'descripcio' => 'Pilota utilitzada en el lacrosse, és dura y té una xarxa a un extrem.',
                'estoc' => 15,
                'img' => 'public/storage/img/lacrosse.jpg',
                'categoria' => 1,
                'preu' => 17.99
            ],
            [
                'id' => 18,
                'nom' => 'Pilota de criquet de bat i pilota',
                'descripcio' => 'Pilota utilitzada en el criquet, és mes lleugera y mes gran que la pilota de criquet tradicional y s\'utilitza en jocs informals.',
                'estoc' => 25,
                'img' => 'public/storage/img/cricketPelota.jpg',
                'categoria' => 1,
                'preu' => 16.99
            ],
            [
                'id' => 19,
                'nom' => 'Pilota medicinal',
                'descripcio' => 'Utilitzada en entrenament funcional y rehabilitació, és una pilota pesada que s\'utilitza per exercicis de força y equilibri.',
                'estoc' => 20,
                'img' => 'public/storage/img/medicinal.jpg',
                'categoria' => 2,
                'preu' => 46.99
            ],
            [
                'id' => 20,
                'nom' => 'Pilota suïssa (fitball)',
                'descripcio' => 'Utilitzada en entrenament de pilates y exercicis d\'estabilitat, és una pilota inflable gran.',
                'estoc' => 15,
                'img' => 'public/storage/img/suiza.jpg',
                'categoria' => 2,
                'preu' => 38.99
            ],
            [
                'id' => 21,
                'nom' => 'Pilota d\'ioga',
                'descripcio' => 'Similar a la pilota suïssa, s\'utilitza en exercicis d\'ioga y pilates per millorar la flexibilitat y l\'equilibri.',
                'estoc' => 20,
                'img' => 'public/storage/img/yoga.jpg',
                'categoria' => 2,
                'preu' => 19.99
            ],
            [
                'id' => 22,
                'nom' => 'Pilota de paret (wall ball)',
                'descripcio' => 'Utilitzada en l\'entrenament creuat, és una pilota pesada que es llança contra una paret com a part d\'un exercici.',
                'estoc' => 25,
                'img' => 'public/storage/img/wallball.jpg',
                'categoria' => 2,
                'preu' => 28.99
            ],
            [
                'id' => 23,
                'nom' => 'Pilota de boxa (speed bag)',
                'descripcio' => 'Utilitzada en la boxa, és una petita pilota inflable que es colpeja per millorar la rapidesa y la coordinació.',
                'estoc' => 15,
                'img' => 'public/storage/img/boxeo.jpg',
                'categoria' => 2,
                'preu' => 45.99
            ],
            [
                'id' => 24,
                'nom' => 'Pilota de reacció (reaction ball)',
                'descripcio' => 'Utilitzada en l\'entrenament esportiu, té una superfície irregular y rebot de manera imprevisible, la qual cosa millora l\'agilitat y la coordinació.',
                'estoc' => 20,
                'img' => 'public/storage/img/reaccion.jpg',
                'categoria' => 1,
                'preu' => 15.99
            ],
            [
                'id' => 25,
                'nom' => 'Pilota de golf de pràctica',
                'descripcio' => 'Utilitzada en la pràctica del golf, és una pilota més lleugera que s\'utilitza per practicar tirs al camp de pràctica.',
                'estoc' => 30,
                'img' => 'public/storage/img/golf.jpg',
                'categoria' => 1,
                'preu' => 27.99
            ],
            [
                'id' => 26,
                'nom' => 'Pilota de bitlles',
                'descripcio' => 'Utilitzada en el bitlles, és gran y pesada, dissenyada per rodar per una pista de bitlles.',
                'estoc' => 10,
                'img' => 'public/storage/img/boliche.jpg',
                'categoria' => 1,
                'preu' => 16.99
            ],
            [
                'id' => 27,
                'nom' => 'Pilota de cal·listenia',
                'descripcio' => 'Utilitzada en exercicis de cal·listenia, és una pilota petita que s\'utilitza per augmentar la dificultat de certs moviments.',
                'estoc' => 20,
                'img' => 'public/storage/img/calistenia.jpg',
                'categoria' => 2,
                'preu' => 30.99
            ],
            [
                'id' => 28,
                'nom' => 'Pilota de teràpia (therapy ball)',
                'descripcio' => 'Utilitzada en fisioteràpia y teràpia ocupacional, és una pilota de goma utilitzada per millorar la força y la coordinació.',
                'estoc' => 15,
                'img' => 'public/storage/img/terapia.jpg',
                'categoria' => 3,
                'preu' => 20.99
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productes');
    }
};
