var author_count = 0;
var author_nos;
var firstTime = true;

$(document).ready(function() {
  // author_nos = $('#author_nos');
  // $('#add_author').click(add_author);
  initInstitutionSelector("<?php echo $institution_id ?>");

  $('#reset_author').click(function () { 
    $('#author_sequence').val(getNextAuthorSequence());
    $('#author_id').val('');
    $('#author_name').val('');
    $('#author_email').val('');
    $('#author_corresponding').removeAttr('checked');
    $('#reset_author').hide();
    resetAuthorlistHighlight();
    $(this).hide() 
  });

  $('a.suggestion').click(function (e) {
    onClickSuggestion($(this), e);
    return false;
  });

  $('#suggestCancel').click(function () {$('#suggestionBox').hide(); return false});
  $('#suggestOK').click(function () {putSuggestion(); return false;});

  $('#add_author').click(function () {
    if (validate_author()) submit_author();
  });

  $('#article_form').bind('submit', function() {
    if (validate_form()) return true;
    else return false;
  });

  // setupAutocomplete($('#author_name'), 'ajax_name_suggest.php');
  initAuthorNameAutoComplete();
});

function initAuthorNameAutoComplete() {
  $(function() {
    var cache = {},
      lastXhr;
    $( "#author_name" ).autocomplete({
      minLength: 2,
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );
          return;
        }

        lastXhr = $.getJSON( "ajax_name_suggest.php", request, function( data, status, xhr ) {
          cache[ term ] = data;
          if ( xhr === lastXhr ) {
            // response( data );
            response($.map(data, function(item) {
              return {
                label: item.name,
                value: item.name,
                email: item.email
              }
            }));
              
          }
        });
      },
      select: function(event, ui) {
        $('#author_email').val(ui.item.email);
        // console.log('name:' + ui.item.label + ', label:' + ui.item.email);
      }
    });
  });
}

function setupAutocomplete(input, url) {
  var ajax, ajaxCount = 0, query = '';
  var select = input.nextAll('select:first');

  input.keyup(function () {
    query = $(this).val(); 

    if (query.length < 3) { select.hide(); return };

    if (ajax) {
      select.hide();
      ajax.abort(); 
    }

    var token = ++ajaxCount;
    ajax = jQuery.get(
      url,
      { query: query },
      function(data) {
        if (token != ajaxCount) {
          select.hide();
          return;
        }
        showSuggest(data, select);
      },
      'json'
    );
  });
}

function onClickSuggestion(a, e) {
  // Textarea or input[text]
  var field = $(a).next().attr('id');
  $('#suggestField').val(field);
  $('#suggestText').val($(a).next().next().html());

  var suggestionBox = $('#suggestionBox');
  suggestionBox.css({left: e.pageX - suggestionBox.width(), top: e.pageY + 10});
  suggestionBox.show();
}

function putSuggestion() {
  var field = $('#suggestField').val();
  $('#' + field).val($('#suggestText').val());

  $('#suggestionBox').hide();
}

function validate_author() {
  var fields = $('#authorFormTable input[type="text"].req:not(:hidden)');
  var valid = true;

  fields.each(function() {
    if (jQuery.trim($(this).val()) == '') {
      if ($(this).hasClass('invalid') == false) $(this).addClass('invalid');
      valid = false;
    } else if ($(this).val().charAt(0) == ' ') {
      if ($(this).hasClass('invalid') == false) $(this).addClass('invalid');
      valid = false;
    } else {
      if ($(this).hasClass('invalid')) $(this).removeClass('invalid');
    }
  });

  return valid; 
}

function add_author() {
  if (!validate_author()) {
    alert("Please fill all author's detail");
    return false;
  }

  var author_list = $('#author_list');
  var name = $('#author_name');
  var email = $('#author_email');
  var seq = $('#author_sequence');
  var corres = $('#author_corresponding');
  var dept = $('#author_dept');
  var ipt_search = $('#author_ipt_search');
  var ipt_manual = $('#author_ipt_manual');
  var affil_search_div = $('#affil_search_div');

  var hidden_name = create_hidden_input('author_name_' + author_count, name.val());
  var hidden_email = create_hidden_input('author_email_' + author_count, email.val());
  var hidden_seq = create_hidden_input('author_seq_' + author_count, seq.val());
  var hidden_corres = create_hidden_input('author_corres_' + author_count, corres.attr('checked'));
  var hidden_dept  = create_hidden_input('author_dept_' + author_count, dept.val());
  var hidden_ipt;

  if (affil_search_div.css('display') == 'none') {
    hidden_ipt = create_hidden_input('author_ipt_' + author_count, ipt_manual.val());
  } else {
    hidden_ipt = create_hidden_input('author_ipt_' + author_count, ipt_search.val());
  }

  author_list.append('<input type="hidden" id="author_no_' + author_count + '" class="author_no" value="' + author_count +'" />');
  author_list.append(hidden_name);
  author_list.append(hidden_email);
  author_list.append(hidden_seq);
  author_list.append(hidden_corres);
  author_list.append(hidden_dept);
  author_list.append(hidden_ipt);

  add_author_text(name.val(), email.val(), author_count);

  // clear form
  name.val('');
  email.val('');
  seq.val('');
  corres.attr('checked', '');
  dept.val('');
  ipt_search.val('');
  ipt_manual.val('0');
  update_author_nos();

  author_count += 1;
}

function add_author_text(name, email, value) {
  var display_authors = $('#author_list ul.display');
  var delete_a = '<a href="#">x</a>';
  var text = '<li id="delete_author_' + value + '">' + delete_a + ' ' + name + ', ' + email + '</li>';

  display_authors.append(text);
  
  $('#delete_author_' + value + ' a').click(function () {
    delete_hidden_author(value);
    $(this).parent().remove();
    update_author_nos();
    return false;
  });
}

function delete_hidden_author(value) {
  $('#author_no_' + value).remove();
  $('#author_name_' + value).remove();
  $('#author_email_' + value).remove();
  $('#author_seq_' + value).remove();
  $('#author_corres_' + value).remove();
  $('#author_dept_' + value).remove();
  $('#author_ipt_' + value).remove();
}

function create_hidden_input(id, value) {
  return '<input type=hidden id="' + id + '" name="' + id + '" value="' + value + '" />';
}

// function process_submit() {
function update_author_nos() {
  var author_nos = $('#author_nos');
  var value = '';

  $('#author_list input.author_no').each(function() {
    value += $(this).val() + ',';
  });

  author_nos.val(value);
}

function validate_form() {
  var h_fields = $('#article_form_header .req');
  var o_fields = $('#article_form_others .req');
  var valid = true;
  
  h_fields.each(function() {
    if (!validate_field($(this))) valid = false;
    /*
    if (jQuery.trim($(this).val()) == '') {
      $(this).css('border-color', 'red');
      valid = false;
    }
    */
  });

  o_fields.each(function() {
    if (!validate_field($(this))) valid = false;
  });

  if (!valid) {
    alert('Please fill all the highlighted fields');
  }

  return valid;
}

function validate_field(field) {
  if (jQuery.trim(field.val()) == '') {
    field.addClass('invalid');
    return false;
  }

  return true;
}

/** Author form */
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

function institutionExists(id) {
  var institutionList = $('#institutionList li');

  institutionList.each(function() {
    if ($(this).val() == id) return true;
  });

  return false;
}

function setIptInList(ipt_id) {
  var institution_search = $("#institution_search");
  var institutionList = $('#institutionList li');
  var institution_select = $('#institution_select');
  var institution;

  // Set select
  institution_select.val(ipt_id);

  institutionList.each(function() {
    if ($(this).val() == ipt_id) {
      institution = $(this).text();
    }
  });

  // Set search field
  institution_search.val(institution);
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

/*
function suggestName(query) {
  return jQuery.get(
    'ajax_name_suggest.php',
    { query: query },
    function(data) {
      showSuggest(data);
    },
    'json'
  );
}
*/

function showSuggest(data, select) {
  select.unbind();

  if (data.length > 0) {
    select.empty();
    select.show();
    var html = '';
    var value;

    jQuery.each(data, function(key, val) {
      html += '<option value="' + val.email + '">' + val.name + '</option>';
    });

    select.html(html);
    select.change(function () {
      select.prevAll('input:first').val(select.find('option:selected').html())

      $('#author_email').val(select.val()); // Remove this line to make this function element independent
      select.hide();
    });
  } else {
    select.hide();
  }
}
