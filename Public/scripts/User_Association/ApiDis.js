


// Fonction pour obtenir tous les paramètres de l'URL sous forme d'objet
function getAllQueryParams() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const params = {};
    for (const [key, value] of urlParams.entries()) {params[key] = value;}
    return params;
}

function creat_element(type, classes) {
    const elm = document.createElement(type);
    classes.forEach(clas => {
        elm.classList.add(clas);
    });
    return elm;
}

function create_Dispa(disp) {
    // Creating the card body
    const card_body = creat_element("div", ["card-body", "pt-4", "p-3"]);

    // Creating the UL element
    const UL = creat_element("ul", ["list-group"]);

    // Creating the LI element
    const Li = creat_element("li", ["list-group-item", "border-0", "d-flex", "p-4", "mb-2", "bg-gray-100", "border-radius-lg"]);

    // Creating the image division
    const Div_Image = creat_element("div", ["col-2"]);
    const Imge = creat_element("img", ["avatar", "avatar-xxl"]);
    Imge.src = disp.photo;
    Div_Image.append(Imge);

    // Creating the first detail division
    const Div_DISP1 = creat_element("div", ["d-flex", "flex-column", "col-4"]);
    const Nom = creat_element("h6", ["mb-3", "text-sm"]);
    Nom.innerText = disp.nom + " " + disp.prenom;

    const date_N = creat_element("span", ["mb-2", "text-xs"]);
    date_N.innerHTML = `Date Naissance: <span class="text-dark font-weight-bold ms-sm-2">${disp.date_N}</span>`;

    const Ville = creat_element("span", ["mb-2", "text-xs"]);
    Ville.innerHTML = `Ville: <span class="text-dark ms-sm-2 font-weight-bold">${disp.ville}</span>`;

    const Genner = creat_element("span", ["text-xs"]);
    Genner.innerHTML = `Genner: <span class="text-dark ms-sm-2 font-weight-bold">${disp.Gennre === "H" ? "Homme" : "Famme"}</span>`;

    Div_DISP1.append(Nom, date_N, Ville, Genner);

    // Creating the second detail division
    const Div_DISP2 = creat_element("div", ["d-flex", "flex-column", "col-4"]);
    const Assnom = creat_element("h6", ["mb-3", "text-sm"]);
    Assnom.innerText = disp.Nomass;

    const Address = creat_element("span", ["mb-2", "text-xs"]);
    Address.innerHTML = `Address: <span class="text-dark font-weight-bold ms-sm-2">${disp.adress}</span>`;

    const Email = creat_element("span", ["mb-2", "text-xs"]);
    Email.innerHTML = `Email Address: <span class="text-dark ms-sm-2 font-weight-bold">${disp.email}</span>`;

    const Telephone = creat_element("span", ["text-xs"]);
    Telephone.innerHTML = `telephone: <span class="text-dark ms-sm-2 font-weight-bold">${disp.tele}</span>`;

    Div_DISP2.append(Assnom, Address, Email, Telephone);

    // Creating the action division
    const Div_Action = creat_element("div", ["ms-auto", "text-end"]);
    const Action_Link = creat_element("a", ["btn", "btn-link", "text-dark", "px-3", "mb-0"]);
    Action_Link.href = "javascript:;";
    Action_Link.innerHTML = `<i class="ni ni-email-83 text-dark me-2" aria-hidden="true"></i>Missage`;

    Div_Action.append(Action_Link);

    // Appending all divisions to the LI element
    Li.append(Div_Image, Div_DISP1, Div_DISP2, Div_Action);

    // Appending the LI element to the UL element
    UL.append(Li);

    // Appending the UL element to the card body
    card_body.append(UL);

    // Assuming you want to append this card body to a parent container
    // For example, if there's a div with id "container" in your HTML
    document.getElementById("Res").append(card_body);
}

// Fonction pour envoyer une requête à l'URL et obtenir les informations des individus
function get_info_res(id) {
    const data=new FormData()
    data.append("id",id)
    fetch("http://localhost/Project/?action=get_info_disp", {method: "POST",body: data})
    .then(res => {return res.json();})
    .then(res => {
        console.log(res);
        create_Dispa(res.res)
    })// Appelez la fonction Recherch avec les données reçues
}

// Fonction pour rechercher des informations supplémentaires en utilisant les données reçues
async function Recherch(indi) {
    const allParams = getAllQueryParams();  // Obtenez tous les paramètres une seule fois
    await fetch("http://127.0.0.1:5000/GetDisp", { 
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({"id": allParams.IDD,"hash": allParams.hash,"date": indi.date_disparition})
    })
    .then(response => response.json())
    .then(data => {
    if (data.length > 0) {
        data.forEach(D => {
            get_info_res(D)
        });
    }else
    document.getElementById("Res").innerHTML+=`<div class="card-body pt-4 p-3">
    <p class="text-center">Il n'y a aucun résultat pour ces données</p>
    </div>`
    document.getElementById("titre").innerHTML="Résultats de recherche"
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("Res").innerHTML+=`<div class="card-body pt-4 p-3">
            <p class="text-center">Oups ! Il semble qu'un problème soit survenu. Veuillez vérifier votre connexion et réessayer plus tard.</p>
        </div>`
        document.getElementById("titre").innerHTML="Résultats de recherche"
        
    });
}



// Fonction pour envoyer une requête à l'URL et obtenir les informations d'un individu
async function get_info_indiv() {
    const allParams = getAllQueryParams();  // Obtenez tous les paramètres une seule fois
    const data=new FormData()
    data.append("hash",allParams.hash)
    data.append("id",allParams.IDD)
    await fetch("http://localhost/Project/?action=get_info_disp", {method: "POST",body: data})
    .then(res => {return res.json();})
    .then(res => {Recherch(res.res);})// Appelez la fonction Recherch avec les données reçues
}



// Appelez la fonction principale pour obtenir les informations

const BtnRES=document.getElementById("BtnRES")

BtnRES.addEventListener("click",()=>{
    document.getElementById("Res").innerHTML="";
    const div=creat_element("div",["card-header" ,"pb-0" ,"px-3"])
    div.innerHTML= '<h6 class="mb-0 d-flex align-content-center me-2" id="titre">Résultats de recherche </h6>'
    document.getElementById("Res").append(div)
    document.getElementById("titre").innerHTML="Veuillez patienter pendant la recherche de résultats similaires <span class='loaderdisp me-2'></span>"
    get_info_indiv()
})


/*<div class="card-header pb-0 px-3">
                <h6 class="mb-0 d-flex align-content-center" id="titre">Résultats de la recherche pour personnes disparues </h6>
            </div>*/