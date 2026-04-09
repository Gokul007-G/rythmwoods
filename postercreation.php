<?php
/**
 * Rythm Poster Creation - Unified Professional Version
 */
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: /rythm/login/login.php");
    exit();
}

$pageTitle = "Rythm - Create Post";
$rolemaster_id = $_SESSION['role_master_id'];
$user_name = $_SESSION['user_name'];

include("includes/header.php");
?>

<div class="feed-area">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
        <div class="card-header bg-white border-0 p-4">
            <h4 class="mb-0 fw-bold text-center">Upload Poster or Video</h4>
            <div class="mx-auto mt-2" style="width: 100px; height: 4px; background: var(--rythm-pink); border-radius: 2px;"></div>
        </div>
        
        <div class="card-body p-4">
            <form id="postUploadForm" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="form-label fw-bold">Post Type</label>
                    <select id="poster_type" name="poster_type" class="form-select rounded-pill px-3 border-light bg-light" required>
                        <option value="">-- Choose Type --</option>
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                    </select>
                </div>

                <!-- Upload Area -->
                <div id="uploadZone" class="mb-4 d-flex flex-column align-items-center justify-content-center border border-2 border-dashed rounded-4 p-5 cursor-pointer hover-bg-light position-relative" 
                     style="min-height: 200px; border-color: var(--rythm-pink) !important;" onclick="document.getElementById('fileInput').click();">
                    
                    <div id="uploadPlaceholder" class="text-center">
                        <i class="fa fa-cloud-upload fs-1 mb-3" style="color: var(--rythm-pink);"></i>
                        <p class="mb-0 fw-bold">Click to upload media</p>
                        <small class="text-muted">JPG, PNG, MP4 supported</small>
                    </div>

                    <div id="previewContainer" class="d-none w-100 h-100 d-flex align-items-center justify-content-center">
                        <img id="imagePreview" class="img-fluid rounded-3 d-none" style="max-height: 400px;">
                        <video id="videoPreview" class="w-100 rounded-3 d-none" controls style="max-height: 400px;"></video>
                    </div>

                    <input type="file" id="fileInput" name="upload_file" class="d-none" accept="image/*,video/*" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Caption</label>
                    <textarea id="caption" name="posters_caption" class="form-control rounded-4 border-light bg-light p-3" rows="3" placeholder="What's on your mind?"></textarea>
                    <div id="wordCount" class="text-end small text-muted mt-1">0 / 20 words</div>
                </div>
                <div class="mb-4">   
                    <label for="posters_hashtag" class="form-label fw-bold">Hashtag</label>
                    <input type="text" id="posters_hashtag" name="posters_hashtag" class="form-control rounded-pill px-3 border-light bg-light" placeholder="Enter hashtags separated by spaces">     
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Location</label>
                    <input type="text" name="location" class="form-control rounded-pill px-3 border-light bg-light" placeholder="Add location">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-pink w-100 rounded-pill py-2 fw-bold shadow-sm" id="submitBtn">
                        <span id="btnText">Save Post</span>
                        <div id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
// Include Right Panel for Home-like feel
include("includes/right_panel.php"); 
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#fileInput').on('change', function(e) {
        const file = e.target.files[0];
        if(!file) return;

        $('#uploadPlaceholder').addClass('d-none');
        $('#previewContainer').removeClass('d-none');

        if(file.type.startsWith('image/')) {
            $('#imagePreview').removeClass('d-none').attr('src', URL.createObjectURL(file));
            $('#videoPreview').addClass('d-none');
        } else if(file.type.startsWith('video/')) {
            $('#videoPreview').removeClass('d-none').attr('src', URL.createObjectURL(file));
            $('#imagePreview').addClass('d-none');
        }
    });

    $('#caption').on('input', function() {
        const words = this.value.trim().split(/\s+/).filter(w => w.length > 0).length;
        $('#wordCount').text(`${words} / 20 words`);
        if(words > 20) {
            this.setCustomValidity("Maximum 20 words allowed");
        } else {
            this.setCustomValidity("");
        }
    });

    $('#posters_hashtag').on('input', function() {
        const hashtags = this.value.trim().split(/\s+/).filter(h => h.startsWith('#')).length;
        if(hashtags > 5) {
            this.setCustomValidity("Maximum 5 hashtags allowed");
        } else {
            this.setCustomValidity("");
        }
    });

    $('#postUploadForm').on('submit', function(e) {
        e.preventDefault();
        
        const type = $('#poster_type').val();
        if(!type) {
            alert("Please select post type");
            return;
        }

        const formData = new FormData(this);
        
        // UI Feedback
        $('#btnText').addClass('d-none');
        $('#btnSpinner').removeClass('d-none');
        $('#submitBtn').prop('disabled', true);

        const targetUrl = (type === 'video') ? "/rythm/save_video.php" : "/rythm/save_posters.php";
        
        $.ajax({
            url: targetUrl,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response == 1) {
                    alert("Post created successfully!");
                    window.location.href = "home.php";
                } else {
                    alert("Failed to save post. Please check media format.");
                    $('#btnText').removeClass('d-none');
                    $('#btnSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                }
            },
            error: function() {
                alert("Server error occurred.");
                $('#btnText').removeClass('d-none');
                $('#btnSpinner').addClass('d-none');
                $('#submitBtn').prop('disabled', false);
            }
        });
    });
</script>

<?php include("includes/footer.php"); ?>