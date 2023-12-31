import { agafarPelicules } from "./ComunicationManager.js";
import { agafarCategories } from "./ComunicationManager.js";
import { enviarComanda } from "./ComunicationManager.js";
import { agafarComanda } from "./ComunicationManager.js";
import { url_prefix } from "./ComunicationManager.js";



const { createApp } = Vue

createApp({
    data() {
        return {
            pantallaActual: "titol",
            // pantallaActual: `comanda`,
            productes: [],
            paginaActual: 1,
            compra: [],
            preuTotal: 0,
            email: "",
            comanda: {},
            //  comanda: { productes: `[{"id":14,"nom":"Pilota de futbol americà","descripcio":"Pilota utilitzada en el futbol americà, és ovalada y punxeguda als extrems.","categoria":1,"img":"./img/football.jpg","estoc":20,"preu":23,"pendent":0,"created_at":null,"updated_at":null,"counter":2},{"id":22,"nom":"Pilota de paret (wall ball)","descripcio":"Utilitzada en l'entrenament creuat, és una pilota pesada que es llança contra una paret com a part d'un exercici.","categoria":2,"img":"./img/wallball.jpg","estoc":25,"preu":29,"pendent":0,"created_at":null,"updated_at":null,"counter":2},{"id":20,"nom":"Pilota suïssa (fitball)","descripcio":"Utilitzada en entrenament de pilates y exercicis d'estabilitat, és una pilota inflable gran.","categoria":2,"img":"./img/suiza.jpg","estoc":15,"preu":39,"pendent":0,"created_at":null,"updated_at":null,"counter":1},{"id":3,"nom":"Pilota de voleibol","descripcio":"Pilota utilitzada en el voleibol, és esfèrica i sovint està feta de cuir o material sintètic.","categoria":1,"img":"./img/volley.jpg","estoc":20,"preu":22,"pendent":0,"created_at":null,"updated_at":null,"counter":9},{"id":28,"nom":"Pilota de teràpia (therapy ball)","descripcio":"Utilitzada en fisioteràpia y teràpia ocupacional, és una pilota de goma utilitzada per millorar la força y la coordinació.","categoria":3,"img":"./img/terapia.jpg","estoc":15,"preu":21,"pendent":0,"created_at":null,"updated_at":null,"counter":7},{"id":10,"nom":"Pilota de softbol","descripcio":"Pilota utilitzada en el softbol, és similar a la pilota de beisbol però més gran y més suau.","categoria":1,"img":"./img/softbol.jpg","estoc":30,"preu":33,"pendent":0,"created_at":null,"updated_at":null,"counter":1},{"id":8,"nom":"Pilota de ping-pong (tenis de taula)","descripcio":"Pilota utilitzada en el tennis de taula, és petita i lleugera.","categoria":1,"img":"./img/pingpong.jpg","estoc":60,"preu":32,"pendent":0,"created_at":null,"updated_at":null,"counter":3}]`, email: "dfsgdgf@aasdf.com", preuTotal: "617.00", updated_at: "2023-10-26T07:25:38.000000Z", created_at: "2023-10-26T07:25:38.000000Z", id: 9, estat: 3 },
            categories: [],
            busqueda: "",
            mostrarCategories: false,
            productesCopia: [],
            comandaModificant: false,
            aplicarEfecteGran:false,
            aplicarEfectePetit:false,
            menuOpen: false,
            mostrarAdministrador: false,
            desplegador:false,
            imagenQr:"",
            mostrarTicket: false,
            btnQR: true,
            canviarMarcador: false,
            prefixComunicacio: url_prefix(),
            producteDetalls: {},
            interval: null,
        }
    },
    methods: {
        agafarUrl(){
            return url_prefix();
        },
        reiniciarVariables(){
            this.desplegador=false;
            this.canviarMarcador = false;
            this.busqueda = "";
            if(this.interval != null){
                clearInterval(this.interval);
            }
            
        },
        getPantalla() {
            return this.pantallaActual;
        },
        canviarPantalla(nova) {
            this.reiniciarVariables();
            this.pantallaActual = nova;
            if (nova == "botiga") {
                this.getProductes();
                if (this.comandaModificant) {
                    this.augmentarEstocPossible();
                }

            } else if (nova == 'checkout' && this.comandaModificant) {
                this.email = this.comanda.email;
            } else if (nova == 'comanda') {
                this.demanarComandaConstant();
            }
            this.btnQR = true;
        },
        toggleMenu() {
            this.menuOpen = !this.menuOpen;
        },
        getProductes() {
            agafarPelicules(this.paginaActual)
                .then(peliculas => {
                    this.productes = peliculas;
                    this.productesCopia = this.productes;
                    this.productes.forEach(producte => {
                        producte.counter = 0;
                    });

                    if (localStorage.getItem('compra') != null) {
                        this.recuperarCompra(JSON.parse(localStorage.getItem('compra')))
                    }

                    if (this.comandaModificant) {
                        this.augmentarEstocPossible();
                    }

                });
        },
        tancarModal(){
            document.querySelector("dialog").close();
        },
        detallsProducte(producte){            
            this.producteDetalls = producte;

            setTimeout(() => document.querySelector("dialog").showModal(),1)
        },
        augmentarEstocPossible() {
            let productesComanda = JSON.parse(this.comanda.productes)
            productesComanda.forEach(producteComanda => {
                let augmentarEstoc = this.productes.find((element) =>
                    element.id == producteComanda.id
                )

                if (augmentarEstoc != null) {
                    augmentarEstoc.estoc += producteComanda.counter;
                }


            });
        },
        recuperarCompra(compraRecuperar) {
            this.productes = this.productesCopia;
            this.compra = [];
            let recuperarCompra = compraRecuperar;

            recuperarCompra.forEach(element => {
                this.productes.forEach(producte => {
                    if (element.id == producte.id) {
                        producte.counter = element.counter;
                        this.afegirCompra(producte.id - 1);
                    }
                });
            });
        },
        augmentarDemanats(index, event) {
            if (this.productes[index].counter < this.productes[index].estoc) {
                this.productes[index].counter++;
                this.afegirCompra(index);
                event.target.parentElement.parentElement.classList.add('botiga__item-transition--gran');
                setTimeout(() => { event.target.parentElement.parentElement.classList.remove('botiga__item-transition--gran'); }, 500);

            }
        },
        disminuirDemanats(index, event) {
            if (this.productes[index].counter > 0) {
                this.productes[index].counter--;
                this.disminuirCompra(index);
                event.target.parentElement.parentElement.classList.add('botiga__item-transition--petit');
                setTimeout(() => { event.target.parentElement.parentElement.classList.remove('botiga__item-transition--petit'); }, 500);
            }
        },
        afegirCompra(index) {
            let codisproductesCompra = [];
            this.compra.forEach(producteAComprar => {
                codisproductesCompra.push(producteAComprar.id)
            });

            let foundIndex = codisproductesCompra.indexOf(this.productes[index].id);

            if (foundIndex == -1) {
                this.compra.push(this.productes[index]);
            }
            localStorage.setItem('compra', JSON.stringify(this.compra));
        },
        disminuirCompra(index) {
            let codisproductesCompra = [];
            this.compra.forEach(producteAComprar => {
                codisproductesCompra.push(producteAComprar.id)
            });
            let foundIndex = codisproductesCompra.indexOf(this.productes[index].id);


            if (this.compra[foundIndex].counter == 0) {

                this.compra.splice(foundIndex, 1);

            }
            localStorage.setItem('compra', JSON.stringify(this.compra));
        },
        getTotal() {
            this.preuTotal=0;
            if (this.compra.length != 0) {
                let compraTotal = this.compra;

                let preuTotal = 0;

                compraTotal.forEach(element => {
                    preuTotal += element.counter * element.preu;
                })

                let enviar = ((Math.round(preuTotal * 100) / 100).toFixed(2))

                this.preuTotal = enviar;

                enviar = enviar.toString();

                enviar += '€';

                return enviar;
            } else {
                return '0€';
            }
        },
        getProducteTotalComprat() {
            if (this.compra.length != 0) {
                let comprarProducte = this.compra;
                let numProducte = 0;
                comprarProducte.forEach(element => {
                    numProducte += element.counter;
                })
                return numProducte;
            } else {
                return 0;
            }

        },
        mostrarFiltres() {
            if (this.categories.length > 0) {
                this.mostrarCategories = !this.mostrarCategories;
            } else {
                agafarCategories().then(data =>
                    this.categories = data
                )
                this.mostrarCategories = true;
            }
        },
        elementosFiltrados() {
            if (this.filtroCategoria === -1) {
                return this.elementos; // No hay filtro, muestra todos los elementos
            } else {
                return this.elementos.filter(item => item.categoria === this.filtroCategoria);
            }
        },
        filtrar(categoria) {

            if (categoria != -1) {
                this.productes = this.productesCopia.filter((producte) => producte.categoria == categoria);
            } else {
                this.productes = this.productesCopia;
                this.busqueda = "";
            }

        },
        ferCompra() {

            const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

            if (this.email.match(validRegex)) {

                let enviarJSON = {
                    'productes': JSON.stringify(this.compra),
                    'email': this.email,
                    'preuTotal': this.preuTotal
                }

                enviarComanda(enviarJSON, this.comandaModificant, this.comanda.id).then(data => {
                    this.comanda = data;
                });

                localStorage.removeItem('compra');

                this.pantallaActual = `comanda`;

                this.canviarMarcador = true;

                this.compra = [];

                this.comandaModificant = false;

                this.productes.forEach(producte => {
                    producte.counter = 0;
                });

                this.demanarComandaConstant();

            } else {
                alert("Escriu una adreça d'email vàlida");
            }
        },
        buscarComanda() {
            this.demanarComanda();

            this.canviarPantalla("comanda");;
            
            setTimeout(() => {this.canviarMarcador = true;}, 100);
            
            //   .catch((error) => {
            //     this.comandaEncontrada = null; // Limpiamos el resultado en caso de error
            //   });
        },
        generarQr(){
            let qrValue = "http://rirtr1g4.daw.inspedralbes.cat/Front/"
            this.imagenQr = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${qrValue}`;
            this.btnQR = false;
        },
        modificarComanda() {
            this.recuperarCompra(JSON.parse(this.comanda.productes));

            this.comandaModificant = true;

            this.canviarPantalla('botiga');
            this.btnQR = true;
        },
        mostrarFeinaAdministrador() {
            this.mostrarAdministrador = !this.mostrarAdministrador;
         },
        augmentarTamany() {
                this.mostrarTicket = !this.mostrarTicket
        },
        demanarComanda(){
            agafarComanda(this.comanda.id)
              .then((data) => {
                if (data) {                  
                  this.comanda = data;
                }
              })
        },
        demanarComandaConstant(){
            this.interval = setInterval(() => {
                this.demanarComanda();
            }, 2000);     
        }

    },
    created() {
        agafarCategories().then(data =>
            this.categories = data
        )
    },
    computed: {
    }

}).mount('#app')


