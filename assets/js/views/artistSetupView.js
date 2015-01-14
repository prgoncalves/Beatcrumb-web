var app = app || {};

ArtistSetupView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#artist-setup-form').html());
	},
	events : {
		'submit .artist-signup' : 'submit',
	},
	
	'submit' : function() {
		var artist = new Artist();
		var that = this;
		artist.set('username',$('#username').val());
		artist.set('email',$('#email').val());
		artist.set('password',$('#password').val());
		artist.set('artist_name',$('#artist').val());
		if ($('#terms').is(':checked')){
			artist.set('terms',1);			
		} else {
			artist.set('terms',0);			
		}
		app.artistCollection.add(artist);
		artist.save();
		return false;
	},
	showErrors: function(errors) {
	    _.each(errors, function (error) {
		var controlGroup = this.$('#' + error.name);
		controlGroup.addClass('error');
		controlGroup.find('.help-inline').text(error.message);
	    }, this);
	},

});
