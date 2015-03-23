var app = app || {};

ArtistDashboardView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html(_.template($('#artist-dashboard').html()));
	},
	events : {
		'click .addContact'    : 'addContact',
		'click .js-Settings'   : 'settings',
		'change #fileInput'	   : 'fileSelected',
		'click .js-saveFile'   : 'fileUpload',
		'click .js-upload'	   : 'showUpload',
	},
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
		data.append('uuid',app.user.uuid);
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
			    		that.render();		
			    	} else {
			    		app.alert('File upload failed.');
			    	}
			    },
			    error: function(data){
			      app.alert('no upload');
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
	/*
	 * This will be used for setting profile image/password etc
	 */
	settings : function(){
		console.log('Settings man');
	}
});
