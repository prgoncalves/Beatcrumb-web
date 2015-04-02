var app = app || {};

PageHeader = Backbone.View.extend({
	el : '#pageHeader',
	render : function(){
		console.log('Rendering header!');
		this.$el.html($('#page-header').html());
	},
	events : {
		'click .search-icon' : 'doSearch',
	},
	doSearch : function(){
		console.log('Doing search!');
		app.alert('Search not yet implemented!');
	}
});