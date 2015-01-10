var app = app || {};

LoginView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$e1.html($('#login-form').html());
	}
});
