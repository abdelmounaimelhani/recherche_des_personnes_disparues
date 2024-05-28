let debut = 0;let nb = 10;

let Posts=document.getElementById('Posts')

let inputrch=document.getElementById('inputrch')
let btnpost=document.getElementById('p_post')
let users=document.getElementById('result')
let msg=document.getElementById('msg')
let diveloader=document.getElementsByClassName('loader')[0]
let userID=document.getElementById('userid').value
let usernom=document.getElementById('usernom').value
btnpost.style.cursor='pointer'
 
function Dloader(){
    setTimeout(()=>{
        diveloader.style.display='none'
    },300)
}

function Post_img(ph){
    if (ph!=null) {
        let img=document.createElement('img');
        img.classList.add("card-img","d-block","m-auto","max-width-300")
        img.src=ph
        return img
    }else return ""
}

function createcomment(comment) {
    let comentdesc=comment.discription
    let divcomment=document.createElement('div')
        let commentinfo=document.createElement('div')
        commentinfo.classList.add("ms-2")
            let userC=document.createElement('a')
            if (userID==comment.id_user) {userC.href="http://localhost/Project/?action=Editinfo"}
            else userC.href=comment.HASH; //href
            userC.innerHTML=comment.nom+' '+comment.prenom
            userC.classList.add("text-s","text-dark")

            let dateC=document.createElement('p')
            dateC.innerText=comment.date_comment
            dateC.classList.add("text-xxs","text-dark")
        commentinfo.append(userC)
        commentinfo.append(dateC)
        let disc=document.createElement('p')
        disc.innerText=comentdesc
        disc.classList.add("text-s","mt-0","ps-2")
        if (comentdesc.length>160) {
            disc.style.cursor='pointer'
            disc.style.height="100px"
            disc.addEventListener("click",()=>{
                if (disc.style.height!="100px") {
                    disc.style.height="100px"
                }else disc.style.height="max-content"
                
            })
        }
    divcomment.append(commentinfo)
    divcomment.append(disc)
    return divcomment
}

function Post_action(e,Cinfo) {
    
    let divbtn=document.createElement('div')
    let comment=document.createElement('a')
    let Message=document.createElement('a')
    divbtn.classList.add("d-flex","justify-content-around")
    comment.href=`?action=Pubinfo&id=${e.id}&user=${e.HASH}`
    Message.href=`?action=Messge&id=${e.HASH}`
    comment.classList.add("btn" ,"btn-behance" ,"col-5")
    Message.classList.add("btn" ,"btn-behance" ,"col-5")
    comment.innerHTML=`Commentaire (<span id='span${e.id}'>${Cinfo[0]}</span>)`
    Message.innerText=`Message`
    divbtn.append(comment)
    divbtn.append(Message)

    let divcomments=document.createElement('div')
    if (Cinfo[0]!=0) {
        let cpt=0
        Cinfo[1].user.forEach((e)=>{
            if (cpt<2) {
                divcomments.append(createcomment(e))
            };
            cpt++
        })
        cpt=0
        Cinfo[1].asso.forEach((e)=>{
            e.prenom=""
            if (cpt<3) {
                divcomments.append(createcomment(e))
            };
            cpt++
        })
        
    }
    let form=document.createElement('form')
    let divinput=document.createElement('div')
    divinput.classList.add("col-9")
    let input=document.createElement('input')
    let button=document.createElement('button')
    
    form.classList.add('d-flex','justify-content-around')
    input.classList.add('form-control')
    button.classList.add('btn')
    button.innerText='Comment'
    let idp=e.id

    form.addEventListener("submit",(e)=>{
    
        e.preventDefault()
        let commentdata=new FormData()
        commentdata.append("idp",idp)
        commentdata.append("comment",input.value.trim())
        if (input.value.trim()!="") {
            diveloader.style.display='flex'
            fetch("http://localhost/Project/?action=addcoment",{method:'POST',body:commentdata})
            .then(response=>{return response.json()})
            .then(data=>{
                
                if (data.res==1) {
                    let date=new Date()
                    obj={
                        'discription':input.value,'id_user':userID,
                        'nom':usernom,'prenom':"",
                        'date_comment':`${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}:${date.getSeconds().toString().padStart(2, '0')}`
                    }
                    divcomments.append(createcomment(obj))
                    
                    let span=document.getElementById(`span${idp}`)
                    span.innerHTML=parseInt(span.innerText)+1
                    input.value=""
                }
                Dloader()
            }).catch((error)=>{
                Dloader()
                console.log(error);
            })
        }
    })
    
    divinput.append(input)
    form.append(divinput)
    form.append(button)

    
    return [divbtn,divcomments,form]

}

function Post(e,commentinfo) {
    
    let Divpost=document.createElement("div")
    Divpost.classList.add("col-12","mb-lg-0","mb-4")

    let card=document.createElement("div")
    card.classList.add("card","mb-3")

    let cardheader=document.createElement("div")
    cardheader.classList.add("card-header","pb-0","p-3")

    let Divinfopost=document.createElement("div")
    Divinfopost.classList.add("d-flex","justify-content-start","align-items-center")

    let imguser=document.createElement("img")
    imguser.classList.add("avatar")
    imguser.src = e.userphoto

    let Divinfouser=document.createElement("div")
    Divinfouser.classList.add("ms-2")

    let a=document.createElement("a")
    a.classList.add("text-xs")
    a.href=`http://localhost/Project/?action=Profile_user&ID=${e.HASH}`
    let nom=e.nom
    let prenom=""
    if(e.prenom != undefined) prenom=e.prenom
    a.innerText = e.nom + " " + prenom

    let dateP=document.createElement("p")
    dateP.classList.add("text-xxs")
    dateP.innerText = e.datepub

    Divinfouser.append(a)
    Divinfouser.append(dateP)

    Divinfopost.append(imguser)
    Divinfopost.append(Divinfouser)
    cardheader.append(Divinfopost)
    //----------------------------------
    let cardbody=document.createElement("div")
    cardbody.classList.add("card-body")
    let P=document.createElement("p")
    P.classList.add("max-height-100","overflow-auto")
    P.innerText = e.discription
    cardbody.append(P)
    let Postimg=Post_img(e.photo)
    cardbody.append(Postimg)
    //----------------------------------
    let cardfooter=document.createElement("div")
    cardfooter.classList.add('card-footer')
    let Postaction=Post_action(e,commentinfo)    
    cardfooter.appendChild(Postaction[0])
    cardfooter.appendChild(Postaction[1])
    cardfooter.appendChild(Postaction[2])

    card.appendChild(cardheader)
    card.appendChild(cardbody)
    card.appendChild(cardfooter)

    Divpost.appendChild(card)

    return Divpost
}

async function Getcomment(id) {
    let nbc,comment;
    await fetch(`http://localhost/Project/?action=getcomment&idp=${id}`)
        .then(response => response.json())
        .then(data => {
            
            nbc=data.nbc.nbC
            comment=data.Comment
        })
        .catch(error => console.error('Error:', error));
    return {nbcomment:nbc,Comments:comment}
}

async function Getpost(type=null) {
    diveloader.style.display='flex'
    try {  
        let response = ""
        if (type==null) {
            response = await fetch(`http://localhost/Project/?action=getposts&debut=${debut}&nb=${nb}`);
        }else{
            response = await fetch(`http://localhost/Project/?action=getposts_Dec&debut=${debut}&nb=${nb}`);
        }
        const data = await response.json();
        console.log(data);
        if (data.length > 0) {
            msg.innerHTML = "";
            for (const e of data) {
                
                const commentData = await Getcomment(e.id);
                const nbc = commentData.nbcomment;
                const comment = commentData.Comments;
                
                const poste = Post(e,[nbc,comment]);
                Posts.append(poste);
            }
            debut += 10;
            nb += 10;
        } else {
            msg.innerHTML = "Aucune des Postes";
            btnpost.style.display='none'
        }
        Dloader()
    } catch (error) {console.error(error);Dloader()}
}

Getpost();


function toggelimgsuive(icon,res) {
    if(res==0)icon.src='Public/imgs/add-user.png'
    else icon.src='Public/imgs/add-user-valide.png'
}

function togglesuive(HASH,icon,t) {
    diveloader.style.display='flex'
    let data = new FormData()
    data.append('id',HASH)
    data.append('type',t)
    fetch("http://localhost/Project/?action=toggelusersuive",{method:'POST',body:data})
    .then(response=>{return response.json()})
    .then(res=>{
        toggelimgsuive(icon,res.res)
        Dloader()
    }).catch(error=>{
        Dloader()
        console.log(error);
    })
}
async function user(e,type) {
     
    let nom=href=""
    if (type=="user") {
        nom=e.nom + " " + e.prenom
        href=`http://localhost/Project/?action=Profile&hash=${e.HASH_ID}`
    }else if(type=="ass"){
        nom=e.nom
        href=`http://localhost/Project/?action=Profile&hash=${e.HASH_ID}`
    }
    let div=document.createElement('div')
    div.classList.add("card","bg-white","me-2","col-3")
        let bodycard=document.createElement("div")
        bodycard.classList.add("d-flex","pe-2","pt-2","align-items-center")
            let divinfo=document.createElement("div")
            divinfo.classList.add("col-10","d-flex","align-content-center")
                let img=document.createElement('img')
                img.classList.add("avatar","m-1")
                img.src= e.photo
                let a=document.createElement('a')
                a.classList.add("text-xs","col-8","ms-2","mb-0","font-weight-bold")
                a.href=href
                a.innerText= nom
            let divicon=document.createElement("div")
            divicon.classList.add("col-2","text-end")
                let icon=document.createElement('img')
                icon.classList.add("col-8","rounded-circle")
                icon.style.cursor='pointer'
    let data = new FormData()
    
    data.append('id',e.HASH_ID)
    data.append('type',type)

    const response =await fetch("http://localhost/Project/?action=usersuive",{method:'POST',body:data})
    const res=response.json()
    res.then(res=>{toggelimgsuive(icon,res.res)})
    icon.addEventListener('click',()=>{togglesuive(e.HASH_ID,icon,type)})
    
    divinfo.appendChild(img)
    divinfo.appendChild(a)
    divicon.appendChild(icon)
    bodycard.appendChild(divinfo)
    bodycard.appendChild(divicon)
    div.appendChild(bodycard)
    return div
}

function Getusers(nom) {
    diveloader.style.display='flex'
    fetch(`http://localhost/Project/?action=recherchuser&nom=${nom}`)
    .then((response)=>{return response.json()})
    .then((data)=>{
        users.innerHTML="";
        if (data.user.length > 0) data.user.forEach(e => {
            user(e,'user').then(res=>{users.append(res)})
        });
        if(data.asso.length > 0) data.asso.forEach(e => {
            user(e,'ass').then(res=>{users.append(res)})
        }) 
        if(data.user.length == 0 && data.asso.length == 0) users.innerHTML = "<span class='user-res'>Aucune des resultat</span>";
        Dloader()
    }).catch(error=>{
        Dloader()
        console.log(error);
    })
}

Getusers("")
const ADis=document.getElementById("ADis")
const ADec=document.getElementById("ADec")
let type=""
ADis.addEventListener("click",(e)=>{
    type="DI"
    debut = 0 ; nb = 10;
    e.target.classList.toggle('btn-behance')
    ADec.classList.toggle('btn-behance')
    Posts.innerHTML=""
    Getpost();
})

ADec.addEventListener("click",(e)=>{
    type="DE"
    debut = 0 ; nb = 10;
    e.target.classList.toggle('btn-behance')
    ADis.classList.toggle('btn-behance')
    Posts.innerHTML=""
    Getpost(true);
})

btnpost.addEventListener('click',()=>{
    if (type=="DI") Getpost()
    else if(type=="DE") Getpost(true)
})

inputrch.addEventListener('keyup',(e)=>{
    e.preventDefault();
    let nom = inputrch.value;
    Getusers(nom)
})

