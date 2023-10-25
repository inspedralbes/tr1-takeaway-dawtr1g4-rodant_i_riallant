// http://www.omdbapi.com/?s=car&apikey=bb55fec8&page=1

export async function agafarPelicules(){
    const response = await fetch(`data.JSON`);
    const productes = await response.json();

    return productes;
}