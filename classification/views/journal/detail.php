<style type="text/css">
		<!--

		
		.tbold {
			font-weight: bold;
		} 
		 ;
		-->
		</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
      <tr>
        <td height="30">
          <a href="#">Home</a> &gt; Journal Detail
        </td>                                             
      </tr>
      <tr>
        <td height="30" background="images/tajukpanjang750.png">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fontWhiteBold">Journal Detail</span>
        </td>
      </tr>
      <tr>
        <td valign="top" >
          
		  <table cellspacing="3px" style="margin-top:20px;max-width: 100%; solid;position: relative;">
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
		  
          <div style="float:left;width:100%;text-align:right">
              Export to:
			  <select id="exportOption" >
			    <option>-</option>
                <option value="pdf">PDF</option>
                <option value="excel">Excel</option>
              </select> 
			<input type="button" id="btnExport" value="Export"/>
			
          </div>
		  
          <div>
            
            <table width="100%" class="table-list" style="padding-top:10px">
              <tr>
					<th>Criteria.</th>
					<th>Score</th>
					<th>Remarks</th>
				</tr>
				<?php for($x = 0; $x < 10 ; $x++){?>
				  <tr>
					<td><?php echo "criteria".$x ?></td>
					<td><?php echo "score".$x ?></td>
					<td><?php echo "remark".$x ?></td>
				  </tr>
				<?php }?>
            </table>
          </div>
        </td>
      </tr>
   </tbody>
</table>
<form id="downloadPDF" action="PDF/journal_detail_pdf.php"></form>
<form id="downloadExcel" action="Excel/journal_detail_excel.php"></form>

<script>
$('#btnExport').click(function() {
		
		var exportOption = $('#exportOption').find(":selected").text()
		if(exportOption == "PDF"){
			form = $('#downloadPDF');
			form.submit();			
		}
		else if(exportOption == "Excel"){
			form = $('#downloadExcel');
			form.submit();
		}
		else{
			//Do nothing
		}
})
</script>