var app = app || {};

FanSetupView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#fan-setup-form').html());
	},
	events : {
		'submit .fan-signup-form' : 'submit'
	},
	submit : function(){
		var fan = new Fan();
		var that = this;
		fan.set('username',$('#username').val());
		fan.set('email',$('#email').val());
		var passwd = $('#password').val();
		passwd = CryptoJS.MD5(passwd);
		passwd = passwd.toString(CryptoJS.enc.Hex);
		fan.set('password',passwd);
		if ($('#terms').is(':checked')){
			fan.set('terms',1);			
		} else {
			fan.set('terms',0);			
		}
		app.fanCollection.addFan(fan);
		fan.save(fan.attributes,{
			success:function(model, response, options){
				if (response.Status == 'ERR'){
					alert('Username/Email is in use.');
				} else {
			        	app.appRouter.navigate('/activation', true);
				}
			},
			error:function(){
				alert('Error saving fan');
			}
		});
		return false;
	},
	showErrors: function(errors) {
	    _.each(errors, function (error) {
		var controlGroup = this.$('#' + error.name);
		controlGroup.addClass('error');
		controlGroup.find('.help-inline').text(error.message);
	    }, this);
	},
});

