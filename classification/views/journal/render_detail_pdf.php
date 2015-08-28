<style type="text/css">
		<!--

		.tbold {
			font-weight: bold;
		} 
		
		
		td {
		  padding:5px; 
		  word-wrap:break-word;
		} 
		
		th {
		  padding:4px; 
		} 
		
		table {
			table-layout:fixed;
		} 
		
		
		
		-->
		</style>
 
          
		  <table cellspacing="3px" style="margin:20px;max-width: 100%; solid;position: relative;">
              <tr>
				<td class="tbold" width="100px;">Title</td><td><?php echo "title"; ?></td>
              </tr>
              <tr>
				<td class="tbold">Dicipline</td><td><?php echo "title"; ?></td>
              </tr>
			  <tr>
				<td class="tbold">Author</td><td><?php echo "title"; ?></td>
              </tr>
			   <tr >
				<td class="tbold">Year Evaluate</td><td><?php echo "title"; ?></td>
              </tr>
			   <tr>
				<td class="tbold">Form</td><td><?php echo "title"; ?></td>
              </tr>
			  <tr>
				<td class="tbold">Score</td><td><?php echo "title"; ?></td>
              </tr>
			   <tr>
				<td class="tbold">Level</td><td><?php echo "title"; ?></td>
              </tr>
				
			 </table>
		  
		  
		 
            
            <table cellspacing="3px" style="width: 100%; border:1px solid;margin:20px;" class="table-list">
         
			   <tr bgcolor="#999999">
					<th>Criteria.</th>
					<th>Score</th>
					<th>Remarks</th>
				</tr>
	
                <?php for($x = 0; $x < 10 ; $x++){?>
				  <tr bgcolor="#E6E6E6">
					<td style="width: 45%; text-align: left;"><?php echo "criteria".$x ?>xxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxx</td>
					<td style="width: 10%; "><?php echo "score".$x ?></td>
					<td style="width: 40%; text-align: left;"><?php echo "remark".$x ?></td>
				  </tr>
				<?php }?>
     
            </table>
 


            


