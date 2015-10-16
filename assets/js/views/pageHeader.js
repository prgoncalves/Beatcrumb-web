var app = app || {};

PageHeader = Backbone.View.extend({
	el : '#pageHeader',
	render : function(){
		this.$el.html($('#page-header').html());
	},
	events : {
		'click .search-icon'     : 'doSearch',
		'click .header-discover' : 'discover',
		'click .header-beatbox'  : 'beatbox',
		'click .header-home'     : 'dashboard',
	},
	doSearch : function(){
    	data = {
                criteria:$('.js-Search').val(),    			
            };
        	$.ajax({
        		data : data,
        		dataType : "json",
        		url : '/api/r/search/search'
        	}).success(function(data){
    			if (data.Status == 'OK'){
    				if (!app.searchResults){
    					app.searchResults = new SearchResults();
    				}
    				app.searchResults.tracks = data.Result.tracks;
    				app.searchResults.artists = data.Result.artists;
    				app.searchResults.initialize();
    				app.searchResults.render();
    				
    				app.message('Results ');
    			} else {
    				app.alert('Unable to find any results');
    			}				    		
        	}).error(function(){
    			app.alert('Unable to find any results');    		
        	});
	},
	dashboard : function(){
		app.appRouter.navigate('/dashboard',true);
	},
	discover : function(){
		app.appRouter.navigate('/discover',true);
	},
	beatbox : function(){
		app.appRouter.navigate('/beatbox',true);
	}
});