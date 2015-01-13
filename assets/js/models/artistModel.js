var app = app || {};
Artist = Backbone.Model.extend({
	initialize : function(){
		this.on("invalid",function(model,error){
		    alert(error);
		});
        },
	parse : function (resp){
		resp = resp.Result;
		return resp;
	},
	validate:function(attrs,options){
		var error;
		return error;
	},

});
