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
  $.validator.addMethod(
    "atLeastOneSelected",
    function (value, element, params) {
      var group = params[0];
      var name = element.name;
      // Check if any input in the group has a non-empty value
      return (
        $(`input[name^='${group}']`).filter(function () {
          return $(this).val() !== "";
        }).length > 0
      );
    },
    "Please select at least one answer"
  );

  // Initialize validation
  $("#consentForm").validate({
    rules: {
      // Apply the custom rule to the first question as an example
      "questions[0][answer]": {
        atLeastOneSelected: true,
      },
      // Repeat the rule for each question
      "questions[1][answer]": {
        atLeastOneSelected: true,
      },
      "questions[2][answer]": {
        atLeastOneSelected: true,
      },
      "questions[3][answer]": {
        atLeastOneSelected: true,
      },
      "questions[4][answer]": {
        atLeastOneSelected: true,
      },
      "questions[5][answer]": {
        atLeastOneSelected: true,
      },
      "questions[6][answer]": {
        atLeastOneSelected: true,
      },
      "questions[7][answer]": {
        atLeastOneSelected: true,
      },
      "questions[8][answer]": {
        atLeastOneSelected: true,
      },
      "questions[9][answer]": {
        atLeastOneSelected: true,
      },
      "questions[10][answer]": {
        atLeastOneSelected: true,
      },
      "questions[11][answer]": {
        atLeastOneSelected: true,
      },
      "questions[12][answer]": {
        atLeastOneSelected: true,
      },
      "questions[13][answer]": {
        atLeastOneSelected: true,
      },
      "questions[14][answer]": {
        atLeastOneSelected: true,
      },
      "questions[15][answer]": {
        atLeastOneSelected: true,
      },
      "questions[16][answer]": {
        atLeastOneSelected: true,
      },
      "questions[17][answer]": {
        atLeastOneSelected: true,
      },
      "questions[18][answer]": {
        atLeastOneSelected: true,
      },
      "questions[19][answer]": {
        atLeastOneSelected: true,
      },
      "questions[20][answer]": {
        atLeastOneSelected: true,
      },
      "questions[21][answer]": {
        atLeastOneSelected: true,
      },
      "questions[22][answer]": {
        atLeastOneSelected: true,
      },
      "questions[23][answer]": {
        atLeastOneSelected: true,
      },
      "questions[24][answer]": {
        atLeastOneSelected: true,
      },
      "questions[25][answer]": {
        atLeastOneSelected: true,
      },
      "questions[26][answer]": {
        atLeastOneSelected: true,
      },
      "questions[27][answer]": {
        atLeastOneSelected: true,
      },
      "questions[28][answer]": {
        atLeastOneSelected: true,
      },
      "questions[29][answer]": {
        atLeastOneSelected: true,
      },
      "questions[30][answer]": {
        atLeastOneSelected: true,
      },
      "questions[31][answer]": {
        atLeastOneSelected: true,
      },

      "questions[32][answer]": {
        atLeastOneSelected: true,
      },
      "questions[33][answer]": {
        atLeastOneSelected: true,
      },
      "questions[34][answer]": {
        atLeastOneSelected: true,
      },
    },
    messages: {
      "questions[0][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      // Repeat the rule for each question
      "questions[1][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[2][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[3][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[4][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[5][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[6][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[7][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[8][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[9][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[10][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[11][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[12][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[13][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[14][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[15][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[16][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[17][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[18][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[19][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[20][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[21][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[22][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[23][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[24][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[25][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[26][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[27][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[28][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[29][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[30][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[31][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },

      "questions[32][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[33][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
      "questions[34][answer]": {
        atLeastOneSelected: "Please select at least one answer",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
