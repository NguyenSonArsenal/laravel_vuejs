$(document).ready(function () {
    console.log('Backend js is working in common.js');

    $('#dataTables').DataTable({
        "searching": false, // Search Box will Be Disabled
        "info": true, // Will show "1 to n of n entries" Text at bottom
        "lengthChange": true, //  Will Disabled Record number per page
        "pageLength": 25,
        "paging": true, // show paging
        "language": {
            "paginate": {
                "next":       "Sau",
                "previous":   "Trước"
            },
            "lengthMenu": "Hiển thị _MENU_ bản ghị mỗi trang",
            "emptyTable":     "Không có dữ liệu để hiển thị",
            "info":           "Hiển thị _START_ tới _END_ của _TOTAL_ bản ghi",
            "infoEmpty":      "Hiển thị 0 tới 0 của 0 bản ghi",
        }
    });

    CommonController.init();
});

var CommonController = {
    init: function () {
        CommonController.submitForm();
        CommonController.handleClickShowModalConfirmDelete();
    },

    submitForm: function () {
        $('form').on('submit', function () {
            $.LoadingOverlay("show", {zIndex: 999999999});
            return true;
        });
    },

    handleClickShowModalConfirmDelete: function() {
        $('.model_confirm_delete').on('click', function () {
            var action = $(this).data('form-action');
            $('#model_confirm_delete .form_confirm_delete').attr('action', action);
        });
    },
};

function showLoading() {
    $.LoadingOverlay("show", {zIndex: 999999999});
}

function hideLoading() {
    $.LoadingOverlay("hide");
}

function ajaxOk(response) {
    return response.data.code == 200
}


// ========== LOCAL STORAGE ==========
function setLocalStorage(key, value = '') {
    localStorage.setItem(key, value);
}

function getLocalStorage(key) {
    return localStorage.getItem(key);
}

function removeLocalStorage(key) {
    localStorage.removeItem(key);
}
// ========== LOCAL STORAGE ==========
