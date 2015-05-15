var app = app || {};

ArtistDashboardView = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
			tracks   : this.tracks[0].attributes,
			genres   : app.genres.attributes,
			contacts : app.contacts.attributes
		};
		var content = _.template($('#artist-dashboard').html(),data);
		this.$el.html(content);
		$('.header-page-active').html('home');
	},
	events : {
		'click .addContact'    : 'addContact',
		'change #fileInput'	   : 'fileSelected',
		'click .js-saveFile'   : 'fileUpload',
		'click .js-upload'	   : 'showUpload',
		'click .js-shareMe'    : 'shareMP3',
		'click .js-ReleaseToMe': 'shareWith',
		'click .js-doRelease'  : 'doShare'
	},

	doShare : function(){
		var contacts = [];
		$('.ShareWithMe').each(function(){
//			console.log($(this));
			contacts.push($(this).data('id'));
		});
		if (contacts.length > 0){
			var data = {
					track : this.trackId,
					contacts : contacts,
					message : 'Enjoy this new track'
				}
			console.log(data);
			$.ajax({
			    url: 'api/r/tracks/share',
			    data: data,
			    dataType : 'json',
			    success: function(Result){
			    	switch(Result.Status){
			    		case 'OK'  : app.message('Worked');break;
			    		case 'ERR' : app.alert('Share Failed');break;
			    		case 'LOG' : app.appRouter.navigate('/login',true);
			    	}
			    	
			    	if (Result.Status == 'ERR'){
				    	app.alert('Shared failed');			    		
			    	}
			    	app.message('Worked');
			    },
			    error: function(data){
			    	app.alert('Shared failed');
			    }
		 });
		}
	},
	
	shareMP3 : function (e){
		e.preventDefault();
		var container = $(e.target).parent();
		var crumb = $(container).children('.fan-crumb');
		this.trackId = $(container).data('id');
		$('.fan-crumb').removeClass('active-crumb');
		$(crumb.addClass('active-crumb'));
		$(e.target).addClass('ShareMe');
	},
	
	shareWith : function(e){
		e.preventDefault();
		var container = $(e.target).closest('.fan-info');
		console.log(container);
		var crumb = $(container).children('.fan-crumb');
		$(crumb.addClass('active-crumb'));
		$(container).addClass('ShareWithMe');
	},
//	playMP3 : function (e){
//		e.preventDefault();
//        var container = $(e.target).parent();
//        var crumb = $(container).children('.fan-crumb');
//        $('.fan-crumb').removeClass('active-crumb');
//        $(crumb.addClass('active-crumb'));
//		var track = $(e.target).attr("href");
//		var mySoundObject = soundManager.createSound({
//			 url: track,
//			 autoPlay: true,
//                         
//			 whileloading: function() { console.log(this.id + ' is loading'); }
//		});
//		return false;
//	},
	/*
	 * File has been selected
	 */
	fileSelected : function(e){
		var fileName = $(e.target).val();
		if (fileName.search('.mp3') > 0){
			//show save button.
			$('.uploadSave').show();			
		} else {
			$(e.target).val('');
			app.alert('Sorry we only allow MP3 file uploads.');
		}
	},
	fileUpload : function(e){
		var that = this;
		var track = $('input[name="fileInput"]')[0].files[0]; 
		var data = new FormData();
		data.append('track', track);
		data.append('genre',$('.upload-form select[name="genre"]').val() );
		$.ajax({
			    url: 'api/r/artist/upload',
			    data: data,
			    cache: false,
			    dataType : 'json',
			    contentType: false,
			    processData: false,
			    type: 'POST',
			    success: function(Result){
			    	if (Result.Status == 'OK'){
			    		app.message('File upload worked');
						that.getTracks();		
			    	} else if (Result.Status == 'ERR'){
			    		app.alert('File upload failed.');
			    	} else if (Result.Status == 'LOG'){
			    		app.alert('You have been logged out');
						app.appRouter.navigate('/login',true);			    		
			    	}
			    },
			    error: function(data){
			      app.alert('File upload failed');
			    }
		 });
	},
	getTracks : function(){
		app.artistTrackCollection.fetch({
			success:function(){
				app.artistDashboard.tracks = app.artistTrackCollection.models;
				app.artistDashboard.render();		
			},
			error:function(){
				app.artistDashboard.render();
				app.alert('Unable to load artist tracks');
			}
		});						
	},
	/*
	 * Adding a new contact
	 */
	addContact : function(){
		
	},
	showUpload : function(){
		$('.upload-form').show();
	},
});
