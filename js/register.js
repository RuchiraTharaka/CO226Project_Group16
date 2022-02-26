$(document).ready(function(){
  $('#module').on('change', function() {
    if ( this.value === 'none')
    {
      console.log("none");
      $("#basic-form").hide();
      $("#std").hide();
      $("#ugs").hide();
      $("#adm").hide();
      $("#pass").hide();
    }
    else if ( this.value === 'STD')
    {
      console.log("std");
      $("#basic-form").show();
      $("#std").show();
      $("#ugs").hide();
      $("#adm").hide();
      $("#pass").show();
    }
    else if ( this.value === 'UGS')
    {
      console.log("ugs");
      $("#basic-form").show();
      $("#std").hide();
      $("#ugs").show();
      $("#adm").hide();
      $("#pass").show();
    }
    else
    {
      console.log("adm");
      $("#basic-form").show();
      $("#std").hide();
      $("#ugs").hide();
      $("#adm").show();
      $("#pass").show();
    }
  });
});
