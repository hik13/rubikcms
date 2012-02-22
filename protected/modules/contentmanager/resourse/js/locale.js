$(function(){ 

    function showDomen(){
        z=$(".adress_version:checked").attr("value");  
        if (z==1) {
            $(".domen_input").parents(".form-row").css("display","none");
        } else {
            $(".domen_input").parents(".form-row").css("display","block"); 
        }
    }

    $(".adress_version").click(function(){
        showDomen(); 
    })
   
    showDomen();
   
})


