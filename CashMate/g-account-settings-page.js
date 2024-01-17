document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.querySelector('input[name="profile-photo"]');
    const labelUploadPhoto = document.querySelector('.label-upload-photo');
    const profilePhoto = document.querySelector('.username-pic img');

    fileInput.addEventListener('change', function (event) {
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                profilePhoto.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);

            labelUploadPhoto.textContent = 'Change Profile Photo';
        }
    });

    fileInput.addEventListener('click', function () {
        this.value = null;
        labelUploadPhoto.textContent = 'Update Profile Photo';
    });
    
    // Edit Name and Email
    document.querySelector('#edit-name-btn').addEventListener('click', function () {
        const nameField = document.querySelector('#name');
        const newName = prompt('Enter new name:', nameField.textContent.trim());

        if (newName !== null && newName !== '') {
            nameField.textContent = newName;
        }
    });

    document.querySelector('#edit-email-btn').addEventListener('click', function () {
        const emailField = document.querySelector('#email');
        const newEmail = prompt('Enter new email:', emailField.textContent.trim());

        if (newEmail !== null && newEmail !== '') {
            emailField.textContent = newEmail;
        }
    });

    // Update Password
    document.querySelector('#update-password-btn').addEventListener('click', function () {
        const currentPassword = prompt('Enter current password:');
        if (currentPassword !== null && currentPassword !== '') {
            alert('Password updated successfully!');
        } else {
            alert('Password update failed. Please enter the correct current password.');
        }
    });

    // Delete Account
    document.querySelector('#delete-account-btn').addEventListener('click', function () {
        const confirmDelete = confirm('Are you sure you want to delete your account?');
        if (confirmDelete) {
            alert('Account deleted successfully!');
        }
    });

    // Sign Out
    document.querySelector('#sign-out-btn').addEventListener('click', function () {
        alert('Signed out successfully!');
    });
});
