var app = app || {};

FavouritesView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#favourites-page').html());
		$('.header-page-active').html('favourites');
	},
});