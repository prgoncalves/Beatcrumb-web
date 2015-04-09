var app = app || {};
ArtistTrack = Backbone.Model.extend({
	parse : function (resp){
		if (resp.Status == 'LOG'){
			app.appRouter.navigate('/login',true);			
		} else {
			resp = resp.Result;
			return resp;			
		}
	},
});
