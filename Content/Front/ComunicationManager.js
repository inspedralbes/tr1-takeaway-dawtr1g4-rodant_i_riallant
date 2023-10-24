export async function agafarPelicules(){
    const response = await fetch(`http://localhost:8000/api/productes`);
    const productes = await response.json();

    return productes;
}