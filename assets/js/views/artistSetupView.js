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
		console.log('Submit me');
		var artist = new Artist();
		artist.set('username',$('.artist-signup input[name="username"]').val());
		artist.set('email',$('.artist-signup input[name="email"]').val());
		artist.set('password',$('.artist-signup input[name="password"]').val());
		artist.set('artist_name',$('.artist-signup input[name="artist"]').val());
		if ($('#terms').is(':checked')){
			artist.set('terms',1);			
		} else {
			artist.set('terms',0);			
		}
		app.artistCollection.add(artist);
		artist.save();
		return false;
	},
});
