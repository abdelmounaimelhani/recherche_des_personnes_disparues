console.log(1)

let debut=0;
    let fin=10;
    let div_valid=document.querySelector(".div_valid");
    let div_error=document.querySelector(".div_error");
    let Nom=document.getElementById("Nom");
    let Prenom=document.getElementById("Prenom");
    let Naissance=document.getElementById("Naissance");
    let dentree=document.getElementById("dentree");
    let Villa=document.getElementById("Villa");
    let Photo=document.getElementById("Photo");
    let Form=document.getElementById("Form");
    let str="";
    function handlevalue(input) {
        if (input.value=="") {
            input.style.border="1px solid red";
            return false;
        }else {
            input.style.border="1px solid black";
            return true;
        }
    }

    function suppvalue() {
        Nom.value=""
        Prenom.value=""
        Naissance.value=""
        dentree.value=""
        Villa.value=""
        Photo.value=""
    }

    
    function isvalid(el1,el2,msg,tr=null) {
        el1.innerHTML=msg
        el1.style.height='20px'
        el2.innerHTML="";
        setTimeout(()=>{
            el1.style.height='0px' 
            el1.style.color='#fff' 
            setTimeout(()=>{
                el1.innerHTML=""
            },2500)
        },3000)
        if (tr!=null) {
            window.location.href="http://localhost/Project/?action=individus"
        }
    }
    
    Form.addEventListener("submit",(e)=>{
        e.preventDefault()
        if (
            handlevalue(Nom)&&handlevalue(Prenom)&&
            handlevalue(Naissance)&&handlevalue(dentree)&&
            handlevalue(Villa)
        ) {
            let data=new FormData();
            data.append("Nom",Nom.value);
            data.append("Prenom",Prenom.value);
            data.append("Naissance",Naissance.value);
            data.append("dentree",dentree.value);
            data.append("Villa",Villa.value);
            data.append("Photo",Photo.files[0]);
            console.log(Photo.files[0])

            fetch("http://localhost/Project/?action=creat_indiv", {
                    method: "POST",
                    body: data
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                switch (data.code) {
                    case 1:isvalid(div_valid,div_error,"L'individu a été ajouté",true);break;   
                    case 2:isvalid(div_error,div_valid,"Erreur de chargement de l'image"); break;
                    case 3:isvalid(div_error,div_valid,"Erreur Type de fichier invalide"); break;
                    case 4:isvalid(div_error,div_valid,"Erreur Vérifiez que toutes les données ont été remplies"); break;
                    case 5: window.location.href="http://localhost/Project/?action=P_login"; break;
                };
                if (data.code=1) {
                    suppvalue()
                }                       
            })     
        }   
    })