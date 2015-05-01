var app = app || {};

ArtistSettingsView = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
			contacts : app.contacts.attributes,
			settings : app.settings.attributes
		};
		var content = _.template($('#artistSettings').html(),data);
		this.$el.html(content);
		$('.header-page-active').html('settings');
	},
	events : {
		'click .js-saveProfile'    : 'saveProfile',
		'click .js-add-contact'    : 'addContact',
		'click .js-delete-contact' : 'deleteContact',
		'click .js-edit-contact'   : 'editContact'
	},
	addContact : function(ev){
		console.log('add');
		if (!app.addContact){
			app.addContact = new ContactView();
		}
		app.addContact.parentView = this;
		app.addContact.render();	
	},
	deleteContact : function (ev){
		console.log('delete');
		
	},
	editContact : function(ev){
		var id = $(ev.target).data('id');
		var contacts = app.contacts.attributes;
		var result = $.grep(Object.keys(contacts), function(e){
			return contacts[e].id == id;
		 });
		if (!app.addContact){
			app.addContact = new ContactView();
		}
		app.addContact.model = contacts[result];
		app.addContact.parentView = this;
		app.addContact.render();			
	},
	saveProfile : function(ev){
		ev.preventDefault();
		var update = new Setting(app.settings.attributes);
		update.set({
			email : $('.change-profile input[name="email"]').val(),
			artist_name : $('.change-profile input[name="artist_name"]').val() 
		});
		update.url = app.settingsCollection.url;
		update.save(update.attributes,{
			success : function(data){
				app.message('Profile updated');
			},
			error   : function(){
				app.alert('Unable to update profile!');
			}
		});
		return false;
	}
});