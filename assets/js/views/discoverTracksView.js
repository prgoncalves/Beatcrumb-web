var app = app || {};

DiscoverTracks = Backbone.View.extend({
	el : '#discover-right',
	render : function(){
		var data = {
		};
		var content = _.template($('#discover-tracks').html(),data);
		this.$el.html(content);
	},
	events : {
	},
});