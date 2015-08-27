var author_count = 0;
var author_nos;
var ajax_load = "<p>Validating login...</p>";  
var login_validate_url = "../../validate_login.php";

$(document).ready(function() {
  author_nos = $('#author_nos');
  $('#add_author').click(add_author);

  disable_form();

  $('#form').bind('submit', function() {
    if (validate_form()) return true;
    else return false;
  });

  $("#user_validate").click(function() {  
    $("#msg").html(ajax_load);  
    
    $.post(  
      login_validate_url,  
      {"username": $('#user_name').val(), "password": $('#user_pass').val()},  
      function(responseText){  
        if (responseText == '1') {
          $('#msg').html('You are now authorized to submit an article. Please fill the following form.');
          enable_form();
        } else {
          disable_form();
          $('#msg').html('Wrong username or password. You are not authorized to submit an article.');
        }
      },  
      "html"  
    );  
  });  
});

function validate_author() {
  var fields = $('#author_form input[type="text"].req');
  var valid = true;

  fields.each(function() {
    if (jQuery.trim($(this).val()) == '') {
      $(this).css('border-color', 'red');
      valid = false;
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

function show_institution_select() {
  var select_div = $("#affil_select_div");
  var search_div = $("#affil_search_div");
  
  select_div.show();
  search_div.hide();
}

function show_institution_search() {
  var select_div = $("#affil_select_div");
  var search_div = $("#affil_search_div");
  
  select_div.hide();
  search_div.show();
}

function search_institution() {
  var options = $("#affil_select_div option");
  var author_ipt_search = $("#author_ipt_search");
  var keyword = author_ipt_search.val();
  var search_result = $("#search_result");
  var html = "<select size='5' style='width: 350px'>";
  
  search_result.empty();
  
  options.each(function() {
    var text = $(this).text();
    var re = new RegExp(keyword, 'i');
    if (text.search(re) != -1) {
      html = html + "<option value='" + $(this).val() + "'>" + text + "</option>";
    }
  });
    
  html = html + "</select>";
  
  search_result.append(html);
  
  search_result.find('select').click(function() {
    author_ipt_search.val($(this).find('option:selected').text());
    setInstitution($(this).val());
  });
}
  
function setInstitution(institution) {
  $("#institution_input").val(institution);
}

function disable_form() {
  $('.articleSubmission input[type="submit"]').attr('disabled', 'disabled');
  $('.articleSubmission textarea').attr('disabled', 'disabled');
  $('.subform:not(#login_form) input').attr('disabled', 'disabled');
  $('.subform: select').attr('disabled', 'disabled');
}

function enable_form() {
  $('.articleSubmission input[type="submit"]').attr('disabled', '');
  $('.articleSubmission textarea').attr('disabled', '');
  $('.subform:not(#login_form) input').attr('disabled', '');
  $('.subform: select').attr('disabled', '');
}

function validate_form() {
  var fields = $('#article_form .req');
  var valid = true;
  var result = true;
  
  var fields2 = $('#author_list .req');
  var valid2 = true;
  
  var fields3 = $('#manuscripts_form .req');
  var valid3 = true;
  
  fields.each(function() {
    if (jQuery.trim($(this).val()) == '') {
      $(this).css('border-color', 'red');
      valid = false;
      result = false;
    }
  });
  
  fields2.each(function() {
    if (jQuery.trim($(this).val()) == '') {
      valid2 = false;
      result = false;
    }
  });
  
  fields3.each(function() {
    if (jQuery.trim($(this).val()) == '') {
      valid3 = false;
      result = false;
    }
  });

  if (!valid) {
    alert('Please fill all the highlighted fields');
  }else if(!valid2) {
    alert('Please add author');
  }else if(!valid3) {
    alert('Please add manuscript');
  }

  return result;
}
