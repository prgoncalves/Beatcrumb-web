<script id="addContact" type="text/template">
	<div class="settings-profile">
		<form class='add-contact'>
			<% if (typeof email !== 'undefined') { %>
				<h2>Edit Contact</h2>
			<% } else { %>
				<h2>Add Contact</h2>
			<% } %>
			<label>Email Address</labeL>
			<input type='text' name='email' value="<%if (typeof email !== 'undefined'){%><%=email%><%}%>"/>
			<label>Contact Name</label>
			<input type='text' name='name' value=""/>
			<button class='js-saveContact'>Save</button>
		</form>
	</div>
</script>