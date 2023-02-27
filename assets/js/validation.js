$(document).ready(function () {
	$("#signup").validate({
		rules:{
			username:{
				required:true,
				minlength:2
			},
			email:{
				required:true,
				email:true
			},
			password:{
				required:true,
				minlength:6
			},
			confirm_password:{
				required:true,
				minlength:6,
				equalTo:"#password"
			}
		},
		messages:{
			username:{
				required:"Please enter a username*",
				minlength:"Your username must be atleast 2 characters long"
			},
			email:{
				required:"Please enter your email address",
			},
			password:{
				required:"Please Provide a password*",
				minlength:"Your password must be atleast 6 characters long"
			},
			confirm_password:{
				required:"Please Provide a password*",
				minlength:"Your password must be atleast 6 characters long ",
				equalTo:"Please enter same password as above"
			}
		},

	})
})