function journalVolumeIssue() {
    $('#selectJournal').live('change',function() {
        //var journal_id = $(this).attr('value');
        //$('.volume').html(journal_id);
        $.get('getJournalVolume.php', { journal_id: $(this).attr('value') })
            .success(function(data) { $('.volume').html(data); })
            //.error(function(data) { $('.volume').html(''); });
        $.get('getJournalIssue.php', { volume_id: '' })
            .success(function(data) { $('.issue').html(data); })
    });
    
    $('#selectVolume').live('change',function() {
       // var volume_id = $(this).attr('value');
        $.get('getJournalIssue.php', { volume_id: $(this).attr('value') })
            .success(function(data) { $('.issue').html(data); })
            //.error(function(data) { $('.issue').html(''); });
    });
    
    $('#selectIssue').live('change',function() {
        var journal_id = $('#selectJournal').attr('value');
        var volume_id = $('#selectVolume').attr('value');
        var issue_id = $('#selectIssue').attr('value');
        
        //redirect page
        window.location.replace('article_references.php?journal_id='+journal_id+'&volume_id='+volume_id+'&issue_id='+issue_id);
    });
    
    return true;
}
