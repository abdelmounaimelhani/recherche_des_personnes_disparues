const error=document.getElementById('error')
const valide=document.getElementById('div_valid')
const nom=document.getElementById('nom')
const ville=document.getElementById('ville')
const email=document.getElementById('email')
const Tele=document.getElementById('Tele')
const adress=document.getElementById('adress')
const pass1=document.getElementById('password1')
const pass2=document.getElementById('password2')
const form=document.getElementById('form_register')
const btn=document.getElementById('btn')
const regemail = new RegExp("^.+@.+\\.[a-zA-Z]+$");

let isvalide=true

const hadlenom=(e)=>{
    if (e.target.value.trim().length==0) {
        e.target.style.borderBottom="1px solid red"
        isvalide=false
    }else{
        e.target.style.borderBottom='1px solid green'
        isvalide=true
    }
}

const handleemail=(e)=>{
    if (!regemail.test(email.value.trim())) {
        email.style.borderBottom='1px solid red'
        isvalide=false;
    }else{
        email.style.borderBottom='1px solid green'
        isvalide=true
    }
}

const validpass=()=>{
    if (pass1.value==pass2.value) {
        pass2.style.borderBottom='1px solid green'
        pass2.style.color='green'
        isvalide=true
    }else {
        pass2.style.borderBottom='1px solid red'
        pass2.style.color='#ef4d4d'
        isvalide=false 
    }
}

const pass=(e)=>{
    if (e.target.value.length>6) {
        e.target.style.borderBottom='1px solid green'
        e.target.style.color='green'
        isvalide=true
    }else{
        e.target.style.borderBottom='1px solid red'
        e.target.style.color='#ef4d4d'
        isvalide=false
    }
    validpass()
}

const handletele=()=>{
    if (Tele.value.trim().length==10 && !isNaN(Tele.value.trim()) ) {
        Tele.style.borderBottom='1px solid green'
        isvalide=true
    }else{
        Tele.style.borderBottom="1px solid red"
        isvalide=false
    }
}

function disabledtrue() {
    nom.style.color="#7c7c7cc4"
    adress.style.color="#7c7c7cc4"
    ville.style.color="#7c7c7cc4"
    email.style.color="#7c7c7cc4"
    Tele.style.color="#7c7c7cc4"
    pass1.style.color="#7c7c7cc4"
    pass2.style.color="#7c7c7cc4"
}

function disabledfalse() {
    nom.style.color="#000000"
    ville.style.color="#000000"
    adress.style.color="#000000"
    email.style.color="#000000"
    Tele.style.color="#000000"
    pass1.style.color="#000000"
    pass2.style.color="#000000"
}
function resvalide() {
    valide.innerHTML="Le compte est bien créé"
    btn.setAttribute("disabled",true)
    error.innerHTML=""
        setTimeout(()=>{
            window.location.href = 'http://localhost/Project/?action=login';
        },2000)
}

nom.addEventListener('keyup',hadlenom);
adress.addEventListener('keyup',hadlenom);
ville.addEventListener('keyup',hadlenom);
email.addEventListener('keyup',handleemail);
pass1.addEventListener('keyup',pass);
Tele.addEventListener('keyup',handletele);
pass2.addEventListener('keyup',validpass);

form_register.addEventListener('submit',(e)=>{
    e.preventDefault()
    if (!isvalide ||
        nom.value.trim().length==0 ||
        adress.value.trim().length==0 ||
        ville.value.trim().length==0 ||
        !regemail.test(email.value.trim()) ||
        pass1.value.length<6 ||
        pass1.value!=pass2.value ||
        Tele.value.trim().length!=10 || isNaN(Tele.value.trim())
        ) {
            btn.className+=" btn-error"
            setTimeout(()=>{
                btn.className='form-btn'
            },500)
    }else{ 
        disabledtrue();
        const formData = new FormData();
        formData.append('nom', nom.value);
        formData.append('ville', ville.value);
        formData.append('adress', adress.value);
        formData.append('email', email.value);
        formData.append('Tele', Tele.value);
        formData.append('password1', pass1.value);
        formData.append('password2', pass2.value);
        fetch("http://localhost/Project/?action=creat_ass", {
            method: "POST",
            body: formData
        }).then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data)
                switch (data.code) {
                    case 0:resvalide();break;   
                    case 1:error.innerHTML="Toutes les données sont obligatoires."; break;
                    case 2:error.innerHTML="Les données sont incorrectes."; break;
                    case 3:error.innerHTML="L'email existe déjà."; break;
                    case 4:error.innerHTML="Échec de la création du compte."; break;
                };
                disabledfalse();
        })
        .catch(error => {
            console.log('Fetch Error:', error);
        });
        
        
    }
})

