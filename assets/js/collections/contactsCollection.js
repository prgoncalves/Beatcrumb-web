var app = app || {};

ContactsCollection = Backbone.Collection.extend({
	model : Contact,
	url : '/api/rest/contacts',
});
app.contactsCollection = new ContactsCollection();
