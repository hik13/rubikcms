$(function(){
var letter=$("#activeLetter").attr("value");
z=$("a[rel='"+letter+"']");
z.replaceWith("<a class='active'>"+z.html()+"</a>");
})


