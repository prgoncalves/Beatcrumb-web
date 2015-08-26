var app = app || {};

SearchResults = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
			tracks : this.tracks,
			artists : this.artists,
			contacts : app.contacts.attributes
		};
		var content = _.template($('#search-results').html(),data);
		this.$el.html(content);
		this.showTracks(this.tracks);
	},
	showTracks : function(tracks){
		if (app.discoverTracks){
			app.discoverTracks.undelegateEvents();
			app.discoverTracks.unbind();
			app.discoverTracks = null;
		}
		app.discoverTracks = new DiscoverTracks();
		app.discoverTracks.tracks = tracks;
		app.discoverTracks.render();					
		$('.release-form').hide();
		$('.fans-scroll').hide();
	}

});
