jQuery(document).ready(function() { 

  jQuery('.rules, .main, .status').matchHeight();

  var allow_restart = false;
  function restart() {
    allow_restart = true;
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

//Прячем правильный ответ при вводе
jQuery('.answer__input').keypress(function() {
  jQuery('.right_answer').hide();
});

jQuery(".form").submit(function() {
  user_answer = jQuery('.answer__input').val();
  right_answer = jQuery('input[name="right_answer"]').val();
  console.log('Ответ пользователя: ' + user_answer);
  console.log('Правильный ответ: ' + right_answer);
  if ( user_answer == right_answer || allow_restart == true ) {
    return true;
  } else {
    jQuery('.right_answer').show();
    return false;
  }
  
});


});//ready