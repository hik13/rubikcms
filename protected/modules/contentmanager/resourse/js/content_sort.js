$(function(){
    
    //".site-structure-column"
    var changePaddingTd = function(object) {
        var   paddinglevel=40
        var   vloj=object.parents("ul:first").attr("rel");
        var   paddingnow=vloj*paddinglevel>0?vloj*paddinglevel:10;
        
        object.find(".site-structure-column:first").css("padding-left",paddingnow)
        object.find(".ul_sort").attr("rel",vloj*1+1)
        object.find(".ul_sort > li").each(function() {
            changePaddingTd($(this))
        }); 
    }
    

    var changeWidthPlaceholder = function(object) {
        var   paddinglevel=40
        var   vloj=object.parents("ul:first").attr("rel");
        var   paddingnow=vloj*paddinglevel>0?vloj*paddinglevel:10;
        object.css("margin-left",paddingnow); 
    }
    

    //fix bug with li-replasment in IE 
    $('.ul_sort').bind('mousedown', function(e) {
        e.stopPropagation();
    }); 


    $(".ul_sort").sortable({
        axis:"y",
        connectWith: ".connectedSortable",
        delay:300,
        dropOnEmpty:true,
        handle:".tabledrag-handle",
        helper: "clone",
        placeholder: "place-holder",
        scroll:"false",
        tolerance: "pointer",
        zIndex:10000,
 

        start:function(event, ui) {
            startul=ui.item.parents("ul:first");
            ui.helper.find(".ul_sort:first").css("display","none");
        },
        
        sort: function (event,ui) {
            changeWidthPlaceholder(ui.placeholder)
        },
        
        update: function(event, ui) {
            changePaddingTd(ui.item)
        }, 
        
        beforeStop: function(event, ui) {
            ui.helper.removeClass("drag-item-active");
        },
        
        stop:function(event, ui) { 
            function setOrder(object) {
                var qwery="";
                object.children().each(function (i) {
                    qwery=qwery+$(this).attr("id")+'|';
                })
                if ($('.neworderinput[id=ul'+object.attr("id")+']').size()>0) {
                    $('.neworderinput[id=ul'+object.attr("id")+']').attr("value",qwery);
                }
                else {
                    $("#content_form").append(
                        '<input type="hidden" id="ul'+object.attr("id")+'" class="neworderinput" name="NewOrder['+object.attr("id")+']" value="'+qwery+'" />'
                        )
                }
            }
             
            $(".module-action-buttons li:hidden").css("display","block");
           
            stopul=ui.item.parents("ul:first");
            if (stopul.hasClass("empty-tree-list")) {
                stopul.removeClass("empty-tree-list")
                changeClass("simple","opened",stopul.parents("li:first").find(".status:first"),"block");
            }
            if (startul.find("li").size()==0) {
                startul.addClass("empty-tree-list");
                changeClass("opened","simple", startul.parents("li:first").find(".status:first"),"block");
            }
            if (stopul.attr("id")!=startul.attr("id")) {
                i=$("#content_form").find(".newparentinput").size()+1;
                if ($('.newchildinput[value='+ui.item.find("ul").attr("id")+']').size()>0) {
                    $('.newchildinput[value='+ui.item.find("ul").attr("id")+']').prev(".newparentinput").attr("value",stopul.attr("id"));
                } else {
                    $("#content_form").append(
                        '<input type="hidden" class="newparentinput" name="NewParent['+i+'][parentId]" value="'+stopul.attr("id")+'" />'
                        + '<input type="hidden" class="newchildinput" name="NewParent['+i+'][childId]" value="'+ui.item.attr("id")+'"/>'
                        )
                }
                setOrder(stopul);
                setOrder(startul);
            } else {
                setOrder(stopul);
            }
        }
    });
})
