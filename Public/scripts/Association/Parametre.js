const Association=document.getElementById('Nom-Association')
const ville=document.getElementById('ville')
const email=document.getElementById('email')
const Tele=document.getElementById('Tele')
const adress=document.getElementById('adress')
const password=document.getElementById('pass')
const form_info=document.getElementById('form_info')
const btn=document.getElementById('btn')
const regemail = new RegExp("^.+@.+\\.[a-zA-Z]+$");
let isvalide=true

const hadleInputtext=(e)=>{
    if (e.target.value.trim().length==0) {
        e.target.style.borderBottom="1px solid red"
        isvalide=false
    }else{
        e.target.style.borderBottom='1px solid black'
        isvalide=true
    }
}

const handleemail=()=>{
    if (!regemail.test(email.value.trim())) {
        email.style.borderBottom='1px solid red'
        isvalide=false;
    }else{
        email.style.borderBottom='1px solid black'
        isvalide=true
    }
}

const pass=(e)=>{
    if (e.target.value.length>6) {
        e.target.style.borderBottom='1px solid black'
        e.target.style.color='black'
        isvalide=true
    }else{
        e.target.style.borderBottom='1px solid red'
        e.target.style.color='#ef4d4d'
        isvalide=false
    }
}

nom.addEventListener('keyup',hadleInputtext)
ville .addEventListener('keyup',hadleInputtext)
email.addEventListener('keyup',handleemail)
password.addEventListener('keyup',pass)
form_info.addEventListener('submit',(e)=>{
    
    if (!isvalide ||
        nom.value.trim().length==0 ||
        prenom.value.trim().length==0 ||
        !regemail.test(email.value.trim())||
        password.value=="") {
            e.preventDefault()
            btn.className+=" btn-error"
                setTimeout(()=>{
                    btn.className='form-btn'
                },1000)
    }
})





const form_pass=document.getElementById('form_pass')
const pass1=document.getElementById('password')
const pass2=document.getElementById('password1')
const pass3=document.getElementById('password2')
const btn_subpass=document.getElementById('btn_subpass')
let isvalide2=true
const validpass=()=>{
    if (pass2.value==pass3.value && pass3.value!="") {
        pass3.style.borderBottom='1px solid black'
        pass3.style.color='black'
        isvalide2=true
    }else {
        pass3.style.borderBottom='1px solid red'
        pass3.style.color='#ef4d4d'
        isvalide2=false 
    }
}

const handlepass=(e)=>{
    if (e.target.value.length>6) {
        e.target.style.borderBottom='1px solid black'
        e.target.style.color='black'
        isvalide2=true
    }else{
        e.target.style.borderBottom='1px solid red'
        e.target.style.color='#ef4d4d'
        isvalide2=false
    }

}

pass1.addEventListener('keyup',(e)=>{handlepass(e)})
pass2.addEventListener('keyup',(e)=>{handlepass(e);validpass()})
pass3.addEventListener('keyup',validpass)
form_pass.addEventListener('submit',(e)=>{
    
    if (!isvalide2 ||
        pass1.value.length<6||
        pass2.value.length<6||
        pass2.value!=pass3.value
        ) {
            e.preventDefault()
            btn_subpass.className+=" btn-error"
            setTimeout(()=>{
                btn_subpass.className='form-btn'
            },1000)
    }
})





const btn_pass=document.getElementById('btn_pass')
const btn_info=document.getElementById('btn_info')




btn_pass.addEventListener('click',()=>{
    form_pass.className += ' visible'
    form_info.className = 'form-info'
    setTimeout(()=>{
        form_pass.style.display='none'
        form_info.style.display='block'
    },1000)
})

btn_info.addEventListener('click',()=>{
    form_pass.className = 'form-info'
    form_info.className += ' visible'

    setTimeout(()=>{
        form_pass.style.display='block'
        form_info.style.display='none'
    },1000)

    
})