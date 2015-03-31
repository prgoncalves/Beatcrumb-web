var app = app || {};
deferGenre = $.Deferred();
GenreCollection = Backbone.Collection.extend({
	model : Genre,
	url : '/api/r/genre/list_items',
});
app.genreCollection = new GenreCollection();
app.genreCollection.on('reset',function(){
	app.genres = app.genreCollection.pop();
	deferGenre.resolve('loaded');
});
app.genreCollection.fetch({reset : true});

