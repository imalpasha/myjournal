/**
 * Submit IDs for report generation to Session
 * eg (article_id, affiliation_id, etc)
 *
 * a    anchor element
 * key  token key 
 */
function ajaxSubmitReportableIds(a, token, key, appendable_ids, removable_ids) {
  var appendable_ids_size = appendable_ids.size();
  var add_ids = '';
  
  // add checked ids
  for (i = 0; i < appendable_ids_size; i++) {
    add_ids += $(appendable_ids[i]).val() + ",";
  }

  var removable_ids_size = removable_ids.size();
  var del_ids = '';
  
  // add uncheck ids
  for (i = 0; i < removable_ids_size; i++) {
    del_ids += $(removable_ids[i]).val() + ",";
  }

  var param = {
    add_ids: add_ids,
    remove_ids: del_ids,
    key: key,
    token: token 
  };
 
  $.post('ajax/addCheckIds.php', param)
  .complete(function() {
      if (a != null) window.location.href = $(a).attr('value');
    }
  );
}
