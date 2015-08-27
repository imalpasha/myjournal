
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
      <tr>
        <td height="30">
          <a href="#">Home</a> &gt; List of Journals
        </td>                                             
      </tr>
      <tr>
        <td height="30" background="images/tajukpanjang750.png">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fontWhiteBold">Journals with Classification</span>
        </td>
      </tr>
      <tr>
        <td valign="top" style="padding:20px">
          <div style="margin-bottom:20px">
            <div style="float:left;width:20%">
              Year 
              <select name="">
                <option>2015</option>
              </select>  
            </div>
            <div style="float:left;width:50%;text-align:center">
              Dicipline 
              <select name="">
                <option>All / Lorem ipsum dolor sit amet</option>
              </select>  
            </div>
            <div style="float:left;width:30%; text-align:right">
              Form Category 
              <select name="" id="form_category">
                <?php foreach($forms as $row): ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                <?php endforeach; ?>
              </select>  
              <br>
              <br>
              Full Mark: 100
              <br>
              <br>
            </div>  
          </div>
          <div style="width:100%;margin-bottom:90px">
            
            <div style="float:left;width:50%;">
              <form method="get" action="">
                <input type="text" name="j" placeholder=" Search Journal" size="40">
                <input type="submit" value="Search">
              </form>
            </div>
            <div style="float:left;width:50%;text-align:right">
              Export to:
			  <select id="exportOption" >
			    <option>-</option>
                <option value="pdf">PDF</option>
                <option value="excel">Excel</option>
              </select> 
			  
			<input type="button" id="btnExport" value="Export"/>
			
            </div>
            
          </div>
          <div>
            <div class="pagination"><?php echo $pagination ?></div>
            <table width="100%" class="table-list" style="padding-top:10px">
              <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Journal Title</th>
                <th colspan="4">Score</th>
                <th rowspan="2" width="120">Action</th>
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
              <tr class="section">
                  <td></td>
                  <td colspan="6">Tahap A<?php echo $section++ ?></td>
              </tr>
              <?php endif ?>
              <tr>
                <td><?php echo ++$i ?></td>
                <td><?php echo $journal['name'] ?></td>
                <td>10</td>
                <td>14</td>
                <td>23</td>
                <td>90</td>
                <td>
                  <center>
				   <a href="classification_journals_detail.php?id=<?php echo $journal['id'] ?>">Detail</a> | 

                  <a href="#">Edit</a> | 
                  <a href="#">Delete</a>
                  </center>
                </td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </td>
      </tr>
   </tbody>
</table>
<form id="downloadPDF" action="PDF/journal_list_pdf.php"></form>
<form id="downloadExcel" action="Excel/journal_list_excel.php"></form>
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