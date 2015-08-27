$(document).ready(function() {
	$('#add-btn').click(function() {
		$('#additional-fields').append($('#choice-field').html());
        bindRemoveSelf();
	})

	function bindRemoveSelf() {
        $('.minus-btn').click(function () {
            var a = $(this).parent().parent();
            a.remove();
            return false;
        })
    }
	bindRemoveSelf();
})