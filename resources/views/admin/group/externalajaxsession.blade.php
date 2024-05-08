@for($i = 1; $i <= $total_sessoin; $i++) <div class="row mt-5 position-relative">

    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
        <label class="required fw-bold fs-6 mb-2">Start Session Date</label>
        <input type="text" name="start_session_date[]" class="form-control form-control-solid mb-3 mb-lg-0 external_start_session_date" placeholder="Start Session Date" value="" autocomplete="off">
        <span class="availdocerror"></span>
    </div>

    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
        <label class="required fw-bold fs-6 mb-2">Session name</label>
        <input type="text" name="session_name[]" class="form-control session_name">
        <span class="availdocerror"></span>
    </div>
    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
        <label class="fw-bold fs-6 mb-2">start Time</label>
        <input type="time" name="start_time[]" class="form-control start_time">
        <span class="availdocerror"></span>
    </div>
    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
        <label class="fw-bold fs-6 mb-2">End Time</label>
        <input type="time" name="end_time[]" class="form-control end_time">
        <span class="availdocerror"></span>
    </div>
    <span class=" externalsessionremove"><i class="fa fa-close"></i></span>

    </div>

    @endfor

    <script>
        $(".external_start_session_date").datepicker({
            dateFormat: "yy-mm-dd",
            autoclose: true,
            minDate: 0, // Set minDate to 0 to disable dates before today
            daysOfWeekDisabled: [0, 6],
            todayHighlight: true,
        });
        $("form").submit(function(e) {
            $(".availdocerror").text(""); // Clear previous error messages

            // Validate each field
            $(".external_start_session_date").each(function() {
                if ($(this).val() === "") {
                    $(this).next(".availdocerror").text("Please select session date");
                    e.preventDefault(); // Prevent form submission
                }
            });
            $(".session_name").each(function() {
                if ($(this).val() === "") {
                    $(this).next(".availdocerror").text("Please enter session name");
                    e.preventDefault(); // Prevent form submission
                }
            });
            $(".start_time").each(function() {
                if ($(this).val() === "") {
                    $(this).next(".availdocerror").text("Please enter start time");
                    e.preventDefault(); // Prevent form submission
                }
            });
            $(".end_time").each(function() {
                if ($(this).val() === "") {
                    $(this).next(".availdocerror").text("Please enter end time");
                    e.preventDefault(); // Prevent form submission
                }
            });
        });

        $(document).on("change keyup", ".start_time", function() {
            var outerThis = $(this); //
            $(this).on("focus", function() {
                $(this)
                    .next("span")
                    .text("") // Remove error message
                    .removeClass("text-danger"); // Remove text-danger class
            });
            var startDate = $(".start_session_date").val();
            var group_type = $("#group_type").val();
            var doctor_id = "";
            if (group_type == "external") {
                doctor_id = $("#externalDoctor").val();
            } else {
                doctor_id = $(this).parent().prev().find(".doctor_id").val();
            }

            var start_time = $(this).val();
            var end_time = $(this).parent().next().find(".end_time").val();

            if (start_time < end_time) {
                $(outerThis).siblings(".availdocerror").text("");

                return checkDoctorAvailable(
                    outerThis,
                    doctor_id,
                    start_time,
                    end_time,
                    startDate
                );
            } else {
                if (start_time.length != 0 && end_time.length != 0) {
                    $(outerThis)
                        .siblings(".availdocerror")
                        .text("start time should be less than end time")
                        .addClass("text-danger");
                }
                errordoctorAssign = 1;
                return errordoctorAssign;
            }
        });

        $(document).on("change keyup", ".end_time", function() {
            var outerThis = $(this); //
            $(this).on("focus", function() {
                $(this)
                    .next("span")
                    .text("") // Remove error message
                    .removeClass("text-danger"); // Remove text-danger class
            });
            var end_time = $(this).val();
            var startDate = $(".start_session_date").val();
            var start_time = $(this).parent().prev().find(".start_time").val();
            var group_type = $("#group_type").val();
            var doctor_id = "";
            if (group_type == "external") {
                doctor_id = $("#externalDoctor").val();
            } else {
                doctor_id = $(this).parent().prev().prev().find(".doctor_id").val();
            }

            console.log(doctor_id);
            console.log(start_time);
            console.log(end_time);

            if (end_time > start_time) {
                return checkDoctorAvailable(
                    outerThis,
                    doctor_id,
                    start_time,
                    end_time,
                    startDate
                );
            } else {
                if (start_time.length != 0 && end_time.length != 0) {
                    $(outerThis)
                        .siblings(".availdocerror")
                        .text("End time should be grater than start time")
                        .addClass("text-danger");

                    errordoctorAssign = 1;
                    return errordoctorAssign;
                }
            }
        });
    </script>