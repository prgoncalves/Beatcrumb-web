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
		'click .beatbox-track' : 'playMP3'
	},

	playMP3 : function (e){
		e.preventDefault();
		var track = $(e.target).data("track");
		var mySoundObject = soundManager.createSound({
			 url: 'track/index/' + track,
			 autoPlay: true,
			 whileloading: function() {  }
		});
		return false;
	},
	getTracks : function(){
	},
});
