var app = app || {};

DiscoverTracks = Backbone.View.extend({
	el : '#discover-right',
	render : function(){
		var data = {
			tracks : this.tracks,
			contacts : app.contacts.attributes
		};
		if (this.tracks.length > 0){
			var content = _.template($('#tracks-list').html(),data);			
		} else {
			var content = _.template($('#tracks-empty').html());						
		}
		this.$el.html(content);
	},
	events : {
		'click .shareTrack'    : 'showShareDialog',
		'click .js-doShare'    : 'shareTrack',
		'click .js-ReleaseToMe': 'shareWith',
		'click .playTrack'     : 'playMP3'
	},
	initialise : function(){
		this.myScroll = new IScroll('.fans-scroll', {
		    mouseWheel: true,
		    click:true,
		});	
//		document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
	},
	showShareDialog : function(ev){
		var target = $(ev.target);
		this.trackId = $(target).data('id');
		// remove active crumb from all
		$('.discover-crumb').removeClass('active_crumb');
		$(target).children().addClass('active-crumb');
		// show contacts........
       $('.release-form').css( "max-width", "500px" );
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
	playMP3 : function (e){
		e.preventDefault();
		var track = $(e.target).parent().attr("href");
		if (this.mySoundObject && this.mySoundObject.playState === 1){
			// we are playing at the moment so go away
			app.alert('A track is already playing.. Please wait!');
		} else {
			this.mySoundObject = soundManager.createSound({
				 id : 'foundTrack',
				 url: track,
		         onload: function(bSuccess){
		        	if (!bSuccess){
		        		app.alert('You cannot currently play that track!');
		        	}
		         },
		         onfinish : function(){
		        	 this.destruct();
		         }
				});
			this.mySoundObject.play();			
		}
	return false;
	},

	
});
