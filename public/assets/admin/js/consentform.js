$(document).ready(function () {
  $("#consentForm").validate({
    rules: {
      "questions[0][answer]": {
        required: true,
      },
      "questions[1][answer]": {
        required: true,
      },
      "questions[2][answer]": {
        required: true,
      },
    },
    messages: {
      "questions[0][answer]": {
        required: "Please select atleast one",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
