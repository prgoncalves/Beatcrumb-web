var app = app || {};

ArtistDashboardView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#artist-dashboard').html());
	},
	events : {
		'click .js-upload'  : 'uploadTrack',
		'click .addContact' : 'addContact',
		'click .settings'   : 'settings',
	},
	/*
	 * Upload a track.
	 */
	uploadTrack : function(){
		
	},
	/*
	 * Adding a new contact
	 */
	addContact : function(){
		
	},
	/*
	 * This will be used for setting profile image/password etc
	 */
	settings : function(){
		
	}
});
