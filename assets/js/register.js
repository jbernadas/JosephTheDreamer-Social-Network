$(document).ready(function(){

  // On click signup, hide login and show registration form
  $("#signup").click(function() {
    $("#login-form").slideUp("slow", function() {
      $("#register-form").slideDown("slow");
    });
  });

  // On click signin, hide register and show login form
  $("#signin").click(function() {
    $("#register-form").slideUp("slow", function() {
      $("#login-form").slideDown("slow");
    });
  });

})