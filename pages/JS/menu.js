

/************************************************************************ menu ***********************************************************************************/
$(document).ready(function(){                
        $("#title_alias").text('"APRIORI" Algorithm');
        //notification(autoMin);
});

var slided;
var SlideLIs;

$(document).ready(function(){  
	     
	
    $("#MatrixJShow").click(function(){
        if(!slided){
                $(".MatrixJob").slideDown();
                slided=true;
        }else{
                $(".MatrixJob").slideUp();
                slided=false;
        }
       
        
    });
	
	$("#ShowLIS").click(function(){
        if(!SlideLIs){
                $(".ShowLIs").slideDown();
                SlideLIs=true;
        }else{
                $(".ShowLIs").slideUp();
                SlideLIs=false;
        }
       
        
    });
});

function ShowAUtoMinsup(autoMin){         
        $("#LabelAutominsup").html("Auto-Min support ==> "+autoMin);
        $("#Autominsup").slideDown( 400 );
        $("#Autominsup").removeClass("hidden");
		if(autoMin==0){		
			$(".ShowLIs").slideUp();		
			$(".MatrixJob").slideUp();
		}else{
			$(".MatrixJob").slideDown();
			$(".ShowLIs").slideDown();
		}
}
