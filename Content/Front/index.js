import {agafarPelicules} from "./ComunicationManager.js";

const { createApp } = Vue

createApp({
    data() {
        return {
            pantallaActual: "titol",
            productes: [],
            paginaActual: 1,
            // compra: localStorage.getItem('compra')!=null?JSON.parse(localStorage.getItem('compra')):[],
            compra: [],
        }
    },
    methods: {
        getPantalla(){
            return this.pantallaActual;
        },
        canviarPantalla(nova){
            this.pantallaActual = nova;
            if (nova == "tenda") {
                this.getProductes();
            }
        },
        getProductes(){
            agafarPelicules(this.paginaActual)
            .then(peliculas =>{ 
                this.productes = peliculas;
                this.productes.forEach(producte=>{
                    producte.counter = 0;
                });

                if (localStorage.getItem('compra')!=null) {
                    let recuperarCompra = JSON.parse(localStorage.getItem('compra'));
                    
                    recuperarCompra.forEach(element => {
                        this.productes.forEach(producte => {
                            if (element.id==producte.id) {
                                producte.counter= element.counter;
                                this.afegirCompra(producte.id);
                            }
                        });
                    });
                }

            });   
        },
        augmentarDemanats(index){
            if (this.productes[index].counter<10) {
                this.productes[index].counter++;
                this.afegirCompra(index);
            }
        },
        disminuirDemanats(index){
            if (this.productes[index].counter>0) {
                this.productes[index].counter--;
                this.disminuirCompra(index);

            }
        },
        afegirCompra(index){
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
        disminuirCompra(index){
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
        getTotal(){
            if (localStorage.getItem('compra')!=null) {
                let compraTotal = JSON.parse(localStorage.getItem('compra'));

                let preuTotal = 0;

                compraTotal.forEach(element =>{
                    preuTotal += element.counter*element.preu;
                })

                let enviar =((Math.round(preuTotal*100)/100).toFixed(2)).toString();

                enviar+='€';

                return enviar;

            } else{
                return `No s'ha fet cap compra`;
            }
        }
    },

}).mount('#app')