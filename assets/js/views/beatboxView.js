var app = app || {};

BeatboxView = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
			tracks   : '',
		};
		var content = _.template($('#beatbox').html(),data);
		this.$el.html(content);
		$('.header-page-active').html('beatbox');
	},
	events : {
	},

	playMP3 : function (e){
		e.preventDefault();
        var container = $(e.target).parent();
        var crumb = $(container).children('.fan-crumb');
        $('.fan-crumb').removeClass('active-crumb');
        $(crumb.addClass('active-crumb'));
		var track = $(e.target).attr("href");
		var mySoundObject = soundManager.createSound({
			 url: track,
			 autoPlay: true,
                         
			 whileloading: function() { console.log(this.id + ' is loading'); }
		});
		return false;
	},
	getTracks : function(){
	},
});
