<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
      <tr>
        <td height="30">
          <a href="#">Home</a> &gt; <a href="<?php echo $APP_URL; ?>/myjurnal/classification_categories.php">Categories</a> &gt; Category Detail
        </td>                                             
      </tr>
      <tr>
        <td height="30" background="images/tajukpanjang750.png">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fontWhiteBold"><?php echo $form['name'] ?><?php /*echo $form['name']. ' (Total ' . count($form->category_criteria()) . ')' */?></span>
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
                      <th>Category Name</th>
                      <th width="120px">Number of Criterias</th>
                      <th width="80px">Action</th>
                    </tr>
                    <?php $i = 0  ?>
                    <?php foreach ($form->category_criteria() as $row): ?>
                    <tr>
                      <td><?php echo ++$i ?></td>
                      <td><?php echo $row->criteria['criteria_name'] ?></td>
                      <td>
                        <ul style="padding-left:20px">
                        <?php foreach ($row->criteria->choice() as $choice): ?>
                          <li><?php echo $choice['choice_name'] ?></li>
                        <?php endforeach ?>
                        </ul>
                      </td>
                      <td>
                        <center>
                        <a href="#">Edit</a> | 
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