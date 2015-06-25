var app = app || {};

DiscoverTracks = Backbone.View.extend({
	el : '#discover-right',
	render : function(){
		var data = {
			tracks : this.tracks,
			contacts : app.contacts.attributes
		};
		var content = _.template($('#discover-tracks').html(),data);
		this.$el.html(content);
	},
	events : {
		'click .shareTrack' : 'showShareDialog',
	},
	showShareDialog : function(ev){
		var target = $(ev.target);
		track = $(target).data('id');
		// remove active crumb from all
		$('.discover-crumb').removeClass('active_crumb');
		$(target).addClass('active-crumb');
		// show contacts........
		$('.release-form').show();
		$('.fans-scroll').show();		
	}
});