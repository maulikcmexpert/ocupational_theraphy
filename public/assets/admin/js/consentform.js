$(document).ready(function () {
  // Add a custom validation method for checkbox
  $.validator.addMethod(
    "atLeastOneCheckbox",
    function (value, element) {
      return $(element).is(":checked");
    },
    "Please select at least one checkbox."
  );

  // Initialize jQuery Validate plugin
  var validationRules = {};
  var validationMessages = {};
  for (var i = 0; i <= 34; i++) {
    var fieldName = "questions[" + i + "][answer][]";
    validationRules[fieldName] = {
      atLeastOneCheckbox: true,
    };
    validationMessages[fieldName] = {
      atLeastOneCheckbox:
        "Please select at least one checkbox for question " + (i + 1),
    };
  }

  $("#consentForm").validate({
    rules: validationRules,
    messages: validationMessages,
  });
});
