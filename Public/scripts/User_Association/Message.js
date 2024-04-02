let Discussions=document.getElementById("Discussions")
let chat=document.getElementById("chat")
let HASH=document.getElementById("HASH")
let USERHASH=document.getElementById("USERHASH")
let Messages=document.getElementById("Messages")
let mesg_err=document.getElementById('mesg_err')
let diver=document.querySelector('.diver')
let clic=0
let users={res:[[],[]]}




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
        let div=document.getElementById('infochat')
        let img=document.getElementById('userimg')
        let a=document.getElementById('userlink')
        let span=document.getElementById('username')
        div.style.display='flex'
        a.href=user.HASH_ID
        img.src=user.photo
        span.innerHTML=user.nom

        let divform=document.getElementById("form_message")
        divform.innerHTML=""
        let input=document.createElement("input")
        let icon=document.createElement("img")
        icon.classList.add("icon_envoi")
        icon.src="http://localhost/Project/Public/imgs/envoyer.png"
        icon.addEventListener("click",()=>{
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
        divform.appendChild(input)
        divform.appendChild(icon)

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
    div.classList.add('userinfo')
    img.classList.add('userimg')
    span.classList.add('username')
    divN.classList.add('divN')
    img.src=user.photo
    span.innerText=user.nom

    div.appendChild(img)
    div.appendChild(span)
    
    let idc=new FormData()
    idc.append("idc",user.id)
    fetch("http://localhost/Project/?action=get_nb_msg",{method:"POST",body:idc})
    .then(response=>response.json())
    .then(data=>{NBMSG=data.res.nbmsg})
    console.log(user)
    div.addEventListener("click",()=>{
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
    fetch("http://localhost/Project/?action=get_info_conv",{
        method:"POST",
        body:data
    })
    .then(response=>response.json())
    .then(data=>{
        if (data.res!=1) {
            
            creatchate(data.res)
        }
    })
    //
}