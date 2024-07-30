$(function () {

  const base_url = $("#base_url").val();

  var table = $(".data-table").DataTable({
    processing: true,
    serverSide: true,

    ajax: base_url + "patient",
    columns: [
      { data: "number", name: "number" },
      // { data: "profile", name: "profile" },
      { data: "patient_name", name: "patient_name" },
      { data: "ezmed_number", name: "ezmed_number" },
      { data: "identity_number", name: "identity_number" },

      { data: "group_assignment", name: "group_assignment" },
      { data: "ras_form", name: "ras_form" },
      { data: "apom_form", name: "apom_form" },
      {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false,
      },
    ],
  });

  $("#patientForm").validate({
    rules: {
      first_name: { required: true },
      last_name: { required: true },
      passport_SAID: { required: true },
      identity_number: {
        required: true,
        number: true,
        minlength: 13,
        maxlength: 13,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "patient/check_identity_number_is_already",
          method: "POST",
          data: {
            identity_number: function () {
              return $("input[name='identity_number']").val();
            },
            id: function () {
              return $("input[name='id']").val();
            },
          },
        },
      },
      password: { required: true, minlength: 6 },
      date_of_birth: { required: true },
      EZMed_number: {
        required: true,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "patient/check_ezmed_number_is_already",
          method: "POST",
          data: {
            EZMed_number: function () {
              return $("input[name='EZMed_number']").val();
            },
            id: function () {
              return $("input[name='id']").val();
            },
          },
        },
      },
      // language: { required: true },
      // referring_provider: { required: true },
      // gender: { required: true },
      // next_of_kin: { required: true },
      // name: { required: true },
      // surname: { required: true },
      // contact_number: { required: true },
      // alternative_contact_number: { required: true },
      // physical_address: { required: true },
      // complex_name: { required: true },
      // unit_no: { required: true },
      // city: { required: true },
      // country: { required: true },
      // postal_code: { required: true },
    },
    messages: {
      first_name: { required: "Please enter first name" },
      last_name: { required: "Please enter last name" },
      passport_SAID: { required: "Please select passport or SA ID" },
      identity_number: {
        required: "Please enter identity number",
        number: "Identity number must be only digit",
        minlength: "Please enter 13 digit Identity number",
        maxlength: "Please enter 13 digit Identity number",
        remote: "identity_number is already exist",
      },
      password: {
        required: "Please enter password",
        minlength: "Password must be minimum 6 and more character",
      },
      date_of_birth: { required: "Please enter date of birth" },
      EZMed_number: {
        required: "Please enter EZMed number",
        remote: "This Ezmed number already allocated to other patient",
      },
      // language: { required: "Please enter language" },
      // referring_provider: { required: "Please enter referring provider" },
      // gender: { required: "Please enter gender" },
      // next_of_kin: { required: "Please enter next of kin" },
      // name: { required: "Please enter name" },
      // surname: { required: "Please enter surname" },
      // contact_number: { required: "Please enter contact number" },
      // alternative_contact_number: {
      //     required: "Please enter alternative contact number",
      // },
      // physical_address: { required: "Please enter physical address" },
      // complex_name: { required: "Please enter complex name" },
      // unit_no: { required: "Please enter unit no" },
      // city: { required: "Please enter city" },
      // country: { required: "Please enter country" },
      // postal_code: { required: "Please enter postal code" },
    },
  });

  //  Apom //

  $("#APOMForm").validate({
    rules: {
      // attention: { required: true, min: 1, max: 18, number: true },
      // pace: { required: true, min: 1, max: 18, number: true },
      // knowledgeToolsAndMaterials: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // knowledgeConceptFormation: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // skillsToUseToolsAndMaterials: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // taskConcept: { required: true, min: 1, max: 18, number: true },
      // organizingSpaceAndObjects: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // adaptation: { required: true, min: 1, max: 18, number: true },
      // nonVerbalPhysicalContact: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // nonVerbalEyeContact: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // nonVerbalGestures: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // nonVerbalUseOfBody: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // verbalSpeech: { required: true, min: 1, max: 18, number: true },
      // verbalContent: { required: true, min: 1, max: 18, number: true },
      // verbalExpressNeeds: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // verbalConversation: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // relationsSocialNorms: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // relationsRapport: { required: true, min: 1, max: 18, number: true },
      // personalCare: { required: true, min: 1, max: 18, number: true },
      // personalSafety: { required: true, min: 1, max: 18, number: true },
      // careOfMedication: { required: true, min: 1, max: 18, number: true },
      // useOfTransport: { required: true, min: 1, max: 18, number: true },
      // domesticSkills: { required: true, min: 1, max: 18, number: true },
      // childCareSkills: { required: true, min: 1, max: 18, number: true },
      // moneyManagementAndBudgetingSkills: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // assertiveness: { required: true, min: 1, max: 18, number: true },
      // stressManagement: { required: true, min: 1, max: 18, number: true },
      // conflictManagement: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // problemSolvingSkills: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // preVocationalSkills: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // vocationalSkills: { required: true, min: 1, max: 18, number: true },
      // awarenessOfRoles: { required: true, min: 1, max: 18, number: true },
      // roleExpectations: { required: true, min: 1, max: 18, number: true },
      // roleBalance: { required: true, min: 1, max: 18, number: true },
      // competency: { required: true, min: 1, max: 18, number: true },
      // timeUseRoutines: { required: true, min: 1, max: 18, number: true },
      // habits: { required: true, min: 1, max: 18, number: true },
      // mixOfOccupations: { required: true, min: 1, max: 18, number: true },
      // activeInvolvement: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // motivesAndDrives: { required: true, min: 1, max: 18, number: true },
      // showsInterest: { required: true, min: 1, max: 18, number: true },
      // goalDirectedBehaviour: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // locusOfControl: { required: true, min: 1, max: 18, number: true },
      // commitmentToTaskSituation: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // usingFeedback: { required: true, min: 1, max: 18, number: true },
      // selfWorth: { required: true, min: 1, max: 18, number: true },
      // attitudeSelfAssurance: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // attitudeSelfSatisfaction: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // awarenessOfQualities: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // socialPresence: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // repertoireOfEmotions: {
      //   required: true,
      //   min: 1,
      //   max: 18,
      //   number: true,
      // },
      // emotionControl: { required: true, min: 1, max: 18, number: true },
      // moods: { required: true, min: 1, max: 18, number: true },
      group: { required: true },
    },
    submitHandler: function (form) {
      console.log("Form submitted successfully!");
      console.log($(form).serialize());
    },
  });

  //  Status Handle //

  $(document).on("click", ".changeStatus", function (event) {
    event.preventDefault();

    var status = $(this).attr("statusdata");
    var patient_id = $(this).attr("patient_id");
    if (status == 0) {
      var statusVal = "Inactive";
    } else {
      var statusVal = "Active";
    }
    swal({
      title: `Are you sure you want to ` + statusVal + ` this patient ?`,
      text: "If you " + statusVal + " this patient, Heshe will not be access.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willStatus) => {
      if (willStatus) {
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          method: "POST",
          url: base_url + "patient/change_status",
          data: { status: status, patient_id: patient_id },
          success: function (output) {
            if (output == true) {
              table.ajax.reload();
              toastr.success("status is changed");
            } else {
              toastr.error("status is not changed");
            }
          },
        });
      }
    });
  });

  $(document).on("click", ".remove_group", function () {
    var patient_id = $(this).attr("patient_id");
    var group_id = $(this).attr("group_id");
    var currentThis = $(this);
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      method: "POST",
      url: base_url + "patient/remove_patient_from_group",
      data: { patient_id: patient_id, group_id: group_id },
      success: function (output) {
        if (output == true) {
          $(currentThis).parent().parent().parent().remove();
          toastr.success("group removed");
        } else {
          toastr.error("group is not removed");
        }
      },
    });
  });

  $(document).on("click", "#delete_patient", function (event) {
    var userURL = $(this).data("url");
    event.preventDefault();
    swal({
      title: `Are you sure you want to delete this record?`,
      text: "If you delete this, it will be gone forever.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          method: "DELETE",
          url: userURL,
          dataType: "json",
          success: function (output) {
            if (output == true) {
              table.ajax.reload();
              toastr.success("Patient Dele  ted successfully !");
            } else {
              toastr.error(output);
            }
          },
        });
      }
    });
  });

  var urlSegments = window.location.pathname.split("/");
  var segmentToCheck = "patient_recovery_assessment";
  if (urlSegments.includes(segmentToCheck)) {
    $(document).on("change", "#selectOption", function () {
      var selectedOption = this.value;
      if (selectedOption) {
        window.location.href = selectedOption;
      }
    });
  }

  var urlSegments1 = window.location.pathname.split("/");
  var segmentToCheck1 = "patient_apom";
  if (urlSegments1.includes(segmentToCheck1)) {
    $(document).on("change", "#ApomselectOption", function () {
      var selectedOption = this.value;
      if (selectedOption) {
        window.location.href = selectedOption;
      }
    });
  }

  // var urlSegments1 = window.location.pathname.split("/");
  // var segmentToCheck1 = "patient_apom";

  var startTime; // Variable to store the start time
  var timerInterval; // Variable to store the timer interval

  function startTimer() {
    startTime = new Date().getTime(); // Get the current time in milliseconds
    timerInterval = setInterval(updateTimer, 1000); // Start the timer interval (1 second)
  }

  function updateTimer() {
    var currentTime = new Date().getTime(); // Get the current time in milliseconds
    var elapsedTime = currentTime - startTime; // Calculate the elapsed time
    var minutes = Math.floor(elapsedTime / 60000); // Convert milliseconds to minutes

    // Display the elapsed minutes in a span with the ID "timerDisplay"
    $("#timerDisplay").val(minutes + " minutes");
  }

  var isFormVisible = localStorage.getItem("formVisible");
  if (isFormVisible === "true") {
    var storedStartTime = localStorage.getItem("startTime");
    if (storedStartTime) {
      startTime = parseInt(storedStartTime, 10); // Convert stored time to milliseconds
      updateTimer(); // Update the timer display
      timerInterval = setInterval(updateTimer, 1000); // Continue the timer
    }
  }

  $(document).on("click", "#startTimer", function () {
    startTimer();
    localStorage.setItem("formVisible", "true");
    localStorage.setItem("startTime", startTime);
  });

  $("#groupSelect").focus(function () {
    // Hide or remove the error message
    $(".group-error").hide(); // or use $(".error-message").remove();
  });

  $(document).on("click", "#apomSubmit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    var selectedGroup = $("#groupSelect").val();
    if (selectedGroup) {
      $(".btn-submit").text("submiting...");
      clearInterval(timerInterval); // Stop the timer interval
      localStorage.removeItem("formVisible");
      localStorage.removeItem("startTime");

      var currentTime = new Date().getTime(); // Get the current time in milliseconds
      var elapsedTime = currentTime - startTime; // Calculate the elapsed time
      var minutes = Math.floor(elapsedTime / 60000); // Convert milliseconds to minutes

      // Display the elapsed minutes in a span with the ID "timerDisplay"
      $("#timerDisplay").val(minutes + " minutes");

      var formData = $("#APOMForm").serialize();

      // Make an AJAX POST request to submit the form
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: $("#APOMForm").attr("action"),
        method: "POST",
        data: formData,
        success: function (response) {
          if (response == true) {
            toastr.success("Patient APOM submited successfully !");
            window.location.href = base_url + "patient";
          } else {
            toastr.error(response);
            //window.location.href = base_url + "patient";
          }
        },
        error: function (error) {
          // Handle the error response here (if needed)
          console.error("Error submiting the form:", error);
        },
      });
    } else {
      $(".group-error").show();
      $(".group-error").html("Please select group");

      return false;
    }
  });

  $(document).on("click", "#updateapomSubmit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    $(".btn-submit").text("submiting...");
    clearInterval(timerInterval); // Stop the timer interval
    localStorage.removeItem("formVisible");
    localStorage.removeItem("startTime");

    var currentTime = new Date().getTime(); // Get the current time in milliseconds
    var elapsedTime = currentTime - startTime; // Calculate the elapsed time
    var minutes = Math.floor(elapsedTime / 60000); // Convert milliseconds to minutes

    // Display the elapsed minutes in a span with the ID "timerDisplay"
    $("#timerDisplay").val(minutes + " minutes");

    var formData = $("#APOMForm").serialize();

    // Make an AJAX POST request to submit the form
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: $("#APOMForm").attr("action"),
      method: "POST",
      data: formData,
      success: function (response) {
        if (response == true) {
          toastr.success("Patient APOM submited successfully !");
          window.location.href = base_url + "patient";
        } else {
          toastr.error(response);
          //window.location.href = base_url + "patient";
        }
      },
      error: function (error) {
        // Handle the error response here (if needed)
        console.error("Error submiting the form:", error);
      },
    });
  });
});

$(
  "#contact_number,#alternative_contact_number,#home_number,#work_number,#fax_number"
).intlTelInput({
  initialCountry: "ZA",
  separateDialCode: true,
  // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
});

var instance = $("[name=contact_number]");

$("[name=contact_number]").on("blur", function () {
  var instance = $("[name=contact_number]");

  var phoneNumber = instance.intlTelInput("getSelectedCountryData").dialCode;
  $("#country_code").val(phoneNumber);
});

$("[name=alternative_contact_number]").on("blur", function () {
  var instance = $("[name=alternative_contact_number]");

  var phoneNumber = instance.intlTelInput("getSelectedCountryData").dialCode;
  $("#alternative_country_code").val(phoneNumber);
});

$("[name=home_number]").on("blur", function () {
  var instance = $("[name=home_number]");

  var phoneNumber = instance.intlTelInput("getSelectedCountryData").dialCode;
  $("#home_country_code").val(phoneNumber);
});

$("[name=work_number]").on("blur", function () {
  var instance = $("[name=work_number]");

  var phoneNumber = instance.intlTelInput("getSelectedCountryData").dialCode;
  $("#work_country_code").val(phoneNumber);
});

$("[name=fax_number]").on("blur", function () {
  var instance = $("[name=fax_number]");

  var phoneNumber = instance.intlTelInput("getSelectedCountryData").dialCode;
  $("#fax_country_code").val(phoneNumber);
});

function initAutocomplete(id) {
  var res = id.split("_");
  geo = res[0];
  console.log(res);
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement} */
    (document.getElementById(id)),
    {
      types: ["geocode"],
    }
  );

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener("place_changed", fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  document.getElementById("address").value = place.formatted_address;
  // if($('#address').length){
  // }

  for (var i = 0; i < place.address_components.length; i++) {
    for (var j = 0; j < place.address_components[i].types.length; j++) {
      if (place.address_components[i].types[j] == "postal_code") {
        document.getElementById("postal_code").value =
          place.address_components[i].long_name;
      }

      if (place.address_components[i].types[j] == "country") {
        console.log(place.address_components[i].long_name);
        $("#country option").each(function () {
          var optionValue = $(this).val();

          if (optionValue == place.address_components[i].long_name) {
            $(this).prop("selected", true);
          }
        });
      }

      if (place.address_components[i].types[j] == "locality") {
        document.getElementById("city").value =
          place.address_components[i].long_name;
      }
    }
  }

  //alert(autocomplete.getPlace().geometry.location);false;
}

var type = $(".funder_type option:selected").val();

if (!$("#medical_scheme #insure #private").hasClass("d-none")) {
  $("#medical_scheme,#insure,#private").addClass("d-none");
}

if (type == "Medical Scheme") {
  $("#medical_scheme").removeClass("d-none");
}

if (type == "Insurer") {
  $("#insure").removeClass("d-none");
}

if (type == "Private") {
  $("#private").removeClass("d-none");
}
$(document).on("change", ".funder_type", function () {
  var type = $(this).val();
  if (!$("#medical_scheme #insure #private").hasClass("d-none")) {
    $("#medical_scheme,#insure,#private").addClass("d-none");
  }

  if (type == "Medical Scheme") {
    $("#medical_scheme").removeClass("d-none");
  }

  if (type == "Insurer") {
    $("#insure").removeClass("d-none");
  }

  if (type == "Private") {
    $("#private").removeClass("d-none");
  }
});

$(document).ready(function () {
  $("#changePass").validate({
    rules: {
      current_password: {
        required: true,
        minlength: 8,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "admin/patient/check_current_password_is_correct",
          method: "POST",
          data: {
            current_password: function () {
              return $("input[name='current_password']").val();
            },
            id: function () {
              return $("input[name='id']").val();
            },
          },
        },
      },
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
      current_password: {
        required: "Please enter a current password",
        minlength: "Password must be at least 8 characters long",
        remote: "The current password is incorrect.",
      },
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

$(document).on("click", "#dischargeCheck", function () {
  var url = $(this).attr("url");
  var totalAttendence = $(this).attr("totalAttendence");
  var totalSession = $(this).attr("totalSession");
  $("#dischargeUrl").attr("href", url);
  $("#totalAttendence").html(totalAttendence);
  $("#totalSession").html(totalSession);
});


