const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
});

function btnDelete(token, url) {
    Swal.fire({
        title: "Konfirmasi Hapus",
        text: "Apakah Anda yakin ingin menghapus?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete it!",
        cancelButtonText: "Cancel!",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: token,
                    _method: "DELETE",
                },
                cache: false,
                success: function (response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "File berhasil terhapus.",
                        icon: "success",
                    }).then(() => {
                        window.location.href = response.success;
                    });
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "Error!",
                        text:
                            xhr.responseJSON.message || "Something went wrong.",
                        icon: "error",
                    });
                },
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: "Cancelled",
                text: "Your file is safe :)",
                icon: "error",
            });
        }
    });
}
function formAjaxPost(formSelector) {
    const form = $(formSelector);
    const url = form.attr("action");
    const method = form.attr("method");
    const formData = form.serialize();
    $.ajax({
        type: method,
        url: url,
        data: formData,
        cache: false,
        success: function (response) {
            swalWithBootstrapButtons.fire({
                title: "Success!",
                text: "berhasil ditambahkan.",
                icon: "success",
            });
        },
        error: function (xhr, status, error) {
            swalWithBootstrapButtons.fire({
                title: "Error!",
                text: xhr.responseJSON.message || "Something went wrong.",
                icon: "error",
            });
        },
    });
}
function formAjaxGet(url) {
    $.ajax({
        type: "GET",
        url: url,
        cache: false,
        success: function (response) {},
        error: function (xhr, status, error) {
            swalWithBootstrapButtons.fire({
                title: "Error!",
                text: xhr.responseJSON.message || "Something went wrong.",
                icon: "error",
            });
        },
    });
}

function formLoader(form) {
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah form dikirim secara default

        Swal.fire({
            title: "Loading...",
            html: "Please wait while we process your request.",
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                form.submit();
            },
        });
    });
}
