<html>
<body style="margin: 0; padding: 0;">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td>
				<table align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;border:outset #99CC00 4.5pt">
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
						 <table cellpadding="0" cellspacing="0" width="100%">
						  <tr>
						  	<td>
						  		<p style='mso-margin-top-alt:auto;text-align:center'><img src="http://beta.fitzos.com/images/beatcrumblogo-u108-fr.png" /></p>
						  	</td>
						  </tr>
						  <tr>
						   <td style="padding: 20px 0 20px 0;">
						   	Dear <?php if (isset($data->name)) { echo $data->name; } else { echo 'Beatcrumber'; } ?>  
						   </td>
						  </tr>
						  <tr>
						   <td>
							<p><?=isset($artist->artist_name) ? $artist->artist_name : $artist->username ?> is sharing a beatcrumb with you. <a href="http://beta.fitzos.com/activation/contacts/<?php echo $data->contact_uuid;?>#activation">Join beatcrumb now to hear the latest and greatest independent music.</a></p>
							</td>
						  </tr>
						  <tr>
						  	<td>
								<p>Beatcrumb is the only artist curated music messaging platform designed for independent musicians to message music directly to their fans in a personal, convenient and engaging way.</p>						  	
						  	</td>
						  </tr>
						  <tr>
						  	<td>
								<p>Regards</p>						  	
						  	</td>
						  </tr>
						  </tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>