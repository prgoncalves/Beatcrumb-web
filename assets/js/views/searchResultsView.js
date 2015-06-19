var app = app || {};

SearchResults = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
			tracks : this.tracks,
			artists : this.artists
		};
		var content = _.template($('#search-results').html(),data);
		this.$el.html(content);
	},
	events : {
	},
});