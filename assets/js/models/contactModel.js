var app = app || {};
Contact = Backbone.Model.extend({
	parse : function (resp){
		if (resp.Status == 'LOG'){
			app.logout();		
		} else {
			return resp.Result;			
		}
	},
});
