export async function agafarPelicules(){
    const response = await fetch(`http://localhost:8000/api/productes`);
    //http://rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/api/productes
    //http://.preprod.rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/api/productes
    //http://localhost:8000/api/productes

// http://localhost:8000/  ==  http://rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/
//http://.preprod.rirtr1g4.daw.inspedralbes.cat/Back/api-laravel/public/
    const productes = await response.json();

    return productes;
}

export async function agafarCategories(){
    const response = await fetch(`http://localhost:8000/api/categories`);
    const categories = await response.json();

    return categories;
}

export async function enviarComanda(objecte){
    const url = 'http://localhost:8000/api/comanda';

                // Datos que deseas enviar en formato de formulario
                const formData = new URLSearchParams();
                formData.append('productes', objecte.productes);
                formData.append('email', objecte.email);
                formData.append('preuTotal', objecte.preuTotal);

                // Configuración de la solicitud POST
                const options = {
                    method: 'POST',
                    body: formData, // Usamos formData para enviar los datos en formato de formulario
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded', // Indicamos el tipo de contenido
                    },
                };
                // Realizar la solicitud POST usando fetch
                const response = await fetch(url, options);

                const data = await response.json(); // Hacer algo con la respuesta del servidor

                console.log(data);
                
                return data;
}