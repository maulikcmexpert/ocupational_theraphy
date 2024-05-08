$(function () {
  const base_url = $("#base_url").val();

  var table = $(".data-table").DataTable({
    processing: true,
    serverSide: true,
    order: [[0, "desc"]],
    ajax: base_url + "admin/staff",
    columns: [
      { data: "number", name: "number" },
      { data: "name", name: "name" },
      { data: "email", name: "email" },
      {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false,
      },
    ],
  });

  $("#staffForm").validate({
    rules: {
      avatar: { required: true, accept: "image/*" },
      first_name: { required: true },
      email: {
        required: true,
        email: true,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "admin/staff/check_email_is_already",
          method: "POST",
          data: {
            email: function () {
              return $("input[name='email']").val();
            },
            id: function () {
              return $("input[name='id']").val();
            },
          },
        },
      },
      password: { required: true, minlength: 6 },
    },
    messages: {
      first_name: { required: "Please enter full name" },
      email: {
        required: "Please enter email",
        email: "Please enter valid email",
        remote: "Email is already exist",
      },
      password: {
        required: "Please enter password",
        minlength: "Password must be 6 or greater than 6 character",
      },
      avatar: {
        required: "Please upload avatar",
        accept: "Please upload avtar in jpg,png,jpeg format",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#updatestaffForm").validate({
    rules: {
      avatar: { accept: "image/*" },
      first_name: { required: true },
      email: {
        required: true,
        email: true,
        minlength: 6,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "admin/staff/check_email_is_already",
          method: "POST",
          data: {
            email: function () {
              return $("input[name='email']").val();
            },
            id: function () {
              return $("input[name='id']").val();
            },
          },
        },
      },
      password: { required: true },
    },
    messages: {
      first_name: { required: "Please enter full name" },
      email: {
        required: "Please enter email",
        email: "Please enter valid email",
        remote: "Email is already exist",
      },
      password: {
        required: "Please enter password",
        minlength: "Password must be 6 or greater than 6 character",
      },
      avatar: {
        accept: "Please upload avtar in jpg,png,jpeg format",
      },
    },
  });

  $(document).on("click", "#delete_staff", function (event) {
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
              toastr.success("Doctor Deleted successfully !");
            } else {
              toastr.error("Doctor don't Deleted !");
            }
          },
        });
      }
    });
  });
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
          url: base_url + "admin/staff/check_current_password_is_correct",
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
