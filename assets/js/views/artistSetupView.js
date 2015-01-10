var app = app || {};

ArtistSetupView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#artist-setup-form').html());
	}
});
