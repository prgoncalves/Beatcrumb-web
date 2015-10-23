var app = app || {};

BeatboxView = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
			tracks   : '',
		};
		var content = _.template($('#beatbox').html(),data);
		this.$el.html(content);
	},
	events : {
	},
	initialise : function(){
    	_.bindAll(this,"getTracks");
    	app.pubSub.bind('beatboxTracks',this.getTracks);
	},
	getTracks : function(){
	},
	showTracks : function(tracks){
		if (app.discoverTracks){
			app.discoverTracks.undelegateEvents();
			app.discoverTracks.unbind();
			app.discoverTracks = null;
		}
		app.discoverTracks = new DiscoverTracks();
		app.discoverTracks.parent = 'beatbox';
		app.discoverTracks.tracks = tracks;
		app.discoverTracks.render();
		app.discoverTracks.initialise();
        $('.release-form').css( "max-width", "0px" );		
	}
});
