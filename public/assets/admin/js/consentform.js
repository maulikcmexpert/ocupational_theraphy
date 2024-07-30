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
  const base_url = $("#base_url").val();
  $("#consentForm").on("submit", function (event) {
    if ($('input[type="checkbox"]:checked').length === 0) {
      // $(".consentFormError").html("Please select at least one option.");
      $(".consentFormError").html("Please select all option.");
      $('input[type="checkbox"]').css("outline", "2px solid red"); // Highlight checkboxes
      event.preventDefault();
    } else {
      $('input[type="checkbox"]').css("outline", ""); // Remove highlight if validation passes
    }
  });

  // Remove the outline when a checkbox is checked
  // $('input[type="checkbox"]').on("change", function () {
  //   if ($(this).is(":checked")) {
  //     $('input[type="checkbox"]').css("outline", "");
  //   }
  // });
  $('.reset').on("click", function () {
    var patient_id = ('.patient_id').val();
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      method: "POST",
      url: base_url + "patient/consent_form_reset",
      data: {
        patient_id:patient_id ,
      },
      success: function (output) {
        if (output == true) {
          location.reload();
          toastr.success("Consent form reset successfully !");
        } else {
          location.reload();

          toastr.error("Consent form not reset !");
        }
      },
    });
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
