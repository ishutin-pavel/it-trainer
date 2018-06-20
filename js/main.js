jQuery(document).ready(function() { 

  jQuery('.answer__input').focus();

  jQuery('.rules, .main, .status').matchHeight();

  function restart() {
    var restart = true;
    jQuery('input[name="count"]').attr({
      'value': '0'
    });
    jQuery(".form").submit();
  }

  jQuery(".restart").on('click', function(event) {
    event.preventDefault();
    restart();
  });

  jQuery("#diapason").change(function(event) {
    restart();
  });


jQuery(".form").submit(function() {
  user_answer = $('.answer__input').val();
  if ( user_answer == right_answer || restart ) {
    return true;
  } else {
    $('.right_answer').show();
    return false;
  }
  
});


});//ready