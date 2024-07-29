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
  $("#consentForm").on("submit", function (event) {
    // if ($('input[type="checkbox"]:checked').length === 0) {
    //   $(".consentFormError").html("Please select at least one option.");
    //   $('input[type="checkbox"]').css("outline", "2px solid red"); // Highlight checkboxes
    //   event.preventDefault();
    // } else {
    //   $('input[type="checkbox"]').css("outline", ""); // Remove highlight if validation passes
    // }

    var checkboxGroups = $(".form-check");
    var valid = false;

    // Loop through each group
    checkboxGroups.each(function () {
      // Check if any checkbox in the current group is checked
      if ($(this).find('input[type="checkbox"]').is(":checked")) {
        valid = true;
        return false; // Break out of the loop if one group is valid
      }
    });

    // If no checkbox is checked in any group, prevent form submission
    if (!valid) {
      event.preventDefault(); // Prevent form submission
      alert(
        "Please check at least one checkbox in each section before submitting."
      );
    }
    event.preventDefault();
  });

  // Remove the outline when a checkbox is checked
  $('input[type="checkbox"]').on("change", function () {
    if ($(this).is(":checked")) {
      $('input[type="checkbox"]').css("outline", "");
    }
  });
});

// $(document).ready(function () {
//   // Add custom method to check at least one answer is selected

//   // Initialize validation
//   $("#consentForm").validate({
//     rules: {
//       // Apply the custom rule to the first question as an example
//       "questions[0][answer]": {
//         required: true,
//       },
//     },
//     messages: {
//       "questions[0][answer]": {
//         required: "Please select at least one answer",
//       },
//     },
//     submitHandler: function (form) {
//       form.submit();
//     },
//   });
// });
