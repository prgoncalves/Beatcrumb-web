var app = app || {};
ArtistTrack = Backbone.Model.extend({
	parse : function (resp){
		resp = resp.Result;
		return resp;
	},
});
