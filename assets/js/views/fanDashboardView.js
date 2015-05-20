var app = app || {};

FanDashboardView = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {};
		this.$el.html(_.template($('#fan-dashboard').html(),data));
	}
});
