<!-- @for($i = 1; $i <= $total_sessoin; $i++) <div class="col-12 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 position-relative">
    <label class="required fw-bold fs-6 mb-2">Session name</label>
    <input type="text" name="session_name[]" class="form-control session_name">
    <span class="availdocerror"></span>
    <span class=" sessionremove"><i class="fa fa-close"></i></span>

    </div>
    @endfor -->

<div>
    <h4>Schedule :-</h4>
    <div class="d-flex flex-wrap history-check">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="schedule[]" value="Monday" id="Monday">
            <label for="Monday">Every Monday</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="schedule[]" value="Tuesday" id="Tuesday">
            <label for="Tuesday">Every Tuesday</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="schedule[]" value="Wednesday" id="Wednesday">
            <label for="Wednesday">Every Wednesday</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="schedule[]" value="Thursday" id="Thursday">
            <label for="Thursday">Every Thursday</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="schedule[]" value="Friday" id="Friday">
            <label for="Friday">Every Friday</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="schedule[]" value="Saturday" id="Saturday">
            <label for="Saturday">Every Saturday</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="schedule[]" value="Sunday" id="Sunday">
            <label for="Sunday">Every Sunday</label>
        </div>




















    </div>
    <label id="schedule[]-error" class="error" for="schedule[]"></label>
</div>