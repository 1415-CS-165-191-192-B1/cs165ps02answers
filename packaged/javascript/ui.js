$(document).ready(function() {

  $('.accordion')
    .accordion()
  ;

  var today = new Date();
  var currentYear = today.getFullYear();
  $('#year').spinner({
    max: currentYear + 20,
    min: currentYear - 20,
    value: currentYear,
  });

  $('#year').spinner("value", currentYear)

  $("#country")
    .dropdown()
  ;

  $("#cutoff")
    .datepicker({
      yearRange: "-20:+20",
      changeMonth: true,
      changeYear: true,
    })
  ;

  $('#cutoff')
    .datepicker("option", "dateFormat", "yy-mm-dd")

  $('#start-date')
    .datepicker({
      yearRange: "-20:+20",
      changeMonth: true,
      changeYear: true,
      onClose: function( selectedDate ) {
        $('#end-date').datepicker("option", "minDate", selectedDate);
      }
    })
  ;

  $('#end-date')
    .datepicker({
      yearRange: "-20:+20",
      changeMonth: true,
      changeYear: true,
      onClose: function( selectedDate ) {
        $('#start-date').datepicker("option", "maxDate", selectedDate);
      }
    })
  ;

  $('#start-date')
    .datepicker("option", "dateFormat", "yy-mm-dd")
  ;
  $('#end-date')
    .datepicker("option", "dateFormat", "yy-mm-dd")
  ;



  $('.ui.accordion').click(function() {
    $('.ui.accordion')
      .accordion('toggle');
  });

});
