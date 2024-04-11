let Discussions=document.getElementById("Discussions")
let chat=document.getElementById("chat")
let HASH=document.getElementById("HASH")
let USERHASH=document.getElementById("USERHASH")
let Messages=document.getElementById("Messages")
let mesg_err=document.getElementById('mesg_err')
let diver=document.querySelector('.diver')
let clic=0
let users={res:[[],[]]}
let divinfo=document.getElementById('infochat')
let imgu=document.getElementById("userimg")
let linku=document.getElementById("userlink")
let usern=document.getElementById("username")





async function  getDiscussions(){
    await fetch("http://localhost/Project/?action=getDiscussions")
    .then((response)=>{return response.json()})
    .then(data=>{
        
        if(data.res!=0){
            users=data
            for (let index = 0; index < 2; index++) {
                data.res[index].forEach(e => {
                    Discussions.appendChild(creatuser(e))
                });
            }
        }
    })

    await fetch("http://localhost/Project/?action=get_suive")
    .then((response)=>{return response.json()})
    .then(data=>{
        if(data.res!=0){
            for (let index = 0; index < 2; index++) {
                data.res[index].forEach(e => {
                    let cpt=0
                    
                    for (let i = 0; i < 2; i++) {
                        users.res[i].forEach(us=>{
                        if (us.HASH_ID==e.HASH_ID) {
                            cpt++
                        }
                        })
                    }
                    
                    if (cpt==0) Discussions.appendChild(creatuser(e))
                });
            }
        }
    })

}

getDiscussions()

function creatchate(user) {
    if (user.HASH_ID!=USERHASH.value) {
        Messages.innerHTML=""
        USERHASH.value=user.HASH_ID
        let nbMs=0
 
        let divform=document.getElementById("form_message")
        divform.innerHTML=""
        let form=document.createElement("form")
        form.classList.add("d-flex")
        let divinpt=document.createElement('div')
        divinpt.classList.add("col-10")
        let input=document.createElement("input")
        input.classList.add("form-control")
        divinpt.appendChild(input)
        let button=document.createElement("button")
        button.classList.add("btn","ms-2")
        let i=document.createElement("i")
        i.classList.add("fas","fa-paper-plane")
        button.appendChild(i)
        form.append(divinpt,button)
        form.addEventListener("click",(e)=>{
            e.preventDefault()
            if (input.value.trim() !== "") {
                let Data=new FormData()
                Data.append('Message',input.value)
                Data.append('Destinataire',user.HASH_ID)
                fetch("http://localhost/Project/?action=envoimess",{method:"POST",body:Data})
                .then(response=>response.json())
                .then(data=>{
                    if (data.res==1) {
                        let date = new Date();
                        let formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}:${date.getSeconds().toString().padStart(2, '0')}`;
                        let m={
                            Message:input.value,
                            Dateenvoi:formattedDate
                        }
                        Messages.appendChild(creatMessage(m,"message2"))
                        Messages.scrollTo(0,Messages.scrollHeight+100)
                        nbMs++
                        input.value=""
                        mesg_err.innerHTML=""
                        diver.style.display="none"
                    }else console.log("errore")
                })
            }
        })
        divform.appendChild(form)

        fetch(`http://localhost/Project/?action=get_Message&id=${user.id}`)
        .then(response=>response.json())
        .then(data=>{
            if (data.res.length>0) {
                mesg_err.style.display="none"
                diver.style.display="none"
                data.res.forEach(m=>{
                    if (m.Expediteur==HASH.value) Messages.appendChild(creatMessage(m,"message2"))
                    else Messages.appendChild(creatMessage(m,"message1"))
                    Messages.scrollTo(0,Messages.scrollHeight+100)
                })
            }else {
                mesg_err.innerHTML="Aucune des Messages"
                mesg_err.style.display="block"
                diver.style.display="flex"
            }
        })

        let idc=new FormData()
        idc.append("idc",user.id)
        fetch("http://localhost/Project/?action=get_nb_msg",{method:"POST",body:idc})
        .then(response=>response.json())
        .then(data=>{nbMs=data.res.nbmsg})

        setInterval(()=>{
            let nnbm=0
            fetch("http://localhost/Project/?action=get_nb_msg",{method:"POST",body:idc})
            .then(response=>response.json())
            .then(data=>{
                nnbm=data.res.nbmsg; 
                if (nnbm>nbMs) {
                    let DATA=new FormData()
                    DATA.append("idc",user.id)
                    DATA.append("limt",nnbm-nbMs)
                    fetch("http://localhost/Project/?action=get_dernier_msg",{method:"POST",body:DATA})
                    .then(response=>response.json())
                    .then(data=>{
                        data.res.forEach((e)=>{
                            if (e.Expediteur==USERHASH.value) {
                                Messages.appendChild(creatMessage(e,"message1"))
                                nbMs++
                                Messages.scrollTo(0,Messages.scrollHeight+100)
                            }
                        })
                    })
                }
            })
        },1500)
    }
}

let creatuser=(user)=>{
    
    let div=document.createElement('div')
    let img=document.createElement('img')
    let span=document.createElement('span')
    let divN=document.createElement('div')
    let NBMSG=0
    div.classList.add('d-flex','cursor-pointer','align-items-center','p-1')
    img.classList.add('avatar','me-2')
    span.classList.add('d-block','col-9')
    divN.classList.add('bg-info','opacity-5','text-center','col-1','rounded-circle')
    img.src=user.photo
    span.innerText=user.nom
    console.log(user);
    div.appendChild(img)
    div.appendChild(span)
    
    let idc=new FormData()
    idc.append("idc",user.id)
    fetch("http://localhost/Project/?action=get_nb_msg",{method:"POST",body:idc})
    .then(response=>response.json())
    .then(data=>{NBMSG=data.res.nbmsg})
    
    div.addEventListener("click",()=>{
        divinfo.classList.remove('d-none')
        imgu.src=user.photo
        linku.href=`http://localhost/Project/?action=Profile&hash=${user.HASH_ID}`
        usern.innerText=user.nom
        fetch("http://localhost/Project/?action=get_nb_msg",{method:"POST",body:idc})
        .then(response=>response.json())
        .then(data=>{NBMSG=data.res.nbmsg})
        divN.style.display='none'
        creatchate(user)
    })   

    setInterval(()=>{
        console.log(user.HASH_ID!=USERHASH.value)
        if (user.HASH_ID!=USERHASH.value) {
            let nnbm=0
            fetch("http://localhost/Project/?action=get_nb_msg",{method:"POST",body:idc})
            .then(response=>response.json())
            .then(data=>{
                nnbm=data.res.nbmsg; 
                if (nnbm>NBMSG) {
                    divN.style.display='block'
                    divN.innerHTML=nnbm-NBMSG
                }else divN.style.display='none'
            })  
        }else {
            fetch("http://localhost/Project/?action=get_nb_msg",{method:"POST",body:idc})
            .then(response=>response.json())
            .then(data=>{NBMSG=data.res.nbmsg})
            divN.style.display='none'
        }
        
    },3000)

    div.appendChild(divN)
    return div
}

let creatMessage=(e,classname)=>{
    let div=document.createElement("div")
    div.classList.add(classname)
    let div1=document.createElement("div")
    let P=document.createElement("p")
    P.innerHTML=e.Message
    let span=document.createElement("span")
    span.classList.add("dateM")
    span.innerHTML=e.Dateenvoi

    div1.appendChild(P)
    div1.appendChild(span)

    div.appendChild(div1)

    return div
}


let url=new URL(window.location.href)
let params=new URLSearchParams(url.search);
if (params.has('id')) {
    const id_HASH=params.get('id')
    const data=new FormData()
    data.append("HASH",id_HASH)
    fetch("http://localhost/Project/?action=get_info_user",{
        method:"POST",
        body:data
    })
    .then(response=>response.json())
    .then(data=>{
        console.log(data);
        if (data.res!=1) {
            creatchate(data.res)
            divinfo.classList.remove('d-none')
            imgu.src=data.res.photo
            linku.href=`http://localhost/Project/?action=Profile&hash=${data.res.HASH_ID}`
            usern.innerText=data.res.nom
        }
    })
    //
}