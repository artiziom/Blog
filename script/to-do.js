$(document).ready(function(){
    let colours = Array("color1", "color2", "color3", "color4", "color5", "color6");
    let slowa;
    $("#add").click(function(){
        let stickynote = '<li class="note" id="'+colours[Math.floor(Math.random()*colours.length)]+'"><div class="delete">X</div><b><h1>'+$("#topic").val()+'</h1></b>'
        if($("#chkbox").is(":checked")){
            slowa = $("#content").val().split("~");
            console.log(slowa);
            for(let i = 0; i<slowa.length; i++){
                stickynote+='<h3><input type="checkbox" class="itemcheck">'+slowa[i]+'</h3>';
                console.log(slowa[i]);
            }
            $("#chkbox").prop('checked', false);
        }
        else{
            stickynote+='<h3>'+$("#content").val()+'</h3>'
        }
        stickynote+='</li>';
        $('.stickynotes').append(stickynote);
        $('#topic').val("");
        $('#content').val("");
    });    
    $(document).on("click", ".delete", function(){
        $(this).parent().remove();
    });
    $(document).on("click", ".itemcheck", function(){
        if($(this).is(":checked"))
            $(this).parent().css("text-decoration", "line-through");
        else
            $(this).parent().css("text-decoration", "none");
    });
});