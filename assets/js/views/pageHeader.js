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
		'click .header-homr'     : 'dashboard',
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