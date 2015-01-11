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
		return false;
	},
});
