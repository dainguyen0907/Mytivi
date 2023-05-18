$(document).ready(function () {
    $("#popup_change_password").submit(function (e) {
        e.preventDefault();
        var oldpass = $("#oldpassword").val();
        var newpass = $("#password").val();
        var repass = $("#password_confirm").val();

        if (newpass != repass) {
            $("#popup_change_password").modal('hide');
            toastr.warning("Xác nhận mật khẩu không chính xác !");
        }
        else {
            $.ajax({
                url: "./changePassword",
                type: "POST",
                data: {
                    "oldpassword": oldpass,
                    "password": newpass,
                    "password_confirm": repass
                },
                success: function (data) {
                    switch(data){
                        case 'SessionMissing': {
                            $("#changePasswordModal").modal('hide');
                            toastr.error("Lỗi không tìm thấy session !");
                            break;
                        }
                        case 'AuthMissing': {
                            $("#changePasswordModal").modal('hide');
                            toastr.error("Lỗi không tìm thấy tài khoản!");
                            break;
                        }
                        case 'WrongPassword': {
                            toastr.warning("Mật khẩu không đúng");
                            break;
                        }
                        case 'Success': {
                            $("#changePasswordModal").modal('hide');
                            toastr.success("Cập nhật thành công");
                            break;
                        }
                        default:{
                            toastr.warning("Mật khẩu từ 6 đến 30 ký tự");
                            break;
                        }
                    }
                }
            });
        }
    });
    $('#changePasswordModal').on('hidden.bs.modal', function (e) {
        $(this)
          .find("input,textarea,select")
             .val('')
             .end()
      })
})
