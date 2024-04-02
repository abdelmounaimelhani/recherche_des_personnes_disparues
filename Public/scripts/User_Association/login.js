/*$(document).ready(function() {

const inputemail=document.getElementById('email')
const inputpass=document.getElementById('Pass')
const btn=document.getElementById('btn')
const regemail = new RegExp("^.+@.+\\.[a-zA-Z]+$");

let isvalide=true

const email=()=>{
    if (!regemail.test(inputemail.value.trim())) {
        inputemail.style.borderBottom='1px solid red'
        isvalide=false;
    }else{
        inputemail.style.borderBottom='1px solid black'
        isvalide=true
    }
}

const pass=()=>{
    if (inputpass.value.trim().length>6) {
        inputpass.style.borderBottom='1px solid black'
        isvalide=true
    }else{
        inputpass.style.borderBottom='1px solid red'
        isvalide=false
    }
}


inputemail.addEventListener("keyup",email)
inputpass.addEventListener("keyup",pass)



    $("#form_login").submit(function(e) {
        e.preventDefault();
        if (
            inputemail.value.trim().length==0 ||
            !isvalide ||
            !inputpass.value.trim().length>6
            ) {
                
                e.preventDefault()
                btn.className+=" btn-error"
                setTimeout(()=>{
                    btn.className='form-btn'
                },500)
        }else{

            let formData = {
                email: inputemail.value,
                pass: inputpass.value
            };
    
            $.post("http://localhost/Project/?action=V_login", formData, function(response) {
                let res=JSON.parse(response)
                if (res.code==0) {
                    btn.className+=" btn-error"
                setTimeout(()=>{
                    btn.className='form-btn'
                },500)
                    $("#emailer").html('Email incorrect. Veuillez vérifier votre email.')
                    $("#passer").html('')
                }else if(res.code==1){
                    btn.className+=" btn-error"
                setTimeout(()=>{
                    btn.className='form-btn'
                },500)
                    $("#passer").html('Mot de pass incorrect.')
                    $("#emailer").html('')
                }else if(res.code==2){
                        window.location.href = 'http://localhost/Project/?action=Accueil';
                }
                console.log()
            });
        }
        
    });
});*/






document.addEventListener("DOMContentLoaded", function() {

    const inputemail = document.getElementById('email');
    const inputpass = document.getElementById('Pass');
    const eng = document.getElementById('eng');
    const btn = document.getElementById('btn');
    const regemail = new RegExp("^.+@.+\\.[a-zA-Z]+$");

    let isvalide = true;

    const email = () => {
        if (!regemail.test(inputemail.value.trim())) {
            inputemail.style.borderBottom = '1px solid red';
            isvalide = false;
        } else {
            inputemail.style.borderBottom = '1px solid black';
            isvalide = true;
        }
    };

    const pass = () => {
        if (inputpass.value.trim().length > 6) {
            inputpass.style.borderBottom = '1px solid black';
            isvalide = true;
        } else {
            inputpass.style.borderBottom = '1px solid red';
            isvalide = false;
        }
    };

    inputemail.addEventListener("keyup", email);
    inputpass.addEventListener("keyup", pass);

    const eventerror=()=>{
        btn.className += " btn-error";
            setTimeout(() => {
                btn.className = 'form-btn';
            }, 500);
    }
    const msgeror=(elm1,elm2,msg)=>{
        document.getElementById(elm1).innerHTML = msg;
        document.getElementById(elm2).innerHTML = '';
    }

    document.getElementById("form_login").addEventListener("submit", function(e) {
        e.preventDefault();
        
        if (
            inputemail.value.trim().length === 0 ||
            !isvalide ||
            inputpass.value.trim().length <= 6
        ) {
            eventerror()
        } else {
            const formData = new FormData();
            formData.append('email', inputemail.value);
            formData.append('pass', inputpass.value);
            formData.append('eng', eng.checked);

            fetch("http://localhost/Project/?action=V_login", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(res => {
                if (res.code === 0) {
                    eventerror()
                    msgeror("emailer","passer",'Email incorrect. Veuillez vérifier votre email.')
                } else if (res.code === 1) {
                    eventerror()
                    msgeror("passer","emailer", 'Mot de pass incorrect.')
                } else if (res.code === 2) {
                    window.location.href = 'http://localhost/Project/?action=Accueil';
                }
                 else if (res.code === 3) {
                    window.location.href = 'http://localhost/Project/?action=Accueil';
                }
            })
           
        }
    });

});

