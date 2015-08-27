function addPaginator(elem, page, max_page, author_id) {
  $(elem).empty();
  var ul = '<ul>';
  var li = '';
  for (var i = 1; i <= max_page; i++) {
    if (i == page) {
      li += '<li class="current">' + i + '</li>';
    } else {
      li += '<li><a href="#" onclick="getGroupDetails(' + author_id + ', ' + i + ')">' + i + '</a></li>';
    }
  }
  ul += li + '</ul>';

  $(elem).append(ul);
}

function getGroupDetails(author_id, page) {
  $('.loadingDialog').show();
  $.fn.colorbox({'href':'.loadingDialog', 'opacity':0.50, 'open':true, 'inline':true, 'width':'250px', 'height':'150px'});

	setTimeout(function() {
  $.post('ajax_get_group_authors.php', {id: author_id, page: page},
    function(data) {
			$('.loadingDialog').hide();
      $('#groupDetailDialog table.authorList tbody').empty();

      var cls = '';
      var count = 0;
      $.each(data, function(author) {
        // alert(data[author].author + data[author].article);
        if (count < data.length - 1) {
          count++;
          cls = count % 2 == 1 ? 'odd' : 'even';
          var tr = "<tr class='" + cls + "' value='" + count + "'>" + 
            "<td><a title=\"Edit author\" href=\"editor-view-article-edit.php?article_id=" + data[author].article_id + "\">" + data[author].author + "</a></td>" +
            "<td><a title=\"Edit author\" href=\"editor-view-article-edit.php?article_id=" + data[author].article_id + "\">" + data[author].article + "</a></td>" +
            "<td>" + data[author].journal + "</td>" +
            "<td>" + data[author].affil + "</td>" +
          "</tr>";
          $('#groupDetailDialog table.authorList tbody').append(tr);
        } else {
          var originalClose = $.colorbox.close;
          $.colorbox.close = function(){
              originalClose();
              $('#groupDetailDialog').hide();
          };

          addPaginator('div.dialogPagination', data[author].page, data[author].max_page, author_id);

          $('#groupDetailDialog').show();
          $('#groupDetailDialog a.close').click(function (){ originalClose(); $('#groupDetailDialog').hide(); });
          $.fn.colorbox({'href':'#groupDetailDialog', 'opacity':0.50, 'open':true, 'inline':true, 'width':'600px', 'height':'400px'});
					// $.colorbox.resize({'width': '600px', 'height': '400px'});
        }
      });
    },
    "json"
  );
	}, 500);

  return false;
}

