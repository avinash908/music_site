$(document).ready(function(){
		$("#login-form").on('submit',function(e){
			e.preventDefault();
			$.ajax({
				url:"server.php",
				method:"POST",
				data: new FormData(this),
				contentType:false,
				cache:false,
				processData:false,
				success:function(data){
					if(data=="login"){
						setTimeout("window.location.href = 'index.php' ",100);
					}else{
						$("#msg").html(data);
					}
				}
			})
		})
	})