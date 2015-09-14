<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td height="30">
				<a href="#">Home</a>
				&gt; <a href="classification_evaluated_journals.php">List of Journals</a>
				&gt; Journal Detail
			</td>
		</tr>
		<tr>
			<td height="30" background="images/tajukpanjang750.png">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fontWhiteBold">Journal Detail</span>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<table cellspacing="3px" style="margin-top:20px;max-width: 100%; solid;position: relative;">
					<tr>
						<td class="tbold" width="100px;">Title</td><td><?php echo $journal['journal_name']; ?></td>
					</tr>
					<tr>
						<td class="tbold">Dicipline</td><td><?php echo $disciplineTitle; ?></td>
					</tr>
					<tr>
						<td class="tbold">Publisher</td><td><?php echo $journal['publisher']; ?></td>
					</tr>
					<tr>
						<td class="tbold">Year Evaluate</td><td><?php echo $journal['year']; ?></td>
					</tr>
					<tr>
						<td class="tbold">Form</td>
						<td>
							<form id="qform" action="" method="get">
								<input type="hidden" name="evaluation_id" value="<?php echo $evaluation_id ?>">
								<select class="qselect" name="form">
									<?php foreach($forms as $row): ?>
										<option value="<?php echo $row['id'] ?>" <?php echo $_GET['form'] == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
									<?php endforeach; ?>
								</select>
							</form>
						</td>
					</tr>
					<tr>
						<td class="tbold">Score</td><td><?php echo $journal['totalMarks'] . ' / ' . $fullMarks . ' (' . round(($journal['totalMarks'] / $fullMarks) * 100, 2) . '%)'; ?></td>
					</tr>
					<tr>
						<td class="tbold">Level</td><td><?php echo "-"; ?></td>
					</tr>

				</table>

				<div style="float:left;width:100%;text-align:right">
					Export to:
					<select id="exportOption" >
						<option value="pdf">PDF</option>
						<option value="excel">Excel</option>
					</select>
					<input type="button" id="btnExport" value="Export"/>

				</div>

				<div>

					<table width="100%" class="table-list" style="padding-top:10px">
						<tr>
							<th></th>
							<th width="60%">Criteria</th>
							<th>Choice</th>
							<th>Score</th>
							<th>Remarks</th>
						</tr>
						<?php $i = 0 ?>
						<?php foreach ($journal['resultList'] as $row): ?>
							<tr>
								<td><?php echo ++$i ?></td>
								<td><?php echo $row['criteria_name'] ?></td>
								<td><?php echo $row['choice_name'] ?></td>
								<td><?php echo $row['marks'] ?></td>
								<td><?php echo $row['remarks'] ?></td>
							</tr>
						<?php endforeach ?>
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

	$('.qselect').change(function() {
		$(this).parent().submit();
	})
	</script>
