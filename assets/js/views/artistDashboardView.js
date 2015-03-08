var app = app || {};

ArtistDashboardView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#artist-dashboard').html());
	}
});
