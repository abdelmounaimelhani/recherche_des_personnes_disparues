document.addEventListener("DOMContentLoaded", function () {
    let  nom=document.getElementById("nom");
    let  indv=document.getElementById("indv");
    let  Prenom=document.getElementById("Prenom");
    let  datenai=document.getElementById("datenai");
    let  Dateen =document.getElementById("Dateen");
    let  Villa=document.getElementById("Villa");
    let  form=document.getElementById("form");
    let  btn=document.getElementById("btns");
    let  msg=document.getElementById("msg");
    let  supp=document.getElementById("supp");

    function validestr(elm) {
        if (elm.value=="") {
            elm.style.borderBottomColor="red";
            return false
        }else{
            elm.style.borderBottomColor="rgb(148, 147, 147)";
            return true
        }
    }
    function validedate(elm) {
        if (isNaN(new Date(elm.value).getTime())) {
            elm.style.borderBottomColor="red";
            return false
        }else{
            elm.style.borderBottomColor="rgb(148, 147, 147)";
            return true
        } 
    }
    function msage(text,error) {
        msg.innerHTML=text;
        msg.style.height="25px";
        msg.style.textAlign="center";
        msg.style.overflow="hidden";
        if (error==true) {
            msg.style.color="crimson";
        }else{
            msg.style.color="rgb(0, 255, 60)";
        }
        setTimeout(()=>{
            msg.style.height="0px";
            msg.innerHTML="";
            msg.style.transition='0.5s';
        },2000)

        setTimeout(()=>{
            msg.removeAttribute("style");
        },3000)  
    }


    supp.addEventListener("click",()=>{
        if (confirm("Confirmez la suppression de cet individu.")) {
            let data = new FormData();
            data.append('idin',indv.value);
            fetch("http://localhost/Project/?action=delet_indv",{
                method:"POST",
                body:data
            }).then((res)=>{
                return res.json();
            }).then((res)=>{
                if (res.code==0) {
                    alert("L'individu a bien été supprimé !")
                    window.location.href = 'http://localhost/Project/?action=individus';
                }else if (res.code==1) {
                    alert("Échec de suppression de l'individu.")
                }else if(res.code==2){
                    alert("L'individu n'existe pas.")
                }
            })
        }
    })
    nom.addEventListener("keyup", function () {validestr(nom);});
    Prenom.addEventListener("keyup", function () {validestr(Prenom);});
    Villa.addEventListener("keyup", function () {validestr(Villa);});
    datenai.addEventListener("keyup", function () {validedate(datenai);});
    Dateen.addEventListener("keyup", function () {validedate(Dateen);});
    form.addEventListener("submit",(e)=>{
        e.preventDefault();
        if (validestr(nom) && validestr(Prenom) && validestr(Villa) && validedate(datenai) && validedate(Dateen)) {
            let data=new FormData();
            data.append("nom",nom.value);
            data.append("Prenom",Prenom.value);
            data.append("Villa",Villa.value);
            data.append("datenai",datenai.value);
            data.append("Dateen",Dateen.value);
            data.append("indv",indv.value);
            fetch("http://localhost/Project/?action=edite_indiv",{
                method:"POST",
                body: data
            }).then((res)=>{
                return res.json()
            }).then((res)=>{
                switch (res.code) {
                    case 0:msage("L'individu a bien été modifié.",false); break;
                    case 1:msage("Les données sont incorrectes. Veuillez vérifier toutes les données.",true) ;break;
                    case 2:msage("Toutes les cases sont obligatoires.",true) ;break;
                    case 3:msage("La date d'entrée ou de naissance est invalide.",true) ;break;
                    case 4:msage("L'individu n'existe pas.",true) ;break;
                    case 5:msage("Échec de la modification de cet individu. Veuillez réessayer plus tard.",true) ;break;
                
                }
            })
        }else{
            btn.classList.add("btnerror")
            setTimeout(()=>{
                btn.classList.remove("btnerror");
            },1000)
        }
    })
});

