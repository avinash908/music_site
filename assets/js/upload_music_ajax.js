  $(document).ready(function(){
    $('#music-upload').on('submit',function(event){
      event.preventDefault();
      $('#uploading').show();
      if($('#music-file').val()){  
        $.ajax({
          xhr:function(){
            var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress',function(e){
                    if(e.lengthComputable){
                      var percent = Math.round((e.loaded / e.total) * 100);
                      $('#progress-bar').attr('aria-valuenow',percent).css('width',percent + '%').text(percent + '%');
                    }
                });
              return xhr;
          },
          url:'music_upload.php',
          method:'POST',
          data: new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          success:function(data){
            if(data == "uploaded"){
              if($("#progress-bar").text() == "100%"){
                $("#uploading").fadeOut("slow");
                swal("Music Uploaded"," ","success");           
                $("#output-img").attr('src','');
                $("#music-upload")[0].reset();
              }
            }else{
              $("#output").html(data);
            }
          }
        })
      }else{
        $("#output").html("<div class='alert alert-danger'>Please Select Music For Upload</div>");
      }
    })
  })