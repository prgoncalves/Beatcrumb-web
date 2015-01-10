var app = app || {};

LandingView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#landing-page').html());
	}
});
