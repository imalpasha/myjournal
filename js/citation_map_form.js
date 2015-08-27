var author_count = 0;
var author_nos;
var firstTime = true;

$(document).ready(function() {
  initCitingArticleSelector("<?php echo $citing_article_id ?>");
  initCitedArticleSelector("<?php echo $citing_article_id ?>");
  initFormValidation();


});









/** form validation */
function initFormValidation(){
  var ctg_journal = $('#ctg_journal');
  var ctd_journal = $('#ctd_journal');
  
  $("#citation_map_form").submit(function() {
    var ctg_journal2 = ctg_journal.val();
	var ctd_journal2 = ctd_journal.val();
    var isError;
    

    if(!ctg_journal2 && !ctd_journal2) {
      isError = true;
    }
    
    if(isError){
      $('#notice').css('display', 'block');
      $('#notice').text('Please select citing or cited journal below.');
      return false;
    } else {
     return true;
    }      
  });
}

/** citing article selector form */
function initCitingArticleSelector(citing_article_id) {
  var citing_journal_search = $('#citing_journal_search');
  var ctg_journal = $('#ctg_journal');
      
  // Init search field
  citing_journal_search.focus(function() {
    if (firstTime) {
      firstTime = false;
      $(this).css('color', '#000');
      $(this).val('');
    }
  });

  // Init institution list
  citingArticleResetList();

  $('#ctg_journal').change(function() {
  $('#citing_journal_search').css('color', '#000');
    citing_journal_search.val($(this).find('option:selected').text());
  });

  citing_journal_search.keyup(function(e) {
    clearTimeout($.data(this, 'timer'));
    if (e.keyCode == 13) {
      citing_search(true);
    } else {
      $(this).data('timer', setTimeout(citing_search, 100));
    }
  });
}

function citingArticleResetList() {
  var ctg_journal = $('#ctg_journal');
  ctg_journal.empty();

  $('#citing_journal_list li').each(function() {
    var text = $(this).text();
    var value = $(this).attr('value');
    var selected = $(this).attr('title');
    var option = '<option value="' + value + '" ' + selected + '>' + text + '</option>';
    ctg_journal.append(option);
  });
}

function citing_search(force) {
  var existingString = $("#citing_journal_search").val();
  var ctg_journal = $('#ctg_journal');

  if (existingString == '') { 
    resetList();
  } else {
    ctg_journal.empty();
  }

  var citing_journal_list = $('#citing_journal_list li');
  var html = '';

  citing_journal_list.each(function() {
    var text = $(this).text();
    var re = new RegExp(existingString, 'i');
    if (text.search(re) != -1) {
      html = html + "<option value='" + $(this).val() + "'>" + text + "</option>";
    }
  });

  ctg_journal.append(html);
}

/** cited article selector form */
function initCitedArticleSelector(cited_article_id) {
  var cited_journal_search = $('#cited_journal_search');
  var ctd_journal = $('#ctd_journal');
      
  // Init search field
  cited_journal_search.focus(function() {
    if (firstTime) {
      firstTime = false;
      $(this).css('color', '#000');
      $(this).val('');
    }
  });

  // Init institution list
  citedArticleResetList();

  $('#ctd_journal').change(function() {
  $('#cited_journal_search').css('color', '#000');
    cited_journal_search.val($(this).find('option:selected').text());
  });

  cited_journal_search.keyup(function(e) {
    clearTimeout($.data(this, 'timer'));
    if (e.keyCode == 13) {
      cited_search(true);
    } else {
      $(this).data('timer', setTimeout(cited_search, 100));
    }
  });
}

function citedArticleResetList() {
  var ctd_journal = $('#ctd_journal');
  ctd_journal.empty();

  $('#cited_journal_list li').each(function() {
    var text = $(this).text();
    var value = $(this).attr('value');
    var selected = $(this).attr('title');
    var option = '<option value="' + value + '" ' + selected + '>' + text + '</option>';
    ctd_journal.append(option);
  });
}

function cited_search(force) {
  var existingString = $("#cited_journal_search").val();
  var ctd_journal = $('#ctd_journal');

  if (existingString == '') { 
    resetList();
  } else {
    ctd_journal.empty();
  }

  var cited_journal_list = $('#cited_journal_list li');
  var html = '';

  cited_journal_list.each(function() {
    var text = $(this).text();
    var re = new RegExp(existingString, 'i');
    if (text.search(re) != -1) {
      html = html + "<option value='" + $(this).val() + "'>" + text + "</option>";
    }
  });

  ctd_journal.append(html);
}