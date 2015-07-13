var app = app || {};

SearchResults = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
			tracks : this.tracks,
			artists : this.artists,
			contacts : app.contacts.attributes
		};
		var content = _.template($('#search-results').html(),data);
		this.$el.html(content);
	},
	events : {
		'click .playTrack'     : 'playMP3',
		'click .shareTrack'    : 'showShareDialog',
		'click .js-doShare'    : 'shareTrack',
		'click .js-ReleaseToMe': 'shareWith',
	},
	playMP3 : function (e){
		e.preventDefault();
		var track = $(e.target).attr("href");
		var mySoundObject = soundManager.createSound({
		 id : 'foundTrack',
		 url: track,
         onload: function(bSuccess){
        	if (!bSuccess){
        		app.alert('You cannot currently play that track!');
        	}
         },
         onfinish : function(){
         }
		});
		mySoundObject.play();
	return false;
	},
	showShareDialog : function(ev){
		var target = $(ev.target);
		this.trackId = $(target).data('id');
		// remove active crumb from all
		$('.discover-crumb').removeClass('active_crumb');
		$(target).addClass('active-crumb');
		// show contacts........
		$('.release-form').show();
		$('.fans-scroll').show();		
	},
	shareTrack : function(ev){
		var contacts = [];
		$('.ShareWithMe').each(function(){
			contacts.push($(this).data('id'));
		});	
		if ($('#shareMessage').val().length > 0){
			if (contacts.length > 0){
				var data = {
						track    : this.trackId,
						contacts : contacts,
						message  : $('#shareMessage').val()
					}
				$.ajax({
				    url: 'api/r/tracks/share',
				    data: data,
				    dataType : 'json',
				    success: function(Result){
				    	switch(Result.Status){
				    		case 'OK'  : 
				    			app.message('Your tracks have been shared.');
				    			$('.release-form').hide();
				    			$('.fans-scroll').hide();
				    			$("div").removeClass('ShareMe');
				    			$("div").removeClass('active-crumb');			    			
				    			break;
				    		case 'ERR' : app.alert('Share Failed');break;
				    		case 'LOG' : app.appRouter.navigate('/login',true);
				    	}
				    	
				    	if (Result.Status == 'ERR'){
					    	app.alert('Shared failed');			    		
				    	}
				    },
				    error: function(data){
				    	app.alert('Shared failed');
				    }
			 });
			} else {
				app.alert('Please select some contacts to share this track with!');
			}			
		} else {
			app.alert('Please add a message for sharing this track!');			
		}
		
	},
	shareWith : function(e){
		e.preventDefault();
		var container = $(e.target).closest('.fan-info');
		var crumb = $(container).children('.fan-crumb');
		if ($(crumb).hasClass('active-crumb')){
			$(crumb.removeClass('active-crumb'));
		} else {
			$(crumb.addClass('active-crumb'));			
		}
		if ($(container).hasClass('ShareWithMe')){
			$(container).removeClass('ShareWithMe');						
		} else {
			$(container).addClass('ShareWithMe');			
		}
	},
	
});