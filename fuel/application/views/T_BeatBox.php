<script id="beatbox" type="text/template">
  <div class="landing-page-wrapper">
    <div class="main-container">
		<div class="beatbox">
			<%_.each(app.availableInbox, function(value) { console.log(value);%>
				<%=value.artist_name%>
				<%=value.filename%>
				<%=value.plays%>
				<%=value.shares%>
				<%=value.message%>
				<%if (value.image){%>
					<div class="artist-mini-picture">
						<img src="assets/<%=value.image%>" />
					</div>
				<%}%> 
			<% }); %>											
		</div>
	</div>
  </div>
</script>