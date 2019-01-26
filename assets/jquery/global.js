var bool_mode = "";
$(document).ready(function() {
  $('input').on('keyup keydown keypress click', function(){
    bool_mode = "1";
  });

  $('select').on('click', function(){
    bool_mode = "1";
  });
  $('input, .form-control').on('focusout', function(){
    bool_mode = "0";
  });
  $('input').on('focusout', function(){
    bool_mode = "0";
  });
  $('select').on('focusout', function(){
    bool_mode = "0";
  });
  $('button').on('click', function(){
    bool_mode = "0";
  });
  $('.btn').on('click', function(){
    bool_mode = "0";

  });
  $('.fa').on('click', function(){
    bool_mode = "0";

  });
  $('<tr>').on('click', function(){
    bool_mode = "0";

  });
  $('.btn').on('hover', function(){
    bool_mode = "0";

  });

    $('<a>').on('click', function(){
      bool_mode = "1";
    });

  window.onbeforeunload = function() {

    if (bool_mode == "1"){
      return "It seems you are doing somethhing, are you sure you want to navigate away?";
    }else{
      return null;
    }
  }
});
