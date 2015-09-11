<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
      <tr>
        <td height="30">
          <a href="#">Home</a> &gt; <a href="#">List of Criteria</a> &gt; Evaluate
        </td>                                             
      </tr>
      <tr>
        <td height="30" background="images/tajukpanjang750.png">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fontWhiteBold">List of Criteria</span>
        </td>
      </tr>
      <tr>
        <td valign="top" style="padding:20px">
          <div>
            <table width="100%">
              <tr>
                <td colspan="3">
                  <table width="100%" class="table-list" style="padding-top:10px">
                    <tr>
                      <th></th>
                      <th>Criteria</th>
                      <th>Type</th>
                      <th width="30%">Answer</th>
                      <th width="80px">Action</th>
                    </tr>
                    <tr class="section">
                      <td></td>
                      <td colspan="4">Wajib</td>
                    </tr>
                    <?php $i = 0  ?>
                    <?php foreach ($compulsory as $row): ?>
                    <tr>
                      <td><?php echo ++$i ?></td>
                      <td><p><?php echo $row['criteria_name'] ?></p></td>
                      <td><?php echo $row['criteria_type'] ?></td>
                      <td>
                        <ul style="padding-left:20px">
                        <?php 
						foreach ($choice as $choiceRow): ?>
                         <?php if($choiceRow['criteria_id'] == $row['id']) { ?>
						  <li><?php echo $choiceRow['choice_name'] ?></li>
						  <?php } endforeach ?>
                        </ul>
                      </td>
                      <td>
                        <center>
							<a href="#" class="edit_criteria_mandatory" id="edit_<?php echo $row['id'] ?>">Edit</a> | 
                        <a href="#">Delete</a>
                        </center>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr class="section">
                      <td></td>
                      <td colspan="4">Optional</td>
                    </tr>
                    <?php foreach ($optional as $row): ?>
                    <tr>
                      <td><?php echo ++$i ?></td>
                      <td><p><?php echo $row['criteria_name'] ?></p></td>
                      <td><?php echo $row['criteria_type'] ?></td>
                      <td>
                        <ul style="padding-left:20px">
                        <?php 
						foreach ($choice as $choiceRow): ?>
                         <?php if($choiceRow['criteria_id'] == $row['id']) { ?>
						  <li><?php echo $choiceRow['choice_name'] ?></li>
						  <?php } endforeach ?>
                        </ul>
                      </td>
                      <td>
                        <center>
						<a href="#" class="edit_criteria_optional" id="edit_<?php echo $row['id'] ?>">Edit</a> | 
                        <a href="#">Delete</a>
                        </center>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </table>
                </td>
              </tr>
            </table>
            
          </div>
        </td>
      </tr>
   </tbody>
</table>
<script>

	$('.edit_criteria_mandatory').click(function(){
		
		var data = this.id;
		var arr = data.split('_');
		var classificationID = arr[1];
		
		window.location.replace("/myjurnal/classification_add_criteria.php?e=true&id="+classificationID+"");
	});
	
	$('.edit_criteria_optional').click(function(){
		
		var data = this.id;
		var arr = data.split('_');
		var classificationID = arr[1];
		
		window.location.replace("/myjurnal/classification_add_criteria.php?e=true&id="+classificationID+"");
	});
	
	
	
</script>