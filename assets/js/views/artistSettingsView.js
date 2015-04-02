var app = app || {};

ArtistSettingsView = Backbone.View.extend({
	el : '#app',
	render : function(){
		console.log('Rendering!');
		this.$el.html($('#artistSettings').html());
	},
	events : {
	},
});