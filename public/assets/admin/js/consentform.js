// $(document).ready(function () {
//   $("#consentForm").validate({
//     rules: {
//       "questions[0][answer]": {
//         required: true,
//       },
//     },
//     messages: {
//       "questions[0][answer]": {
//         required: "Please select atleast one",
//       },
//     },
//     submitHandler: function (form) {
//       form.submit();
//     },
//   });
// });

$(document).ready(function () {
  // Add custom method to check at least one answer is selected

  // Initialize validation
  $("#consentForm").validate({
    rules: {
      // Apply the custom rule to the first question as an example
      "questions[0][answer]": {
        atLeastOneSelected: true,
      },
    },
    messages: {
      "questions[0][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
