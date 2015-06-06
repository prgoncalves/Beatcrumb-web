var app = app || {};

ContactView = Backbone.View.extend({
	el : '#form',
	render : function (){
		if (this.model){
			var data = this.model
		} else {
			var data = [];			
		}
		var content = _.template($('#addContact').html(),data);
		this.$el.html(content);
	},
	events : {
		'click .js-saveContact' : 'saveContact'
	},
	saveContact : function(ev){
		ev.preventDefault();
		var newContact = new Contact();
		newContact.set({
			'email':$('.add-contact input[name="email"]').val(),
			'name': $('.add-contact input[name="name"]').val()
		});
		newContact.url = 'api/rest/contacts';
		newContact.save();
		app.contactsCollection.fetch({reset : true});
		if (this.parentView){
			this.parentView.render();
			app.message('Contact saved!');
		} else {
			app.appRouter.navigate('/artistSettings',true);			
		}
	}
});