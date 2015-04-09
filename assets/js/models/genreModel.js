var app = app || {};
Genre = Backbone.Model.extend({
	parse : function (resp){
		if (resp.Status == 'LOG'){
			app.appRouter.navigate('/login',true);			
		} else {
			return resp.Result;			
		}
	},
});
