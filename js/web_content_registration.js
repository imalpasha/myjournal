function validate_date(date_str) {
  var date = null;

  try {
    date = $.datepicker.parseDate('dd-mm-yy', date_str);
    date_str = $.datepicker.formatDate('dd-mm-yy', date);
  } catch (err) {
    date_str = 'Invalid date';
  }

  now = new Date();
  if (date.getFullYear() < 1900 || date >= now) date_str = 'Invalid date';

  return date_str;
}

function validate_username(name) {

}

$(document).ready(function(){
	$("#registrationForm").validate({
		rules: {
      username: {
        required: true,
        minlength: 4,
        remote: '../../ajax/validate_user.php'
      },
			password: {
				required: true,
				minlength: 6
			},
			confirm_password: {
				required: true,
				minlength: 6,
				equalTo: "#password"
			},
	  title: {
        required: true,
      },
      name: {
        required: true,
      },
      captcha: {
	     required: true,
	  },
      address: {
        required: true,
      },
      city: {
        required: true,
      },
      zip: {
        required: true,
      },
      state: {
        required: true,
      },
	  country: {
        required: true,
      },
	  occupation: {
        required: true,
      },
      tel: {
        required: true,
        digits: true
      },
      fax: {
        digits: true
      },
			email: {
				required: true,
				email: true
      },
      dob: {
        required: true,
        date: true
      }
		},
		messages: {
			username: {
				minlength: "Your username must consist of at least 4 characters",
        remote: "This username is taken"
			},
			password: {
				minlength: "Your password must be at least 6 characters long"
			},
			confirm_password: {
				minlength: "Your password must be at least 6 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address",
		}
	});
});
