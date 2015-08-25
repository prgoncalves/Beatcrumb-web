<script id="search-results" type="text/template">
    <div class="messages js-messages"></div>
    <div class="alerts js-alerts"></div>
	<div class="searchBlock">
	      <div class="searchArtists">
	      	<% _.each(artists, function(value) { %>
	      		<p><%=value.artist_name%></p>
	      	<% }); %>
	      </div>
	      <div class="searchTracks">
	      </div>
				<div class="release-form">
  					<label>Message</label>
					<input id="shareMessage" plaecholder="Message to send with share" value="" type="text" name="messageInput">
					<button class="js-doShare">Send</button>
				</div>
                
	</div>
</script>