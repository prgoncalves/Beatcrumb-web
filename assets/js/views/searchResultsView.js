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
		'click .playTrack' : 'playMP3'
	},
	playMP3 : function (e){
	e.preventDefault();
	var playable = true;
	var track = $(e.target).attr("href");
	var mySoundObject = soundManager.createSound({
		 id : 'foundTrack',
		 url: track,
		 autoPlay: true,
         onload: function(bSuccess){
        	 playable = bSuccess;
        	if (!playable){
        		app.alert('You cannot currently play that track!');
        	}
         }            
	});
	return false;
},
	
});