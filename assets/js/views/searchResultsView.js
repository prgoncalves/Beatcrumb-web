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
		var track = $(e.target).attr("href");
		var mySoundObject = soundManager.createSound({
		 id : 'foundTrack',
		 url: track,
         onload: function(bSuccess){
        	if (!bSuccess){
        		app.alert('You cannot currently play that track!');
        	}
         },
         onfinish : function(){
        	 this.destroy();
         }
		});
		mySoundObject.play();
	return false;
},
	
});