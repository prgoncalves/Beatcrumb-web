var app = app || {};

ArtistTracksCollection = Backbone.Collection.extend({
	model : ArtistTrack,
	url : '/api/r/artist/tracks',
});
app.artistTrackCollection = new ArtistTracksCollection();
