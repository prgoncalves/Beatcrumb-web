var app = app || {};

ForgottenPasswordView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#forgottenPassword').html());
	}
});
