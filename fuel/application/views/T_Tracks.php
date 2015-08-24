<script id="tracks-list" type="text/template">
		<% _.each(tracks, function(value) { %>
                <div class="discover-block">
			<div class="artist-mini-picture">
		    	<img src="assets/<%=value.image%>"/>
			</div>
			<h2 class="discover-artist-name"><%=value.artist_name%></h2>
			<div class="discover-track-name"><%=value.filename%></div>
			<div class="discover-listens"><%=value.plays%>
            	<img src="assets/images/ear.png"/>
            </div>
			<div class="discover-single-crumb">
				<a class="playTrack" href="tracks/play/<%=value.id%>/<%=value.uuid%>">
			    <div data-id="<%=value.id%>" class="discover-crumb shareTrack"></div></a>
			</div>
			<div class="discover-three-crumb">
                            <div class="three-crumb-one"></div>
                            <div class="three-crumb-two"></div>
                            <div class="three-crumb-three"></div>
                        </div>
                </div>
		<% }); %>
				<div class="release-form">
  					<label>Message</label>
					<input id="shareMessage" plaecholder="Message to send with share" value="" type="text" name="messageInput">
					<button class="js-doShare">Send</button>
				</div>
                <div class="fans-scroll">
                    <div class="scroll-inner">
						<%_.each(contacts,function(value) { %>
                        <div class="fan-block">
                            <div class="fan-info js-ReleaseToMe" data-id="<%=value.id%>">
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
</script>
<script id="tracks-empty" type="text/template">
	<h3>There are no tracks for that Genre!</h3>
</script>