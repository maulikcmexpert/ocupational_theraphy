$(document).ready(function () {
  // Add a custom validation method for checkbox
  alert(0);
  return false;
  // Initialize jQuery Validate plugin
  $("#consentForm").validate({
    rules: {
      "questions[0][answer]": {
        required: true,
      },
    },
    messages: {
      "questions[0][answer]": {
        required: "Please fill atleast one.",
      },
    },
  });
});
