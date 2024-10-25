document.addEventListener("DOMContentLoaded", function () {
    let tableres=document.getElementById("tableres");
    let debut=0
    let fin=10
    

    function get_ind() {
        let data =new FormData();
        data.append("debut",debut);
        data.append("fin",fin);
        fetch("http://localhost/Project/?action=get_indivs",{
            method:'POST',
            body:data
        }).then((res)=>{
            return res.json()
        }).then((res)=>{
            let str=""
            if (res.length>0) {
                debut+=10;
                fin+=10;
                res.forEach(element => {
                    str+=`
                    <tr>
                        <td>
                            <img class="img_ind" src="${element.photo}">
                        </td>
                        <td>
                            ${element.nom}
                        </td>
                        <td>
                            ${element.prenom}
                        </td>
                        <td>
                            ${element.ville}
                        </td>
                        <td>
                            <a href="?action=info_indiv&indv=${element.id}" class="btn btn-outline-secondary"> Plus Info </a>
                        </td>
                            
                    </tr>
                    `
                });
                
                
            }else str = `<h5 style='color: rgb(82, 80, 80); font-size: 15px; padding-left: 50px; font-family: "Poppins"; text-align: center; width: 100%; margin-top: 100px; '>IL ne pas des individus</h5>`;
            tableres.innerHTML+=str;
        })
    }
    get_ind()

});
