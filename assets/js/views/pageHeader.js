var app = app || {};

PageHeader = Backbone.View.extend({
	el : '#pageHeader',
	render : function(){
		this.$el.html($('#page-header').html());
	},
	events : {
		'click .search-icon' : 'doSearch',
		'click .header-discover' : 'discover'
	},
	doSearch : function(){
		app.alert('Search not yet implemented!');
	},
	discover : function(){
		app.appRouter.navigate('/discover',true);
	}
});