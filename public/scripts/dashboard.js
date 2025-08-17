const editUserModal = document.getElementById('editUserModal');
editUserModal.addEventListener('show.bs.modal', function (event) {
    let button = event.relatedTarget;

    let id = button.dataset.id;
    let name = button.dataset.name;
    let email = button.dataset.email;
    let avatar = button.dataset.avatar;

    console.log("Opening modal for user:", id, name, email, avatar);

    document.getElementById('editUserId').value = id;
    document.getElementById('editUserName').value = name;
    document.getElementById('editUserEmail').value = email;

    let preview = document.getElementById('editUserAvatarPreview');
    preview.src = avatar && avatar.trim() !== ""
        ? `/uploads/avatars/${avatar}`
        : "/uploads/avatars/default.png";

    document.getElementById('editUserForm').action = `/user/${id}/update`;
});



const avatarInput = document.querySelector('#editUserForm input[name="avatar"]');
const avatarPreview = document.getElementById('editUserAvatarPreview');

avatarInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            avatarPreview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    } else {
        // اگر هیچ فایلی انتخاب نشد، عکس پیش‌فرض
        avatarPreview.src = '/uploads/avatars/default.png';
    }
});