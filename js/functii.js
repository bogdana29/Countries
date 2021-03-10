function cauta(){
        
    var regiune = $("#regiuni option:selected").val();
    $(".cls_country").addClass("hide");
    if(regiune==0)  $(".cls_country").removeClass("hide");
    else{
        if($("."+regiune).hasClass("hide")){
            $("."+regiune).removeClass("hide");
        }
    }
}