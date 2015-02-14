var app = app || {};
Fan = Backbone.Model.extend({
	initialize : function(){
		this.on("invalid",function(model,error){
		    app.fanSetup.showErrors(error);
		});
        },
	parse : function (resp){
		resp = resp.Result;
		return resp;
	},
	validate:function(attrs,options){
		var errors = [];
		   if (!attrs.email) {
		   	   errors.push({name: 'email', message: 'Please fill email field.'});
		   }
		   if (!attrs.username) {
		   	   errors.push({name: 'username', message: 'Please fill username field.'});
		   }
		   if (!attrs.terms) {
		   	   errors.push({name: 'terms', message: 'Please accept our terms.'});
		   }
		return errors.length > 0 ? errors : false;
	},
});