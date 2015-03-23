<script id="artist-dashboard" type="text/template">
  <div class="landing-page-wrapper">
    <header>
        <div class="inner-header">
            <div class="header-logo">
                <img class="" src ="images/beatcrumblogolarge-u823-fr.png"/>
            </div>
            <div class="header-favourite">
                <img class="" src ="images/donation-list-u824-fr.png"/>
            </div>
            <div class="header-page-active">
                home
            </div>
            <div class="header-discover">
                discover
            </div>
            <div class="header-search">
                <input name="search" class="js-Search"></input>
            </div>
            <div class="header-settings">
                <img class="js-Settings" src ="images/settings-red-u828-fr.png"/>
            </div>
        </div>
    </header>
    <div class="main-container">
    <div class="messages js-messages"></div>
    <div class="alerts js-alerts"></div>
        <div class="artist-profile">
            <div class="artist-profile-left">
                <h1>Artist Dashboard</h1>
                <div class="artist-picture">
                </div>
				<div class="artist-name"><h1><%=app.user.artist_name%></h1></div>
            </div>
            <div class="artist-profile-right">
				<span class='js-upload'>Upload</span>
				<div class="upload-form">
  					Upload Track&hellip; <input id="fileInput" value="Upload" type="file" name="fileInput">
					<button class="js-saveFile uploadSave">Save</button>
				</div>
				<div class="uploaded-tracks">
				</div>
            </div>
        </div>
        
        <div class="fans-scroll">
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
