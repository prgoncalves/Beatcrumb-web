var app = app || {};

LoginView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#login-form').html());
	}
});
