<?php
require '../../connect.php';
?>

<div class="card border-0 shadow-sm rounded-4 mt-4 mx-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-pink">Add Language</h5>
        <button onclick="showlanguage()" class="btn btn-outline-secondary border-0 btn-sm">
            <i class="fa fa-arrow-left"></i> Back
        </button>
    </div>
    
    <div class="card-body p-4">
        <form id="addLanguageForm">
            <div class="mb-3">
                <label class="form-label small fw-bold">Language Name</label>
                <input type="text" class="form-control rounded-pill px-3" name="language" placeholder="Enter language name" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-bold">Status</label>
                <select name="status" class="form-select rounded-pill px-3" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="button" onclick="insert_language()" class="btn btn-pink w-100 rounded-pill py-2 fw-bold mt-3 shadow-sm">
                Create Language
            </button>
        </form>
    </div>
</div>

<script>
function insert_language() {
    const data = $('#addLanguageForm').serialize();
    $.ajax({
        type: 'GET',
        data: "id=0&" + data,
        url: '/rythm/professional_singer/language/language_submit.php',
        success: function (data) {
            alert("Language Added Successfully");
            showlanguage();
        }
    });
}
</script>

