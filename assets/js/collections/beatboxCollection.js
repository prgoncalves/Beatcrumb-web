var app = app || {};
deferBeatbox = $.Deferred();
BeatboxCollection = Backbone.Collection.extend({
	model : Track,
	url : '/api/r/tracks/inbox',
});
app.beatboxCollection = new BeatboxCollection();
app.beatboxCollection.on('reset',function(){
	deferBeatbox.resolve('loaded');
	app.availableInbox = app.beatboxCollection.models[0].attributes.available;
	app.notAvailableInbox = app.beatboxCollection.models[0].attributes.notAvailable;	
});
  
