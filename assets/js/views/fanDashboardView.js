var app = app || {};

FanDashboardView = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
				contacts : app.contacts.attributes
		};
		this.$el.html(_.template($('#fan-dashboard').html(),data));
	}
});
