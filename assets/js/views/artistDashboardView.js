var app = app || {};

ArtistDashboardView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#artist-dashboard').html());
	},
	events : {
		'click .js-upload'     : 'uploadTrack',
		'click .addContact'    : 'addContact',
		'click .js-settings'   : 'settings',
	},
	/*
	 * Upload a track.
	 */
	uploadTrack : function(){
		$('.upload-form').show();
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
		console.log('Settings man');
	}
});
