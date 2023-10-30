import { agafarPelicules } from "./ComunicationManager.js";
import { agafarCategories } from "./ComunicationManager.js";
import { enviarComanda } from "./ComunicationManager.js";


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
            // comanda: { productes: `[{"id":14,"nom":"Pilota de futbol americà","descripcio":"Pilota utilitzada en el futbol americà, és ovalada y punxeguda als extrems.","categoria":1,"img":"./img/football.jpg","estoc":20,"preu":23,"pendent":0,"created_at":null,"updated_at":null,"counter":2},{"id":22,"nom":"Pilota de paret (wall ball)","descripcio":"Utilitzada en l'entrenament creuat, és una pilota pesada que es llança contra una paret com a part d'un exercici.","categoria":2,"img":"./img/wallball.jpg","estoc":25,"preu":29,"pendent":0,"created_at":null,"updated_at":null,"counter":2},{"id":20,"nom":"Pilota suïssa (fitball)","descripcio":"Utilitzada en entrenament de pilates y exercicis d'estabilitat, és una pilota inflable gran.","categoria":2,"img":"./img/suiza.jpg","estoc":15,"preu":39,"pendent":0,"created_at":null,"updated_at":null,"counter":1},{"id":3,"nom":"Pilota de voleibol","descripcio":"Pilota utilitzada en el voleibol, és esfèrica i sovint està feta de cuir o material sintètic.","categoria":1,"img":"./img/volley.jpg","estoc":20,"preu":22,"pendent":0,"created_at":null,"updated_at":null,"counter":9},{"id":28,"nom":"Pilota de teràpia (therapy ball)","descripcio":"Utilitzada en fisioteràpia y teràpia ocupacional, és una pilota de goma utilitzada per millorar la força y la coordinació.","categoria":3,"img":"./img/terapia.jpg","estoc":15,"preu":21,"pendent":0,"created_at":null,"updated_at":null,"counter":7},{"id":10,"nom":"Pilota de softbol","descripcio":"Pilota utilitzada en el softbol, és similar a la pilota de beisbol però més gran y més suau.","categoria":1,"img":"./img/softbol.jpg","estoc":30,"preu":33,"pendent":0,"created_at":null,"updated_at":null,"counter":1},{"id":8,"nom":"Pilota de ping-pong (tenis de taula)","descripcio":"Pilota utilitzada en el tennis de taula, és petita i lleugera.","categoria":1,"img":"./img/pingpong.jpg","estoc":60,"preu":32,"pendent":0,"created_at":null,"updated_at":null,"counter":3}]`, email: "dfsgdgf@aasdf.com", preuTotal: "617.00", updated_at: "2023-10-26T07:25:38.000000Z", created_at: "2023-10-26T07:25:38.000000Z", id: 9, estat: 3 },
            categories: [],
            mostrarCategories: false,
            productesCopia: [],
            aplicarEfecte:false,
        }
    },
    methods: {
        getPantalla() {
            return this.pantallaActual;
        },
        canviarPantalla(nova) {
            this.pantallaActual = nova;
            if (nova == "botiga") {
                this.getProductes();
            }
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
                        this.compra = [];
                        let recuperarCompra = JSON.parse(localStorage.getItem('compra'));

                        recuperarCompra.forEach(element => {
                            this.productes.forEach(producte => {
                                if (element.id == producte.id) {
                                    producte.counter = element.counter;
                                    this.afegirCompra(producte.id - 1);
                                }
                            });
                        });
                    }

                });
        },
        augmentarDemanats(index) {
            if (this.productes[index].counter < this.productes[index].estoc) {
                this.productes[index].counter++;
                this.afegirCompra(index);
                this.aplicarEfecte = true;
                setTimeout(() => {this.aplicarEfecte = false;}, 500); 

            }
        },
        disminuirDemanats(index) {
            if (this.productes[index].counter > 0) {
                this.productes[index].counter--;
                this.disminuirCompra(index);
                this.aplicarEfecte = true;
                setTimeout(() => {this.aplicarEfecte = false;}, 500); 
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
            if (localStorage.getItem('compra') != null) {
                let compraTotal = JSON.parse(localStorage.getItem('compra'));

                let preuTotal = 0;

                compraTotal.forEach(element => {
                    preuTotal += element.counter * element.preu;
                })

                let enviar = ((Math.round(preuTotal * 100) / 100).toFixed(2))

                this.preuTotal = enviar;

                enviar = enviar.toString();

                enviar += '€';

                enviar = 'Total: ' + enviar;

                return enviar;

            } else {
                return `No s'ha fet cap compra`;
            }
        },
        getTotalPreuProducte() {
            if (localStorage.getItem('compra') != null) {
                let compraTotal = JSON.parse(localStorage.getItem('compra'));

                let preuTotal = 0;

                compraTotal.forEach(element => {
                    preuTotal += element.counter * element.preu;
                })

                let enviar = ((Math.round(preuTotal * 100) / 100).toFixed(2))

                this.preuTotal = enviar;

                enviar = enviar.toString();

                enviar += '€';

                return enviar;
            }

        },
        getProducteTotalComprat(){
            if (localStorage.getItem('compra') != null) {

                let comprarProducte=JSON.parse(localStorage.getItem('compra'));
                let numProducte=0;
                comprarProducte.forEach(element=>{
                    if(element.counter==0){
                        return numProducte=0;
                    }else{
                        numProducte+=element.counter;
                        return numProducte;
                    }
                
            })
            }
        
        },

        mostrarFiltres(){
            if (this.categories.length > 0) {
                this.mostrarCategories = !this.mostrarCategories;
            } else {
                agafarCategories().then(data => 
                    this.categories = data
                )
                this.mostrarCategories = true;
                
            }
            
        },

        filtrar(categoria){

            if (categoria != -1) {
                this.productes = this.productesCopia.filter((producte) => producte.categoria == categoria);
            } else {
                this.productes = this.productesCopia;
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

                enviarComanda(enviarJSON).then(data => {
                    this.comanda = data;
                })

                console.log(this.comanda);

                this.pantallaActual = `comanda`;

                this.compra = [];

                this.productes.forEach(producte => {
                    producte.counter = 0;
                });

            } else {
                alert("Invalid email address!");
            }
        },
        afegirTransicio(){

        },
        buscarComanda(){
          
        }

    },

}).mount('#app')