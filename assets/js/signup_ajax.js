$(document).ready(function(){
    $("#signup-form").on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url:"server.php",
            method:"POST",
            data: new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                if(data=="signup"){
                    setTimeout("window.location.href = 'profile.php' ",100);
                }else{
                    $("#msg").html(data);
                }
            }
        })
    })
})