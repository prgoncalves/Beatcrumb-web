<?php
$link = 'https://accounts.google.com/o/oauth2/auth?client_id=';
$client_id='970479616026-84836s24nbai4h7n2ddpr6rt23gshbde.apps.googleusercontent.com';
$redirect_uri='https://beta.fitzos.com/oauth2callback';
$link = $link . $client_id . '&redirect_uri='.$redirect_uri .'&scope=https://www.google.com/m8/feeds/&response_type=code';

?>
<script id="fanSettings" type="text/template">
  <div class="landing-page-wrapper">
	<div class="messages js-messages"></div>
   	<div class="alerts js-alerts"></div>
    <div class="main-container">
		<div class="settings-contacts">
			<%_.each(contacts,function(value) { %>
            	<div class="fan-block">
                	<div class="fan-info">
                    	<div class="fan-mini-picture">
                        	<img src="<%=value.image%>"/>
                        </div>
                        <h5 class="fan-name"><%=value.name%>-<%=value.email%></h5>

						<button class='js-delete-contact' data-id="<%=value.id%>">Delete</button>
                        <button class='js-edit-contact' data-id="<%=value.id%>">Edit</button>
                    </div>
                </div>
			<% }); %>
			<button class='js-add-contact'>Add contact</button>
			<% if (app.user.email.indexOf("gmail") >-1) { %>
				<a href="<?php echo($link);?>">Import GMAIL Contacts</a>
			<% } %>
		</div>
		<div class="settings-profile">
			<form class='change-profile'>
				<h2>Change profile settings!</h2>
				<label>Email Address</labeL>
				<input type='text' name='email' value="<%=settings.email%>"/>
				<label>Upload Profile Image</label>
  				<input id="fileInput" value="Upload" type="file" name="fileInput">
				<button class='js-saveProfile'>Save</button>
			</form>
		</div>
		<div id="form"></div>
		<p><a href="#logout">Logout</a></p>
    </div>
  </div>
</script>