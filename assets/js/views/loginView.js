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
		console.log('Yay');
		return false;
	}
});
