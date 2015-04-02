var app = app || {};

DiscoverView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#discover-page').html());
		$('.header-page-active').html('discover');
	},
});