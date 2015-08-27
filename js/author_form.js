var firstTime = true;

function initInstitutionSelector(institution_id) {
  var institution_name_search = $('#institution_search');
  var institution_select = $('#institution_select');

  // Init search field
  institution_name_search.focus(function() {
    if (firstTime) {
      firstTime = false;
      $(this).css('color', '#000');
      $(this).val('');
    }
  });

  // Init institution list
  resetList();

  institution_select.val(institution_id);
  var selectedInstitution = institution_select.find('option:selected');
  if (selectedInstitution.text().length > 0) {
    institution_name_search.val(selectedInstitution.text());
  }

  $('#institution_select').click(function() {
    institution_name_search.val($(this).find('option:selected').text());
  });

  institution_name_search.keyup(function(e) {
    clearTimeout($.data(this, 'timer'));
    if (e.keyCode == 13) {
      search(true);
    } else {
      $(this).data('timer', setTimeout(search, 100));
    }
  });
}

function resetList() {
  var institution_select = $('#institution_select');
  institution_select.empty();

  $('#institutionList li').each(function() {
    var text = $(this).text();
    var value = $(this).attr('value');

    var option = '<option value="' + value + '">' + text + '</option>';
    institution_select.append(option);
  });
}

function search(force) {
  var existingString = $("#institution_search").val();
  var institution_select = $('#institution_select');

  if (existingString == '') { 
    resetList();
  } else {
    institution_select.empty();
  }

  var institutionList = $('#institutionList li');
  var html = '';

  institutionList.each(function() {
    var text = $(this).text();
    var re = new RegExp(existingString, 'i');
    if (text.search(re) != -1) {
      html = html + "<option value='" + $(this).val() + "'>" + text + "</option>";
    }
  });

  institution_select.append(html);
}

function toggleInstitutionPicker() {
  $institution_search_div = $('#institution_search_div');
  $institution_new_div = $('#institution_new_div');

  if ($institution_search_div.is(':hidden')) {
    $institution_search_div.show();
    $institution_new_div.hide();
  } else {
    $('#institution_select').val(0);
    $institution_search_div.hide();
    $institution_new_div.show();
  }
}
