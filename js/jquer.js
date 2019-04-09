$(document).ready(function(){

$(".tutorial-menu").click(function(){


     $(".tutorial-content").toggleClass("active");

})

$(".close1").click(function(){


     $(".tutorial-content").toggleClass("active");

});







    
    $(".toggle1").click(function(){
        $(".toggle1 .development").animate({height: 'toggle'});
        $(".toggle2").animate({height:'toggle'});
        $(".toggle3").animate({height:'toggle'});
        $(".toggle4").animate({height:'toggle'});
        $(".toggle5").animate({height:'toggle'});
        $(".toggle6").animate({height:'toggle'});
        $(".toggle7").animate({height:'toggle'});
        $(".toggle8").animate({height:'toggle'});
        $(".toggle9").animate({height:'toggle'});
        
    });
    

    

$(".toggle2").click(function(){
        $(".toggle2 .development").animate({height: 'toggle'});
        $(".toggle1").animate({height:'toggle'});
        $(".toggle3").animate({height:'toggle'});
        $(".toggle4").animate({height:'toggle'});
        $(".toggle5").animate({height:'toggle'});
        $(".toggle6").animate({height:'toggle'});
        $(".toggle7").animate({height:'toggle'});
        $(".toggle8").animate({height:'toggle'});
        $(".toggle9").animate({height:'toggle'});

    });


    $(".toggle3").click(function(){
        $(".toggle3 .development").animate({height: 'toggle'});
        $(".toggle2").animate({height:'toggle'});
        $(".toggle1").animate({height:'toggle'});
        $(".toggle4").animate({height:'toggle'});
        $(".toggle5").animate({height:'toggle'});
        $(".toggle6").animate({height:'toggle'});
        $(".toggle7").animate({height:'toggle'});
        $(".toggle8").animate({height:'toggle'});
        $(".toggle9").animate({height:'toggle'});
    });

$(".toggle4").click(function(){
        $(".toggle4 .development").animate({height: 'toggle'});
        $(".toggle2").animate({height:'toggle'});
        $(".toggle3").animate({height:'toggle'});
        $(".toggle1").animate({height:'toggle'});
        $(".toggle5").animate({height:'toggle'});
        $(".toggle6").animate({height:'toggle'});
        $(".toggle7").animate({height:'toggle'});
        $(".toggle8").animate({height:'toggle'});
        $(".toggle9").animate({height:'toggle'});
    });


$(".toggle5").click(function(){
        $(".toggle5 .development").animate({height: 'toggle'});
        $(".toggle2").animate({height:'toggle'});
        $(".toggle3").animate({height:'toggle'});
        $(".toggle4").animate({height:'toggle'});
        $(".toggle1").animate({height:'toggle'});
        $(".toggle6").animate({height:'toggle'});
        $(".toggle7").animate({height:'toggle'});
        $(".toggle8").animate({height:'toggle'});
        $(".toggle9").animate({height:'toggle'});
    });


$(".toggle6").click(function(){
        $(".toggle6 .development").animate({height: 'toggle'});
        $(".toggle2").animate({height:'toggle'});
        $(".toggle3").animate({height:'toggle'});
        $(".toggle4").animate({height:'toggle'});
        $(".toggle5").animate({height:'toggle'});
        $(".toggle1").animate({height:'toggle'});
        $(".toggle7").animate({height:'toggle'});
        $(".toggle8").animate({height:'toggle'});
        $(".toggle9").animate({height:'toggle'});
    });


$(".toggle7").click(function(){
        $(".toggle7 .development").animate({height: 'toggle'});
        $(".toggle2").animate({height:'toggle'});
        $(".toggle3").animate({height:'toggle'});
        $(".toggle4").animate({height:'toggle'});
        $(".toggle5").animate({height:'toggle'});
        $(".toggle6").animate({height:'toggle'});
        $(".toggle1").animate({height:'toggle'});
        $(".toggle8").animate({height:'toggle'});
        $(".toggle9").animate({height:'toggle'});
    });


$(".toggle8").click(function(){
        $(".toggle8 .development").animate({height: 'toggle'});
        $(".toggle2").animate({height:'toggle'});
        $(".toggle3").animate({height:'toggle'});
        $(".toggle4").animate({height:'toggle'});
        $(".toggle5").animate({height:'toggle'});
        $(".toggle6").animate({height:'toggle'});
        $(".toggle7").animate({height:'toggle'});
        $(".toggle1").animate({height:'toggle'});
        $(".toggle9").animate({height:'toggle'});
    });


$(".toggle9").click(function(){
        $(".toggle9 .development").animate({height: 'toggle'});
        $(".toggle2").animate({height:'toggle'});
        $(".toggle3").animate({height:'toggle'});
        $(".toggle4").animate({height:'toggle'});
        $(".toggle5").animate({height:'toggle'});
        $(".toggle6").animate({height:'toggle'});
        $(".toggle7").animate({height:'toggle'});
        $(".toggle8").animate({height:'toggle'});
        $(".toggle1").animate({height:'toggle'});
    });


$("button.login").click(function(){
         $(".register").css({"opacity": "0", "z-index": "3"});
         $(this).css({"opacity": "0", "z-index": "-1"});
         $(".form_login").css({"opacity": "1", "z-index": "3"});
         $(".register_action").css({"opacity": "1", "z-index": "3"});

    });

$("button.register_action").click(function(){
        $(".form_login").css({"opacity": "0", "z-index": "3"});
        $(this).css({"opacity": "0", "z-index": "-1"});
        $(".register").css({"opacity": "1", "z-index": "3"});
        $("button.login").css({"opacity": "1", "z-index": "3"});
    });
       
        var modal8 = document.getElementById('Name');
        var btn8 = document.getElementById('updateName');
        var btn88 = document.getElementById('close8');

        btn8.onclick = function() {
           modal8.style.display = "block";
         } 
    
        btn88.onclick = function() {
           modal8.style.display = "none";
         } 


        var modal9 = document.getElementById('Email');
        var btn9 = document.getElementById('updateEmail');
        var btn99 = document.getElementById('close9');

        btn9.onclick = function() {
           modal9.style.display = "block";
         } 
    
        btn99.onclick = function() {
           modal9.style.display = "none";
         } 


        var modal10 = document.getElementById('Password');
        var btn10 = document.getElementById('updatePassword');
        var btn101 = document.getElementById('close10');

        btn10.onclick = function() {
           modal10.style.display = "block";
         } 
    
        btn101.onclick = function() {
           modal10.style.display = "none";
         } 

        var modal = document.getElementById('Type');
        var btn1 = document.getElementById('updateType');
        var btn11 = document.getElementById('close');

        btn1.onclick = function() {
           modal.style.display = "block";
         } 
    
        btn11.onclick = function() {
           modal.style.display = "none";
         } 

        var modal2 = document.getElementById('Country');
        var btn2 = document.getElementById('updateCountry');
        var btn22 = document.getElementById('close2');

        btn2.onclick = function() {
           modal2.style.display = "block";
         } 
    
        btn22.onclick = function() {
           modal2.style.display = "none";
         } 

        var modal3 = document.getElementById('City');
        var btn3 = document.getElementById('updateTCity');
        var btn33 = document.getElementById('close3');

        btn3.onclick = function() {
           modal3.style.display = "block";
         } 
    
        btn33.onclick = function() {
           modal3.style.display = "none";
         } 

        var modal4 = document.getElementById('Phone');
        var btn4 = document.getElementById('updatePhone');
        var btn44 = document.getElementById('close4');

        btn4.onclick = function() {
           modal4.style.display = "block";
         } 
    
        btn44.onclick = function() {
           modal4.style.display = "none";
         } 

        var modal5 = document.getElementById('Image');
        var btn5 = document.getElementById('updateImage');
        var btn55 = document.getElementById('close5');

        btn5.onclick = function() {
           modal5.style.display = "block";
         } 
    
        btn55.onclick = function() {
           modal5.style.display = "none";
         } 

        var modal6 = document.getElementById('Birth');
        var btn6 = document.getElementById('updateBirth');
        var btn66 = document.getElementById('close6');

        btn6.onclick = function() {
           modal6.style.display = "block";
         } 
    
        btn66.onclick = function() {
           modal6.style.display = "none";
         } 

        var modal7 = document.getElementById('Admin');
        var btn7 = document.getElementById('updateAdmin');
        var btn77 = document.getElementById('close7');

        btn7.onclick = function() {
           modal7.style.display = "block";
         } 
    
        btn77.onclick = function() {
           modal7.style.display = "none";
         }







});















