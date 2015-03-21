var app = app || {};

ArtistCollection = Backbone.Collection.extend({
	model : Artist,
	url : '/api/rest/artist',
	addArtist: function(elements, options) {
             return this.add(elements, options);
        }
});
app.artistCollection = new ArtistCollection();
