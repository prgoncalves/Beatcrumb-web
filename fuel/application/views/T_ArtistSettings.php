<script id="artistSettings" type="text/template">
  <div class="landing-page-wrapper">
    <div class="main-container">
		<div class="settings-contacts">
			<%_.each(contacts,function(value) { %>
            	<div class="fan-block">
                	<div class="fan-info">
                    	<div class="fan-mini-picture">
                        	<img src="<%=value.image%>"/>
                        </div>
                        <h5 class="fan-name"><%=value.name%>-<%=value.email%></h5>
						<button class='js-edit-contact'>Edit</button>
						<button class='js-delete-contact'>Delete</button>
                    </div>
					<button class='js-add-contact'>Add contact</button>
                </div>
			<% }); %>	
		</div>
		<div class="settings-profile">
			<form class='change-profile'>
				<label>Email Address</labeL>
				<input type='text' name='email' value="<%=settings.email%>"/>
				<label>Artist Name</label>
				<input type='text' name='artist_name' value="<%=settings.artist_name%>"/>
				<button class='js-saveProfile'>Save</button>
			</form>
		</div>
		<div class="messages js-messages"></div>
   		<div class="alerts js-alerts"></div>
		<p><a href="#logout">Logout</a></p>
    </div>
  </div>
</script>