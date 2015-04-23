var app = app || {};

DiscoverView = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
			genres   : app.genres.attributes,
		};
		var content = _.template($('#discover-page').html(),data);
		this.$el.html(content);
		$('.header-page-active').html('discover');
	},
});