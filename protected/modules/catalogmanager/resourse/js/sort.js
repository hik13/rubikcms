
$(function(){

    $(".sortable").sortable({
        axis:"y",
        connectWith: ".sortable",
        delay:300,
        dropOnEmpty:true,
        //  handle:".tabledrag-handle",
        helper: "clone",
        placeholder: "place-holder",
        scroll:"false",
        tolerance: "pointer",
        zIndex:10000,
        //forceHelperSize: true ,
        //forcePlaceholderSize: true ,
        

        start:function(event, ui) {
            parent_start_ul=ui.item.parents("ul:first");
            group_start_ul=ui.item.parents("ul.parameter_area");
        },
        
        sort: function (event,ui) {
        //     
        },
        
        update: function(event, ui) {
        //   
        }, 
        
        beforeStop: function(event, ui) {
            parent_stop_ul_bf=ui.item.parents("ul:first");  
            val=parent_stop_ul_bf.parents(".parameter:first").find(".work_type").attr("value"); 
            if (val==1) {
                if (parent_stop_ul_bf.hasClass("parent_parametr_area")){
                    $(this).sortable('cancel');  
                }
            }
        },
        
        stop:function(event, ui) { 
            function setOrder(object) {
                var qwery="";
                object.children("li").each(function (i) {
                    qwery=qwery+$(this).attr("id")+'|';
                })
                size=$('.neworderinput').size();
                if ($('.neworderinput[id=ul'+object.attr("id")+']').size()>0) {
                    $('.neworderinput[id=ul'+object.attr("id")+']').attr("value",qwery);
                }
                else {
                    object.parents("form").append(
                        '<input type="hidden" id="ul'+object.attr("id")+'" class="neworderinput" name="NewOrder['+size+'][Parameter]" value="'+qwery+'" />'
                        )
                }
            }
            
            function changeGroup(start_ul,stop_ul,item) {
                if (stop_ul.attr("id")!=start_ul.attr("id")) {
                    alert(stop_ul.attr("class"));
                    item.find(".group_parameter_id").val(stop_ul.parents(".catalog-group-li").find(".group_id").attr("value"));
                    setOrder(start_ul);
                    setOrder(stop_ul);
                    return true 
                } else {
                    return false;
                } 
            }
            
            function setValueParameter(item,work_id,parent_id,start_pul,stop_pul) {
                if (work_id==2){
                    if (item.find(".joint_parameter_id:first").attr("value")!=parent_id) {
                        item.find(".joint_parameter_id:first").attr("value",parent_id); 
                        item.find(".slave_parameter_id:first").attr("value","");
                        setOrder(start_pul);
                    }
                    setOrder(stop_pul);
                } else if (work_id==3){
                    if (item.find(".slave_parameter_id:first").attr("value")!=parent_id) {
                        item.find(".slave_parameter_id:first").attr("value",parent_id); 
                        item.find(".joint_parameter_id:first").attr("value","");
                        setOrder(start_pul);
                        loadSelect(item)
                    }  
                    setOrder(stop_pul);
                } else { 
                    if (start_pul.attr("id")!=stop_pul.attr("id")) {
                        setOrder(start_pul);   
                        setOrder(stop_pul);
                    }
                    item.find(".joint_parameter_id:first").attr("value",""); 
                    item.find(".slave_parameter_id:first").attr("value",""); 
                }
            }
            
            function analyzItem(item,start_pul,stop_pul) {
                if (stop_pul.hasClass("parent_parametr_area")) {
                    work_id=stop_pul.parents(".parameter:first").find(".work_type").attr("value");   
                    setValueParameter(item,work_id,stop_pul.attr("id"),start_pul,stop_pul)   
                } else {
                    setValueParameter(item,0,0,start_pul,stop_pul);   
                }
            }
            parent_stop_ul=ui.item.parents("ul:first");
            group_stop_ul=ui.item.parents("ul.parameter_area");
         
            changeGroup(group_start_ul,group_stop_ul,ui.item);
            analyzItem(ui.item,parent_start_ul,parent_stop_ul);
        }
    });
    
    $(".sortable_group").sortable({
        axis:"y",
        delay:300,
        dropOnEmpty:true,
        //  handle:".tabledrag-handle",
        helper: "clone",
        placeholder: "place-holder",
        scroll:"false",
        tolerance: "pointer",
        zIndex:10000,
        stop:function(event, ui) { 
            set_group=ui.item.parents(".sortable_group").children();
            var qwery="";
            set_group.each(function (i) {
                qwery=qwery+$(this).find(".group_id").attr("value")+'|';
            })
            size=$('.neworderinput').size();
            if ($('.neworderinput[id=group_order]').size()>0) {
                $('.neworderinput[id=group_order]').attr("value",qwery);
            }
            else {
                ui.item.parents("form").append(
                    '<input type="hidden" id="group_order" class="neworderinput" name="NewOrder['+size+'][Group]" value="'+qwery+'" />'
                    )
            }
        }
    });
    
    
})