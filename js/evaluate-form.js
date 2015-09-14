$(document).ready(function() {
    $('input[type=radio]').click(function() {

    	// get input value
    	var value = $(this).data('value');

    	// get td where to print value
        var tdScore = $(this).parent().siblings('.td-score')

        // print value
       	$(tdScore).text(value);

       	sumScore();
    })

    $('input[type=checkbox]').click(function() {

    	var totalCheckboxValue = 0;
    	$(this).parent().children('.input-choice').each(function(i, input) {
    		if ($(input).is(':checked')) {
    			var v = $(input).data('value');
    			totalCheckboxValue += parseInt(v);
    		};

    	})

    	// // get td where to print value
        var tdScore = $(this).parent().siblings('.td-score')

        // print value
       	$(tdScore).text(totalCheckboxValue);

       	sumScore();
    })

    // function to sum up all .td-score
    function sumScore() {
    	var sum = 0;
    	$('.td-score').each(function(i, td) {
    		var tdValue = $(td).text();
    		sum += parseInt(tdValue)
    	})

    	$('.input-result').val(sum);
    }
})
