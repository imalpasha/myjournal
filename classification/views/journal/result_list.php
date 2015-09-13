
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
                    <form id="form-search" method="get" action="">
                    <div style="float:left;width:20%">
                        Year
                        <select  class="qselect" name="year">
                            <option value="<?php echo (date('Y') - 1) ?>" <?php echo $_GET['year'] == (date('Y') - 1) ? 'selected' : '' ?> ><?php echo (date('Y') - 1) ?></option>
                            <option value="<?php echo date('Y') ?>"  <?php echo $_GET['year'] == date('Y') ? 'selected' : '' ?> ><?php echo date('Y') ?></option>
                            <option value="<?php echo (date('Y') + 1) ?>"  <?php echo $_GET['year'] == (date('Y') + 1) ? 'selected' : '' ?> ><?php echo (date('Y') + 1) ?></option>
                        </select>
                    </div>
                    <div style="float:left;width:50%;text-align:center">
                        Dicipline
                        <select class="qselect" name="discipline">
                            <option value="">All</option>
                            <?php foreach($disciplines as $row): ?>
                                <option value="<?php echo $row['id'] ?>" <?php echo $_GET['discipline'] == $row['id'] ? 'selected' : '' ?>><?php echo $row['dis_desc'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div style="float:left;width:30%; text-align:right">
                        Form Category
                        <select class="qselect" name="form">
                            <?php foreach($forms as $row): ?>
                                <option value="<?php echo $row['id'] ?>" <?php echo $_GET['form'] == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <br>
                        Full Mark: <?php echo $fullMarks; ?>
                        <br>
                        <br>
                    </div>
                </div>
                <div style="width:100%;margin-bottom:90px">
                    <div style="float:left;width:50%;">
                        <input type="text" name="search" placeholder=" Search Journal" size="40" value="<?php echo $_GET['search'] ?>">
                        <input type="submit" value="Search">
                    </div>
                    </form>
                    <div style="float:left;width:50%;text-align:right">
                        Export to:
                        <select id="exportOption" >
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
                        <tr class="section">
                            <td></td>
                            <td colspan="6">Tahap Unknown<?php echo $section++ ?></td>
                        </tr>
                        <?php foreach ($journals as $journal): ?>
                            <tr>
                                <td><?php echo ++$i ?></td>
                                <td><?php echo $journal['name'] ?></td>
                                <td><?php echo $journal['compulsory'] ?></td>
                                <td><?php echo $journal['optional'] ?></td>
                                <td><?php echo $journal['totalMarks'] ?></td>
                                <td><?php echo round(($journal['totalMarks'] / $fullMarks) * 100, 2) ?></td>
                                <td>
                                    <center>
                                        <a href="#">Detail</a> |
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

$(document).ready(function() {

    $('.qselect').change(function() {
        $('#form-search').submit()
    })
})
</script>
