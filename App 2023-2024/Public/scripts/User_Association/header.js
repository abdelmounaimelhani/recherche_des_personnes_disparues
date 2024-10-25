const div=document.getElementById('btnnav');
div.addEventListener('click',()=>{
    const ul=document.querySelector('.nav-list');
    ul.classList.toggle('visble')
    ul.classList.toggle('nonvisble')
})