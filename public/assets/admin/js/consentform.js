$(document).ready(function () {
  // Add a custom validation method for checkbox
  $.validator.addMethod(
    "checkboxRequired",
    function (value, element) {
      return $(element).is(":checked");
    },
    "Please fill atleast one."
  );

  // Initialize jQuery Validate plugin
  $("#myForm").validate({
    rules: {
      "questions[0][answer]": {
        checkboxRequired: true,
      },
    },
    messages: {
      "questions[0][answer]": {
        checkboxRequired: "Please fill atleast one.",
      },
    },
    errorPlacement: function (error, element) {
      if (element.attr("type") === "checkbox") {
        error.insertAfter(element.next("label"));
      } else {
        error.insertAfter(element);
      }
    },
  });
});
