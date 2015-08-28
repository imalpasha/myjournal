		<style type="text/css">
		<!--
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
		
		.tbold {
			font-weight: bold;
		} 
		
		
		-->
		</style>
		
		
		<table cellspacing="3px" style="margin:20px;max-width: 100%; solid;position: relative;">
             <tr>
			<td class="tbold" width="100px;">Year</td><td><?php echo "year"; ?></td>
             </tr>
            <tr>
			<td class="tbold">Dicipline</td><td><?php echo "dicipline"; ?></td>
              </tr>
			  <tr>
				<td class="tbold">Form Category</td><td><?php echo "form category"; ?></td>
              </tr>
		</table>
		
		
		
            <table cellspacing="3px" style="width: 100%; border:1px solid;margin:20px;" class="table-list">
              <tr bgcolor="#999999">
                <th rowspan="2">No.</th>
                <th rowspan="2" >Journal Title</th>
                <th colspan="4" align="center">Score</th>
               
              </tr>
              <tr>
                <th>Wajib</th>
                <th>Optional</th>
                <th>Total</th>
                <th>%</th>
              </tr>
              <?php $i = $offset ?>
              <?php $section = 1 ?>
              <?php foreach ($journals as $journal): ?>

              <?php if ($i % 10 == 0) : ?>
              <tr bgcolor="#FFDB4D">
                  <td></td>
                  <td colspan="6">Tahap A<?php echo $section++ ?></td>
              </tr>
              <?php endif ?>
              <tr bgcolor="#E6E6E6">
                <td><?php echo ++$i ?></td>
                <td style="width: 65%; text-align: left;"><?php echo $journal['name'] ?></td>
                <td>10</td>
                <td>14</td>
                <td>23</td>
                <td>90_</td>
                
              </tr>
              <?php endforeach; ?>
            </table>
	
    