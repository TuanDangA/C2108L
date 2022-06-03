/*
    Chuyen background-color class panel-bg khi scroll
*/
// $(document).scroll(function(){
//     if ($(this).scrollTop()>36){
//         $(".panel-bg").css({"backgroundColor": 'white'});
//         $(".navigation > ul > li > a").css({"color":"blue"});

//     }else{
//         $(".panel-bg").css({"background-color": 'transparent'});
//         $(".navigation > ul > li > a").css({"color":"blue"});

//     }
// })

$(document).ready(function(){
    $("#box1").click(function(){
        $("#pbox1").fadeToggle();
    });

    $("#box2").click(function(){
        $("#pbox2").fadeToggle();
    });
    $("#box3").click(function(){
        $("#pbox3").fadeToggle();
    });
    $("#box4").click(function(){
        $("#pbox4").fadeToggle();
    });
});

let slideIndex = 1;
function showFade(n) {
    let i;
    let vidSlides = $(".vidSlides");
    let picSlides = $(".picSlides");
    let infSlides = $(".infSlides");
    let smallPic = $(".animal-list-pic img");
    if (n > vidSlides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = vidSlides.length}
    for (i = 0; i < vidSlides.length; i++) {
        vidSlides[i].style.display = "none";
        picSlides[i].style.display = "none";
        infSlides[i].style.display = "none";
        smallPic[i].style.backgroundColor = "transparent";
    }
    vidSlides[slideIndex-1].style.display = "block";
    picSlides[slideIndex-1].style.display = "block";
    infSlides[slideIndex-1].style.display = "block";
    smallPic[slideIndex-1].style.backgroundColor = "lightgray";
}
function currentSlide(n){
    showFade(slideIndex = n);
}

let newsIndex = 0;
function newsSlides() {
    let i;
    let newsslides = $(".newsSlides");
    for (i = 0; i < newsslides.length; i++) {
        newsslides[i].style.display = "none";  
    }
    newsIndex++;
    if (newsIndex > newsslides.length) {newsIndex = 1}
    newsslides[newsIndex-1].style.display = "flex";
}

let eventIndex = 0;
function eventSlides() {
    let j;
    let eventslides = $(".eventSlides");
    for (j = 0; j < eventslides.length; j++) {
        eventslides[j].style.display = "none";  
    }
    eventIndex++;
    if (eventIndex > eventslides.length) {eventIndex = 1}
    eventslides[eventIndex-1].style.display = "flex";
    setTimeout(newsSlides, 3000);
}

$(document).ready(function(){
    function get_vn_time(){
        var time = new Date();
        var dow = time.getDay();
        if(dow==0)
            dow = "Sunday";
        else if (dow==1)
            dow = "Monday";
        else if (dow==2)
            dow = "Tuesday";
        else if (dow==3)
            dow = "Wednesday";
        else if (dow==4)
            dow = "Thursday";
        else if (dow==5)
            dow = "Friday"; 
        else if (dow==6)
            dow = "Saturday";  
        var day = time.getDate();
        var month = time.getMonth()+1;
        var year = time.getFullYear();
        var hr = time.getHours();
        var min = time.getMinutes();
        var sec = time.getSeconds();
        day = ((day < 10) ? "0" : "") + day;
        month = ((month < 10) ? "0" : "") + month;
        hr = ((hr < 10) ? "0" : "") + hr;
        min = ((min < 10) ? "0" : "") + min;
        sec = ((sec < 10) ? "0" : "") + sec;
        return dow + " " + day + "/" + month + "/" + year + " " + hr + ":" + min + ":" + sec;
    }

    function sho_clo_time(){
        var clo_vn_time = document.getElementById("clo_vn_time");
        if (clo_vn_time != null)
            clo_vn_time.innerHTML = get_vn_time();
        setTimeout(sho_clo_time, 1000);
    }
    window.setTimeout(sho_clo_time, 1000);

    if ($(".footer").offset().top < $(window).height()-$(".footer").height()){
        $(".footer").css({"position":"fixed","top":"calc(100vh - 580px)"});
    }else{
        $(".footer").css({"position":"relative","top":"10px"});
    }
    
    showFade(slideIndex);
    newsSlides();
    eventSlides();
    setInterval(eventSlides, 6000);
    $(this).scroll(function(){
        if ($(".animal-preview").offset().top > 0){
            x = 0.18*$(this).scrollTop();
            $(".animal-pic img").css({"transform":"translateY("+x+"px)"});
        }
    });
})