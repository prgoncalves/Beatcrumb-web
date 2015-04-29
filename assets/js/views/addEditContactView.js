var app = app || {};

ContactView = Backbone.View.extend({
	el : '#form',
	render : function (){
		var data = [];
		var content = _.template($('#addContact').html(),data);
		this.$el.html(content);
	},
	events : {
		'click .js-saveContact' : 'saveContact'
	},
	saveContact : function(ev){
		ev.preventDefault();
		console.log('Save me save me');
		var newContact = new Contact();
		newContact.set({
			'email':$('.add-contact input[name="email"]').val(),
			'name': $('.add-contact input[name="name"]').val()
		});
		newContact.url = 'api/rest/contacts';
		newContact.save();
		app.appRouter.navigate('/artistSettings',true);
	}
});