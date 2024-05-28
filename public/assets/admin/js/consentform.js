$("#consentForm").validate({
  rules: {
    avatar: { required: true, accept: "image/*" },
    first_name: { required: true },
    last_name: { required: true },
    date_of_birth: { required: true },
    profession: { required: true },
    email: {
      required: true,
      email: true,
      remote: {
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: base_url + "admin/doctor/check_email_is_already",
        method: "POST",
        data: {
          email: function () {
            return $("input[name='email']").val();
          },
        },
      },
    },
    identity_number: {
      required: true,
      number: true,
      minlength: 13,
      maxlength: 13,
      remote: {
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: base_url + "admin/doctor/check_identity_number_is_already",
        method: "POST",
        data: {
          identity_number: function () {
            return $("input[name='identity_number']").val();
          },
        },
      },
    },
    password: { required: true, min: 6 },
    gender: { required: true },
    contact_number: { required: true, number: true },
  },
  messages: {
    avatar: {
      required: "Please upload avatar",
      accept: "Please upload avtar in jpg,png,jpeg format",
    },
    first_name: { required: "Please enter first name" },
    last_name: { required: "Please enter last name" },
    profession: { required: "Please enter profession" },
    date_of_birth: { required: "Please select date of birth" },
    email: {
      required: "Please enter email",
      email: "Please enter vaild email",
      remote: "Email is already exist",
    },
    identity_number: {
      required: "Please enter identity number",
      number: "Identity number must be only digit",
      minlength: "Please enter 13 digit Identity number",
      maxlength: "Please enter 13 digit Identity number",
      remote: "Identity number is already exist",
    },
    password: {
      required: "Please enter password",
      min: "Password must be minimum 6 and more character",
    },
    gender: { required: "Please enter gender" },
    contact_number: {
      required: "Please enter contact number",
      number: "Please enter only digit",
    },
  },
});
