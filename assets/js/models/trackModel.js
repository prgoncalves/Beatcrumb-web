var app = app || {};
Track = Backbone.Model.extend({
	parse : function (resp){
		if (resp.Status == 'LOG'){
			app.logout();		
		} else {
			resp = resp.Result;
			return resp;			
		}
	},
});
