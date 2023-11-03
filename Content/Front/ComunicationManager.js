/* EXPLICACIÓN DE RUTAS
Todas las rutas de ComunicationManager parten de la root de laravel, y es lo único que se debe cambiar 
a la hora de desplegar, las rutas son:

EN LOCAL: http://localhost:8000/api/


EN PREPRODUCCIÓN: http://preprod.rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/


EN PRODUCCIÓN: http://rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/

SE DEBEN SUSTITUIR TODAS LAS LLAMADAS A API SOLAMENTE EN LA PORCIÓN DE LA RUTA RAÍZ

EJEMPLO 
HOST: http://localhost:8000/api/productes
PRODUCCIÓN: http://rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/api/productes

*/
export async function agafarPelicules(){
    const response = await fetch(`http://rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/api/productes`);

    const productes = await response.json();

    return productes;
}

export async function agafarCategories(){
    const response = await fetch(`http://rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/api/categories`);
    const categories = await response.json();

    return categories;
}

export async function enviarComanda(objecte, modificar, idComanda){
    let url = 'http://rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/api/comanda';

    // Datos que deseas enviar en formato de formulario
    const formData = new URLSearchParams();
    formData.append('productes', objecte.productes);
    formData.append('email', objecte.email);
    formData.append('preuTotal', objecte.preuTotal);

    // Configuración de la solicitud POST
    let options;

    if (modificar) {
        options = {
            method: 'PATCH',
            body: formData, // Usamos formData para enviar los datos en formato de formulario
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded', // Indicamos el tipo de contenido
            },
        };
        url +=`/${idComanda}`;
    } else {
        options = {
            method: 'POST',
            body: formData, // Usamos formData para enviar los datos en formato de formulario
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded', // Indicamos el tipo de contenido
            },
        };
    }

    // Realizar la solicitud POST usando fetch
    const response = await fetch(url, options);

    const data = await response.json(); // Hacer algo con la respuesta del servidor
    console.log(data);
    return data;
}
export async function agafarComanda(idComanda) {

    console.log(idComanda)
    const url = `http://rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/api/comanda/${idComanda}`;

    const response = await fetch(url);
    const comanda = await response.json();
    console.log(comanda);
    return comanda;
}
