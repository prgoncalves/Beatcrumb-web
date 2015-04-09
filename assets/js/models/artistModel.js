var app = app || {};
Artist = Backbone.Model.extend({
	initialize : function(){
		this.on("invalid",function(model,error){
		    app.artistSetup.showErrors(error);
		});
        },
	parse : function (resp){
		if (resp.Status == 'LOG'){
			app.appRouter.navigate('/login',true);			
		} else {
			resp = resp.Result;
			return resp;			
		}
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
