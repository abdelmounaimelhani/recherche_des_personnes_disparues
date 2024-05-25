// Fonction pour obtenir tous les paramètres de l'URL sous forme d'objet
function getAllQueryParams() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const params = {};
    for (const [key, value] of urlParams.entries()) {
        params[key] = value;
    }
    return params;
}

// Fonction pour envoyer une requête à l'URL et obtenir les informations d'un individu
function get_info_indiv() {
    const allParams = getAllQueryParams();  // Obtenez tous les paramètres une seule fois
    const data=new FormData()
    data.append("hash",allParams.hash)
    data.append("id",allParams.IDD)

    fetch("http://localhost/Project/?action=get_info_disp", {
        method: "POST",
        body: data
    })
    .then(res => {
        return res.json();
    })
    .then(res => {
        console.log(res.res);
        Recherch(res.res);  // Appelez la fonction Recherch avec les données reçues
    })
    
}

// Fonction pour rechercher des informations supplémentaires en utilisant les données reçues
function Recherch(indi) {
    const allParams = getAllQueryParams();  // Obtenez tous les paramètres une seule fois

    fetch("http://127.0.0.1:5000/test", {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            "id": allParams.IDD,
            "hash": allParams.hash,
            "date": indi.date_N
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Appelez la fonction principale pour obtenir les informations
get_info_indiv();
