var app = app || {};

ShareActivationView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#shareActivation').html());
	},
	events : {
		'click .activateShare' : 'activate',
		'click .alreadyShare'  : 'already',
	},
	activate : function(event){
		if (this.validate()){
			// get the data
			var passwd = $('.js-activationForm input[name="password"]').val();
			passwd = CryptoJS.MD5(passwd);
			passwd = passwd.toString(CryptoJS.enc.Hex);			
			data = {
				'username' : $('.js-activationForm input[name="username"]').val(),
				'password' : passwd,
			};
			$.ajax({
			    url: '/activation/activator',
			    data: data,
			    method: 'post',
			    dataType : 'json',
			    success: function(Result){
			    	switch(Result.Status){
		    			case 'OK'  : 
		    				app.message('Worked');
		    				app.user = new User(data.Result);
		    				if (typeof(Storage) !== 'undefined'){
		    					localStorage.setItem('Beat_User',JSON.stringify(app.user));
		    					app.user = JSON.parse(localStorage.getItem('Beat_User'));
		    				}
		    				// redirect
//		    				app.appRouter.navigate('/dashboard',true);
		    				document.location.href('/')
		    				break;
		    			case 'ERR' : app.alert('Activation Failed please try again later');break;
			    	}
			    },
			    error: function(data){
			    	app.alert('Activation Failed please try again later');
			    }
			});
			return false;
		} else {
			return false;
		}
	},
	already : function(event){
		if (this.validate()){
			// get the data
			var passwd = $('.js-activationForm input[name="password"]').val();
			passwd = CryptoJS.MD5(passwd);
			passwd = passwd.toString(CryptoJS.enc.Hex);			
			data = {
				'username' : $('.js-activationForm input[name="username"]').val(),
				'password' : passwd,
			};
			$.ajax({
			    url: '/activation/memberAlready',
			    data: data,
			    method: 'post',
			    dataType : 'json',
			    success: function(Result){
			    	switch(Result.Status){
			    		case 'OK'  : 
			    			app.message('Worked');
		    				document.location.href('/')
		    				break;
			    		case 'ERR' : app.alert('Failed');break;
			    	}
			    },
			    error: function(data){
			    	app.alert('Failed');
			    }
			});
			return false;
		} else {
			return false;
		}
	},
	validate : function(){
		result = true;
		if ($('.js-activationForm input[name="username"]').val()){
			$('.js-activationForm input[name="username"]').removeClass('error');			
		} else {
			$('.js-activationForm input[name="username"]').addClass('error');
			result = false;
		}
		if ($('.js-activationForm input[name="password"]').val()){
			$('.js-activationForm input[name="password"]').removeClass('error');
		} else {
			$('.js-activationForm input[name="password"]').addClass('error');
			result = false;
		}
		return result;		
	}
});
