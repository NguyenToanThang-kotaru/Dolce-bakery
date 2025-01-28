const imagelist = document.getElementById('run')
const images=document.getElementsByClassName('img')
let current =0
const length = images.length
setInterval(()=>{
    if(current == length -1){
        current = 0 
        let width = images[0].offsetWidth
        imagelist.style.transform = `translateX(0px)`
    } else{
    current ++
    let width = images[0].offsetWidth
    imagelist.style.transform = `translateX(${width * -1 *current}px)`
    }
},3000)
