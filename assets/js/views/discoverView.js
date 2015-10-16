var app = app || {};

DiscoverView = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
			genres   : app.genres.attributes,
		};
		var content = _.template($('#discover-page').html(),data);
		this.$el.html(content);
		// get tracks with no genre
		this.getTracks(0);
		return this;
	},
	events : {
		'click .genre-item' : 'findGenre'
	},
	initialise : function(){
		this.myScroll = new IScroll('.discover-left', {
		    mouseWheel: true,
		    click:true,
		});	
		document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
    	_.bindAll(this,"refreshTracks");
    	app.pubSub.bind('discoverTracks',this.refreshTracks);
	},
	getTracks : function(id){
    	var data = {id:id};    			
		var that = this;
    	$.ajax({
    		data : data,
    		dataType : "json",
    		url : '/api/r/genre/getTracksForGenre'
    	}).success(function(data){
    		that.showTracks(data.Result);
    	}).error(function(){
			app.alert('Unable to get tracks for genre');    		
    	});		
	},
	findGenre : function(e){
		this.getTracks($(e.target).data('id'));
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
		app.discoverTracks.initialise();
		app.discoverTracks.parent = 'discover';
        $('.release-form').css( "max-width", "0px" );
	},
	refreshTracks : function(){
		this.getTracks(0);
	}
});