$(document).ready(function () {
  $("#changePass").validate({
    rules: {
      new_password: {
        required: true,
        minlength: 8,
      },
      confirm_password: {
        required: true,
        equalTo: "#new_password",
      },
    },
    messages: {
      new_password: {
        required: "Please enter a new password",
        minlength: "Password must be at least 8 characters long",
      },
      confirm_password: {
        required: "Please confirm your password",
        equalTo: "Passwords do not match",
      },
    },
  });
});
