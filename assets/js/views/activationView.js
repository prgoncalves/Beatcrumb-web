var app = app || {};

ActivationView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#activation-required').html());
	},
}
