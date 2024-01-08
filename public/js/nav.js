// Toggole Password

function togglePasswordVisibility(inputId) {
    const passwordInput = document.getElementById(inputId);
    const passwordToggleIcon = document.querySelector(`[onclick="togglePasswordVisibility('${inputId}')"]`);
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggleIcon.classList.remove('fa-eye-slash');
        passwordToggleIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        passwordToggleIcon.classList.remove('fa-eye');
        passwordToggleIcon.classList.add('fa-eye-slash');
    }
}

/// Delete Profile Modal
$(document).ready(function () {
    $('.deletebtn').on('click', function () {
        $('#deletemodal').modal('show');
    });
});

/// Update profile Modal
$(document).ready(function () {
    $(".updatebtn").on("click", function () {
        $("#updateprofilemodal").modal("show");
    });
});

/// Preview Image before Updating
function updateImagePreview() {
    const fileInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
        imagePreview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        imagePreview.src = 'assets/images/campusdotcrew.png';
    }
}
