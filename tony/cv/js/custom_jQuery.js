/**************************************************************
 *
 * Possible parameters to pass are:
 *	language=en or es
 *	print=true
 *
**************************************************************/
$(document).ready(function() {
  $("a[rel^='prettyPhoto']").prettyPhoto({
 /* light_rounded / dark_rounded / light_square / dark_square / facebook */
    theme: 'dark_rounded'
  });	
});

function checkWindowSize() {
  if ( $(window).height() < $('#sidebar').height() ) {
    $('#sidebar').removeClass('fixed');
  }
  else {
    $('#sidebar').addClass('fixed');
  }
}

$(window).resize(checkWindowSize);

function setLanguage(language)
{
  switch (language)
  {
  case 'es':
    $('.en').hide();
    $('.es').show();
    break;
  default:
    $('.es').hide();
    $('.en').show();
    break;
  }
  setCookie('language', language, 90);
}

jQuery(document).ready(function(){
  var vars = getURLVars();
  var lang = vars.language || getCookie('language');
  if (lang)
    setLanguage(lang);
  else $.getJSON('language.pl', function(data, status) {
    setLanguage(data.language);
  });
  if (vars.print)
    $('#top').hide();
  $('#contactform').submit(function(){
    var action = $(this).attr('action');
    $('#submit')
    .before('<img src="images/ajax-loader.gif" class="loader" />')
    .attr('disabled','disabled');
    $.post(action, { 
      name: $('#name').val(),
      email: $('#email').val(),
      message: $('#message').val()
    },
    function(data){
      $('#contactform #submit').attr('disabled','');
      $('.response').remove();
      $('#contactform').before('<span class="response">'+data+'</span>');
      $('.response').fadeIn('fast');
      $('#contactform img.loader').fadeOut(500,function(){$(this).remove()});
      if(data=='Message sent!') $('#contactform').slideUp();
    });
    return false;
  });
  checkWindowSize()
  $('#co').click(function() {
    setLanguage('es');
  });
  $('#uk').click(function() {
    setLanguage('en');
  });
});
