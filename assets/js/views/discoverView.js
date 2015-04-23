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
	events : {
		'click .genre-item' : 'findGenre'
	},
	findGenre : function(e){
		console.log($(e.target).data('id'));
		this.showTracks();
	},
	showTracks : function(){
		if (!app.discoverTracks){
			app.discoverTracks = new DiscoverTracks();
		}
		app.discoverTracks.render();					
	}
});