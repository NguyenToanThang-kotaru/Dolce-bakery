let a=document.getElementById("infor");
let b=document.getElementById("InfoUser-container");
let c=document.getElementById("Back");
let d=document.getElementById("overlayInfo");
let e=document.querySelector(".overlayInfoAddress");
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

function OnUpdateAddress() {
    e.style.display = "block";
    document.querySelector(".overlayAddress").style.display = "block";
}

e.addEventListener("click",function(){
    e.style.display = "none";
    document.querySelector(".overlayAddress").style.display = "none";
})

$(document).ready(function(){
    $.get("../../PHP/users/get_provinces.php", function(data){
        $("#province").append(data);
    });

    $("#province").change(function(){
        var provinceId = $(this).val();
        if(provinceId != "") {
            $.post("../../PHP/users/get_districts.php", {province_id: provinceId}, function(data){
                $("#district").html(data);
            });
        } else {
            $("#district").html("<option value=''>Chọn quận/huyện</option>");
        }
    });
});
