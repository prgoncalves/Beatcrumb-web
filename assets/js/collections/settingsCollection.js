var app = app || {};

SettingsCollection = Backbone.Collection.extend({
	model : Setting,
	url : '/api/r/user/settings',
});
app.settingsCollection = new SettingsCollection();
