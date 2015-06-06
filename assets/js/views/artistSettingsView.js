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
		'click .js-edit-contact'   : 'editContact',
	},
	addContact : function(ev){
		if (!app.addContact){
			app.addContact = new ContactView();
		}
		app.addContact.parentView = this;
		app.addContact.render();	
	},
	deleteContact : function (ev){
		var that = this;
		var sure = confirm('Are you sure you wish to delete this user?');
		if (sure){
			var id = $(ev.target).data('id');
			$.ajax({
				url : 'api/r/contacts/delete?id='+id,
				success:function(){
					app.contactsCollection.fetch({
						reset : true,
						success : function(){
							app.message('Contact Deleted');
							that.render();										
						}
					});
				}
			});
		}
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
		var image = $('input[name="fileInput"]')[0].files[0];
		var frmData = new FormData();
		frmData.append('image',image);
		frmData.append('email',$('.change-profile input[name="email"]').val());
		frmData.append('artist_name',$('.change-profile input[name="artist_name"]').val());
		$.ajax({
		    url: 'api/r/user/settings',
		    data: frmData,
		    cache: false,
		    dataType : 'json',
		    contentType: false,
		    processData: false,
		    type: 'POST',
		    success: function(Result){
		    	if (Result.Status == 'OK'){
					app.message('Profile updated');
					app.user.user = Result.Result;
		    	} else if (Result.Status == 'ERR'){
		    		app.alert('Profile update failed.');
		    	} else if (Result.Status == 'LOG'){
					app.appRouter.navigate('/login',true);			    		
		    		app.alert('You have been logged out');
		    	}
		    },
		    error: function(data){
		      app.alert('File upload failed');
		    }
	 });
		return false;
	}
});