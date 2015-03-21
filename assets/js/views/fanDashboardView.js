var app = app || {};

FanDashboardView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#fan-dashboard').html());
	}
});
