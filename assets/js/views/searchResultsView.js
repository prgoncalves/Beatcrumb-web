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
		 url: track,
		 autoPlay: true,
                     
		 whileloading: function() { console.log(this.id + ' is loading'); }
	});
	return false;
},
	
});