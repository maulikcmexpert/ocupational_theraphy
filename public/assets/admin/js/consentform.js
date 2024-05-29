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
  $("#consentForm").validate({
    rules: {
      // Assuming checkboxes have name attribute as questions[i][answer][]
      // where i ranges from 0 to 34
      "questions[][answer]": {
        required: true,
      },
    },
    messages: {
      "questions[][answer]": {
        required: "Please select at least one checkbox for this question.",
      },
    },
    submitHandler: function (form) {
      // Check if at least one checkbox is checked before form submission
      if ($("input[name^='questions'][type='checkbox']:checked").length === 0) {
        $("label .error").html("Please select at least one.");
        return false; // Prevent form submission
      } else {
        form.submit(); // Submit the form if at least one checkbox is checked
      }
    },
  });
});
