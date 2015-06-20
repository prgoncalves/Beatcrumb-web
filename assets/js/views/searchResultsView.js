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
		 autoPlay: false,
         onload: function(bSuccess){
        	 playable = bSuccess;
         }            
	});
	if (playable){
		mySoundObject.play();
	} else {
		app.alert('You do not have permission to play that track!');
	}
	return false;
},
	
});