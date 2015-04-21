<script id="artist-dashboard" type="text/template">
  <div class="landing-page-wrapper">
    <div class="main-container">

    <div class="messages js-messages"></div>
    <div class="alerts js-alerts"></div>
        <div class="artist-profile">

            <div class="artist-profile-left">
                <div class="artist-name"><h1 class="artist-header"><%=app.user.artist_name%></h1></div>
                <div class="artist-picture">
                    <img src="/images/noelleartist-u388-fr.png"/>
                </div>
				
            </div>
            <div class="artist-profile-right">
				<span class='js-upload'>Upload</span>
				<div class="upload-form">
  					Upload Track&hellip; <input id="fileInput" value="Upload" type="file" name="fileInput">
					<select name="genre">
						<% _.each(genres, function(value) { %>
							<option value="<%=value.id%>"><%=value.name%></option>
						<% }); %>											
					</select>
					<button class="js-saveFile uploadSave">Save</button>
				</div>
				<div class="uploaded-tracks">
					<% _.each(tracks, function(value) { %>
						<div class="uploaded-track"><a href="tracks/index/<%=value.filename%>" class="js-playMe"><%=value.filename%></a> <div class="fan-crumb">
                                   
                                </div></div>
					<% }); %>					
				</div>
                               
            </div>
    
            <div class="scroll-container">
                <h4 class="release">release</h4>
                <div class="fans-scroll">
                    <div class="scroll-inner">
						<%_.each(contacts,function(value) { %>
                        <div class="fan-block">
                            <div class="fan-info">
                                <div class="fan-mini-picture">
                                    <img src="<%=value.image%><"/>
                                </div>
                                <h5 class="fan-name"><%=value.name%></h5>
                                <div class="fan-crumb">
                                </div>
                            </div>
                        </div>
						<% }); %>					                    

                    </div>
                </div>
   
            </div>
        
            
        <div class="browser_width colelem" id="u148-5-bw">
            <div class="clearfix" id="u148-5"><!-- content -->
                <p>&nbsp;</p>
                <div class="copyright-container">
                    <p><span id="u148-2">Beatcrumb Inc 2014</span></p>
                </div>
     
            </div>
        </div>
     </div>
  </div>
</script>
