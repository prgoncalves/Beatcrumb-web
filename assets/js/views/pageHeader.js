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
	discover : function(){
		app.appRouter.navigate('/discover',true);
	}
});