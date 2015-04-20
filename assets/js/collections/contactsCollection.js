var app = app || {};
deferContacts = $.Deferred();
ContactsCollection = Backbone.Collection.extend({
	model : Contact,
	url : '/api/r/contacts/getContactsForUUID',
});
app.contactsCollection = new ContactsCollection();
app.contactsCollection.on('reset',function(){
	deferContacts.resolve('loaded');
});
app.contactsCollection.fetch({reset : true});

