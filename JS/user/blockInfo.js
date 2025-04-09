let a=document.getElementById("infor");
let b=document.getElementById("InfoUser-container");
let c=document.getElementById("Back");
let d=document.getElementById("overlayInfo")
let flagInfo=0;
d.style.display="none";
a.addEventListener("click",function(){
    if(flagInfo===0){
                        
        b.style.display="block";
        d.style.display="block";
        flagInfo=1;
    }

    else{
        b.style.display="none";
        d.style.display="none";
        flagInfo=0;

    }

    c.addEventListener("click",function(){
    b.style.display="none";
    d.style.display="none";
    flagInfo=0;
    })
    window.addEventListener("click",function(event){
        if(event.target===d){
            b.style.display="none";
            d.style.display="none";
            flagInfo=0;
        }
    })
})
