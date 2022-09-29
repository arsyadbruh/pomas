// assign user to task
$(document).ready(function () {
    $("select#assign-user").change(function () {
        let data_id = $(this).find(".task-option-id").val();
        let selectedData = $(this).val();
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/taskAssign",
            data: {
                data_id: data_id,
                selected: selectedData,
            },
            success: function (data) {
                console.log("success change status");
            },
        });
    });
});

// change user role
$(document).ready(function () {
    $("select#user-role").change(function () {
        let data_id = $(this).find(".task-option-id").val();
        let selectedData = $(this).val();
        let selectedText = $(this).find("option:selected").text();
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/updateRole",
            data: {
                project_id: data_id,
                selectedUser: selectedData,
                selectedRole: selectedText,
            },
            success: function (data) {
                console.log("success change status");
            },
        });
    });
});

// update status task
$(function () {
    $(".cekbox").change(function (event) {
        let statusChecked = $(this).is(":checked");
        let isCheck = statusChecked ? 1 : 0;
        let data_id = $(this).val();
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/taskupdate",
            data: {
                status: isCheck,
                data_id: data_id,
            },
        });

        let toastLiveChecked = document.getElementById("liveToastChecked");
        let toastLiveUnCheck = document.getElementById("liveToastUnCheck");

        let toast = new bootstrap.Toast(toastLiveChecked);
        let toastUn = new bootstrap.Toast(toastLiveUnCheck);

        if (statusChecked) {
            toast.show();
        } else {
            toastUn.show();
        }
    });
});

// date picker
$(function () {
    $("#taskDatepicker").datepicker({
        format: "yyyy/mm/dd",
        weekStart: 0,
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
    });
});
