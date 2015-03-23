var app = app || {};

ForgottenPasswordView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#forgottenPassword').html());
	},
	events : {
		'submit .forgotten-password-form' : 'submit',		
	},
	submit : function(){
    	data = {
            email:$('.forgotten-password-form input[name="email"]').val(),    			
    		type:$('.forgotten-password-form select[name="type"]').val()
        };
    	$.ajax({
    		data : data,
    		dataType : "json",
    		url : '/api/r/user/forgottenPassword'
    	}).success(function(data){
			if (data.Result == true ){
				app.message('Email sent with new password');
			} else {
				app.alert('Error setting new password');
			}				    		
    	}).error(function(){
			app.alert('Error setting new password');    		
    	});
    	return false;
	}
});
