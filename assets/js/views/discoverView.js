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
		$(e.target).addClass('selected');
		var that = this;
    	data = {id:$(e.target).data('id')};    			
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
	showTracks : function(tracks){
		if (!app.discoverTracks){
			app.discoverTracks = new DiscoverTracks();
		}
		app.discoverTracks.tracks = tracks;
		app.discoverTracks.render();					
	}
});