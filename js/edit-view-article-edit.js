$(document).ready(function() {
    $('#status').change(function () {
        var status = $(this).val();
        var sel_iss = $('.sel_iss').val();
        if(status!='editor published') {
            alert('Volume/Issue will be disable until the status update to "Editor Publish"');
            $('option:selected', 'select').removeAttr('selected');
            $('.stat_block').attr('selected','selected');
            $('.stat_block').css('display','block');
            $('#issue_id').attr('disabled', true); 
        } else {
            $('#issue_id').attr('disabled', false);
            $('.stat_block').removeAttr('selected');
            $('.stat_block').css('display','none');
            $("#issue_id option[value="+sel_iss+"]").attr('selected','selected');
        }
    });
});

function delete_author(author_id) {
    var doDelete = confirm('Are sure to delete the author?');

    if (!doDelete) return false;

    $('#author_' + author_id).remove();

    // Check if this author is currently in the form
    if ($('#author_id').val() == author_id) {
      $('#reset_author').click();
    }
}

function edit_author(author_id, ipt_id, country_id) {
    var filled_author = $('#author_' + author_id + ' .val');
    var authorFormTable = $('#authorFormTable');
    $('#reset_author').show();

    resetAuthorlistHighlight();
    filled_author.parent().addClass('highlight');

    var sequence = $(filled_author.get(0)).text();
    var name = $(filled_author.get(1)).text();
    var email = $(filled_author.get(2)).text();
    var dept = $(filled_author.get(3)).text();

    $('#author_id').val(author_id);
    $('#author_sequence').val(sequence);
    $('#author_name').val(name);
    $('#author_email').val(email);
    $('#author_dept').val(dept);
    
    if ($(filled_author.get(4)).text() == 'Yes') {
      $('#author_corresponding').attr('checked', 'on');
    } else {
      $('#author_corresponding').removeAttr('checked');
    }

    if (jQuery.trim(ipt_id) != '') {
      if ($('#institution_search_div:hidden').length > 0) toggleInstitutionPicker();
      setIptInList(ipt_id);
    } else {
      if ($('#institution_new_div:hidden').length > 0) toggleInstitutionPicker();
      var hidden = $('#author_' + author_id + ' .realFormFields');
      $('#institution_text').val(hidden.find('input:nth-child(9)').val());
      $('#institution_new_div select').val(hidden.find('input:nth-child(7)').val());
    }
}

function resetAuthorlistHighlight() {
    $('#authorDisplay tr').removeClass('highlight');
}

function submit_author() {
    var institution_text = '';
    var country = '';
    var country_id = '';
    var ipt_id = '';
    var sector_id = '';
    var sector = '';

    if ($('#institution_new_div:hidden').length == 0) {
      // New institution
      country_id = $('#institution_new_div #country option:selected').val();
      country = $('#institution_new_div #country option:selected').text();
      sector_id = $('#institution_new_div #sector option:selected').val();
      sector = $('#institution_new_div #sector option:selected').text();
      // institution_text = $('#institution_text').val() + ' (' + country + ')';
      institution_text = $('#institution_text').val();
    } else {
      // Existing institution
      ipt_id = $('#institution_select').val();
      if (ipt_id == null || ipt_id == '0') {
        alert('Please select an institution');
        return false;
      }
      institution_text = $('#institution_search').val();
    }

    var author_count = $('#author_count');
    var author_id = $('#author_id').val();
    var corresponding = $('#author_corresponding:checked').length;
    var temp = parseInt(author_count.val());
    author_count.val(isNaN(temp) ? 0 : (temp + 1));
    // author_count.val(parseInt(author_count.val()) + 1);

    if (author_id.trim().length > 0) {
      var old_author = $('#author_' + author_id);
      if (old_author.length > 0) old_author.remove();
    } else {
      author_id = getAuthorFakeId();
    }

    var inputs = buildAuthorInputs(
      author_count.val(),
      author_id,
      // $('#author_id').val(),
      $('#author_sequence').val(),
      $('#author_name').val(),
      $('#author_email').val(),
      $('#author_dept').val(),
      corresponding,
      country_id,
      ipt_id,
      institution_text,
      sector_id
    );

    var html = '<tr id="author_' + author_id + '">' +
                 '<td class="val">' + $('#author_sequence').val() + '</td>' +
                 '<td class="val">' + $('#author_name').val() + '</td>' + 
                 '<td class="val">' + $('#author_email').val() + '</td>' + 
                 '<td class="val">' + $('#author_dept').val() + '</td>' + 
                 '<td class="val">' + institution_text + '</td>' + 
                 '<td class="val">' + (corresponding == '1' ? 'Yes' : 'No') + '</td>' + 
                 '<td class="val"><a href="#">Edit</a> | <a href="#">Delete</a>' + inputs + '</td>' + 
               '</tr>';

    $('#authorDisplay').append(html);
    var new_author = $('#author_' + author_id);
    new_author.find('a:first').click(function () {
      edit_author(author_id, ipt_id, country_id);
      return false;
    });

    new_author.find('a:last').click(function () {
      delete_author(author_id);
      return false;
    });

    $('#reset_author').click();
    /*
    $('#author_sequence').val(getNextAuthorSequence());
    $('#author_id').val('');
    $('#author_name').val('');
    $('#author_email').val('');
    $('#author_corresponding').removeAttr('checked');
    $('#reset_author').hide();
     */
    // resetAuthorlistHighlight();
}

function getAuthorFakeId() {
    var id_num = 0;
    var temp;

    $('#authorDisplay tr').each(function () {
      var tr = $(this).attr('id');
      var id_start = tr.substring(7, 8);

      if (id_start == 'F') {
        temp = parseInt(tr.substring(8));
        if (temp > id_num) id_num = temp;
      }
    });

    return ('F' + (id_num + 1));
}

function getNextAuthorSequence() {
    var seq = 0;
    var temp;

    $('#authorDisplay tr').each(function () {
      temp = parseInt($(this).find('td:first').text());
      if (temp > seq) seq = temp;
    });

    return (seq + 1);
}

function buildAuthorInputs(author_count, au_id, au_seq, au_name, au_email, au_dept, au_corres, country_id, ipt_id, ipt_name, sector_id) {
    html = '<div class="realFormFields" style="display: none">' + 
             '<input type="hidden" name="author[' + author_count + '][id]" value="' + au_id + '" />' +
             '<input type="hidden" name="author[' + author_count + '][sequence]" value="' + au_seq + '" />' +
             '<input type="hidden" name="author[' + author_count + '][name]" value="' + au_name + '" />' +
             '<input type="hidden" name="author[' + author_count + '][email]" value="' + au_email + '" />' +
             '<input type="hidden" name="author[' + author_count + '][department]" value="' + au_dept + '" />' +
             '<input type="hidden" name="author[' + author_count + '][corresponding]" value="' + au_corres + '" />' +
             '<input type="hidden" name="author[' + author_count + '][country_id]" value="' + country_id + '" />' +
             '<input type="hidden" name="author[' + author_count + '][ipt_id]" value="' + ipt_id + '" />' +
             '<input type="hidden" name="author[' + author_count + '][ipt_name]" value="' + ipt_name + '" />' +
             '<input type="hidden" name="author[' + author_count + '][sector_id]" value="' + sector_id + '" />' +
           '</div>';

    return html;val
}

function toggleAuthorList() {
    $('#authorFormWrapper').slideToggle('slow');
}