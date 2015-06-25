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
		if (!app.discoverTracks){
			app.discoverTracks = new DiscoverTracks();
		}
		app.discoverTracks.tracks = tracks;
		app.discoverTracks.render();					
		$('.release-form').hide();
		$('.fans-scroll').hide();
	}
});