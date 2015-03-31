var app = app || {};
Genre = Backbone.Model.extend({
	parse : function (resp){
		resp = resp.Result;
		return resp;
	},
});
