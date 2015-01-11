var app = app || {};

FanSetupView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#fan-setup-form').html());
	}
});

