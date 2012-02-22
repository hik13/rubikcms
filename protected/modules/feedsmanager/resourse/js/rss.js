$(function(){
    getRssForm($("#RSS_feeds"));
    $("#RSS_feeds").change(function () {
        getRssForm(this);
    })
    function getRssForm(rss_div){
        var id=$(rss_div).val();
        $.ajax({
            type: "POST",
            url: "/management/feedsmanager/feedsrss/rss/id/"+id,
            success: function(data){
                $(".rss_description").html(data);
                firstSetValue();
            }
        });
     }
     function firstSetValue(){
        var number=$('#rss_desc').val();
        if(number!=''){
            $('select#RSS_desc option[value='+number+']').attr('selected','selected');
        }
        $('#rss_desc').val('');
     }
    
});
