<?php 

// include notes
include('include/notes.php');

// get notes
$notesOutput = getNotes($user_id);

?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left">
			<form name="notesForm" style="margin:0px; padding:0px;" onSubmit="saveNotes();return false;">
				<textarea name="notesInput" id="notesInput" cols="22" rows="5"><?php echo $notesOutput; ?></textarea>
				<input name="notesSave" id="notesSave" value="save" type="submit">
			</form>
		</td>
	</tr>
</table>