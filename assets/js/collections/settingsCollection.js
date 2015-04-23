var app = app || {};
deferSettings = $.Deferred();
SettingsCollection = Backbone.Collection.extend({
	model : Setting,
	url : '/api/r/user/settings',
});
app.settingsCollection = new SettingsCollection();
app.settingsCollection.on('reset',function(){
	app.settings = app.settingsCollection.pop();
	deferSettings.resolve('loaded');
});
app.settingsCollection.fetch({reset : true});
