function registerAbstractLoader() {
  // $('.viewAbstract').removeAttr('href');
  $('.viewAbstract').attr('href', '#');

  $('.viewAbstract').click(function() {
    var content = $(this).next('div.content');
    if ($(content).is(':hidden')) {
      if ($(content).is(':empty')) {
        $(content).html('Loading...');
        $.get('ajax_get_abstract.php', { article_id: $(this).attr('value') })
          .success(function(data) { $(content).html(data); })
          .error(function(data) { $(content).html(''); });
      }
      $(content).slideDown('fast');
    } else {
      $(content).slideUp('fast');
    }

    return false;
  });
}

function registerReferencesLoader() {
  // $('.viewAbstract').removeAttr('href');
  $('.viewReferences').attr('href', '#');

  $('.viewReferences').click(function() {
    var content = $(this).next('div.references');
    if ($(content).is(':hidden')) {
      if ($(content).is(':empty')) {
        $(content).html('Loading...');
        $.get('ajax_get_references.php', { article_id: $(this).attr('value') })
          .success(function(data) { $(content).html(data); })
          .error(function(data) { $(content).html(''); });
      }
      $(content).slideDown('fast');
    } else {
      $(content).slideUp('fast');
    }

    return false;
  });
}
