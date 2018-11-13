
//get the modal add/set confirmation
var wb = document.getElementById("wbackground");
var dlg= document.getElementById("dlgbox");

/************************************* afficher popup add*******************************************/
$(document).ready(function(){
    $("#showConf").click(function(){
        if (dlg==null || wb==null) {
            alert("Null");
        }else{
            wb.style.display="block";
            dlg.style.display="block";
            var winWidth =window.innerWidth;
            var winHeight=window.innerHeight;
            
            dlg.style.left=(winWidth/2) - 480/2 +"px";
            dlg.style.top= "225px";
        }
    });
});


/************************************* fermer popup add *******************************************/
$(document).ready(function(){
    $("#closeConf").click(function(){
        if (dlg==null || wb==null) {
            alert("Null");
        }else{
            wb.style.display="none";
            dlg.style.display="none";
        }
    });
});


//Get the modal delete confirmation
var wbdel = document.getElementById("wbackgroundDel");
var dlgdel= document.getElementById("dlgboxDel");

/************************************* afficher popup delete *******************************************/
$(document).ready(function(){
    $("#showConfDel").click(function(){
        if (dlgdel==null || wbdel==null) {
            alert("Null");
        }else{
            wbdel.style.display="block";
            dlgdel.style.display="block";
            var winWidth =window.innerWidth;
            var winHeight=window.innerHeight;
            
            dlgdel.style.left=(winWidth/2) - 480/2 +"px";
            dlgdel.style.top= "225px";
        }
    });
});


/************************************* fermer popup delete *******************************************/
$(document).ready(function(){
    $("#closeConfDel").click(function(){
        if (dlgdel==null || wbdel==null) {
            alert("Null");
        }else{
            wbdel.style.display="none";
            dlgdel.style.display="none";
        }
    });
});


//Get the modal delete confirmation
var wbset = document.getElementById("wbackgroundset");
var dlgset= document.getElementById("dlgboxset");


/************************************* afficher popup set *******************************************/
$(document).ready(function(){
    $("#showConfset").click(function(){
        if (dlgset==null || wbset==null) {
            alert("Null");
        }else{
            wbset.style.display="block";
            dlgset.style.display="block";
            var winWidth =window.innerWidth;
            var winHeight=window.innerHeight;
            
            dlgset.style.left=(winWidth/2) - 480/2 +"px";
            dlgset.style.top= "225px";
        }
    });
});


/************************************* fermer popup set *******************************************/
$(document).ready(function(){
    $("#closeConfset").click(function(){
        if (dlgset==null || wbset==null) {
            alert("Null");
        }else{
            wbset.style.display="none";
            dlgset.style.display="none";
        }
    });
});



//Get the modal success 
var wbsuccess = document.getElementById("wbackgroundsuccess");
var dlgsuccess = document.getElementById("dlgboxsuccess");
/************************************* afficher popup success *******************************************/
$(document).ready(function(){
    $("#showsuccess").click(function(){
        if (dlgsuccess==null || wbsuccess==null) {
            alert("Null");
        }else{
            wbsuccess.style.display="block";
            dlgsuccess.style.display="block";
            var winWidth =window.innerWidth;
            var winHeight=window.innerHeight;
            
            dlgsuccess.style.left=(winWidth/2) - 480/2 +"px";
            dlgsuccess.style.top= "225px";
        }
    });
});

/************************************* fermer popup success *******************************************/
$(document).ready(function(){
    $("#closesuccess").click(function(){
        if (dlgsuccess==null || wbsuccess==null) {
            alert("Null");
        }else{
            wbsuccess.style.display="none";
            dlgsuccess.style.display="none";
        }
    });
});








