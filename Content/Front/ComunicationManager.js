export async function agafarPelicules(){
    const response = await fetch(`http://localhost:8000/api/productes`);
    const productes = await response.json();

    return productes;
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
                let id = "";
                // Realizar la solicitud POST usando fetch
                const response = await fetch(url, options);

                const data = await response.json();

                id = (data).id;
                console.log((data).id); // Hacer algo con la respuesta del servidor
                
                return id;
}