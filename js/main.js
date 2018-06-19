jQuery(document).ready(function() { 

  jQuery('.answer__input').focus();

  jQuery('#diapason').change(function() {
    $(".form").submit();
  });


$(".form").submit(function() {
  user_answer = $('.answer__input').val();
  if ( user_answer == right_answer ) {
    $('.history-list').prepend('Верно');
    return true;
      // endTime = new Date();
      // time = endTime - startTime;
      // $.post(
      //   "/php/insert_time.php",
      //   {
      //     id: id,
      //     time: time,
      //   },
      //   onAjaxSuccess
      // );
       
      // function onAjaxSuccess(data)
      // {
      //   // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
      //   // alert(data);
      // }


      // id++;
      // document.location.href='/?id=' + id;
  } else {
    var right_answer_output = right_answer.replace(/</ig, "&lt;");
    right_answer_output = right_answer_output.replace(/>/ig, "&gt;");
    $('.history-list').prepend('<div class="history-list__item"> <div class="history-list__right-answer">Правильный ответ: <code>' + right_answer_output +'</code></div> </div>');
    return false;
  }
  
});


});//ready