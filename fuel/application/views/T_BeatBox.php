<script id="beatbox" type="text/template">
  <div class="landing-page-wrapper">
    <div class="main-container">
		<div class="beatbox">
<<<<<<< Updated upstream
			<% if (typeof app.availableInbox != 'undefined' && app.availableInbox.length > 0){
				_.each(app.availableInbox, function(value) { console.log(value);%>
				<div class="beatbox-track" data-track="<%=value.filename%>">
					<h2 class="beatbox-artist-name"><%=value.artist_name%></h2>
					<div class="beatbox-track-name"><%=value.filename%></div>
					<div class="beatbox-listens"><%=value.plays%></div>
					<div class="beatbox-shares"><%=value.shares%></div>
					<div class="beatbox-message"><%=value.message%></div>
=======
			<%_.each(app.availableInbox, function(value) { console.log(value);%>
				<div class="beatbox-track">
>>>>>>> Stashed changes
					<%if (value.image){%>
						<div class="artist-mini-picture">
							<img src="assets/<%=value.image%>" />
						</div>
					<%}%> 
                                        <div class="beatbox-message"><%=value.message%></div>
					<!--<h2 class="beatbox-artist-name"><%=value.artist_name%></h2>-->
					<div class="beatbox-track-name"><%=value.filename%></div>
					<div class="beatbox-listens"><%=value.plays%></div>
					<div class="beatbox-shares"><%=value.shares%></div>
					
					<div class="beatbox-single-crumb">
				   		<div class="beatbox-crumb active-crumb"></div>
					</div>
					<div class="beatbox-three-crumb">
                		<div class="three-crumb-one"></div>
                    	<div class="three-crumb-two"></div>
                    	<div class="three-crumb-three"></div>
                	</div>
				</div>
			<% });
			} else {%>
				<h3>You have no tracks shared at the moment</h3>
			<%}%>											
		</div>
	</div>
  </div>
</script>