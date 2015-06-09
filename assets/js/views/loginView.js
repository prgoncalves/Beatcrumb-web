var app = app || {};

LoginView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#login-form').html());
	},
	events :{
		'submit .artist-signup-form' : 'submit',		
	},
	submit : function(){
		var that = this;
		var username = $('#username').val();
		var passwd = $('#password').val();
		passwd = CryptoJS.MD5(passwd);
		passwd = passwd.toString(CryptoJS.enc.Hex);
		// lets do the call
		$.ajax({
			method : 'post',
			data : {
				'username' : username,
				'password' : passwd
			},
			dataType: "json",
			url : "/api/r/user/login" 
		}).done(function(data){
			if (data.Status == 'OK'){
				// reload data
				app.beatboxCollection.fetch({reset : true});
				app.genreCollection.fetch({reset : true});
				app.contactsCollection.fetch({reset : true});
				// populate the model
				app.user = new User(data.Result);
				if (typeof(Storage) !== 'undefined'){
					localStorage.setItem('Beat_User',JSON.stringify(app.user));
					app.user = JSON.parse(localStorage.getItem('Beat_User'));
				}
				
				// redirect
				app.appRouter.navigate('/dashboard',true);
			} else {
				// or show error message
				app.alert('Login failed...');
			}
		});
		return false;
	}
});
