var app = app || {};
ArtistTrack = Backbone.Model.extend({
	parse : function (resp){
		resp = resp.Result;
		if (resp.Status == 'LOG'){
			app.appRouter.navigate('/login',true);			
		} else {
			return resp;			
		}
	},
});
