$(function ($) {
    var obj = {};

    obj.pending_services_list = $("#pending_service").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "ajax_user/get_pending_details_for_table",
            data: {
                user_type: function () {
                    return $("#user_type").text();
                },
            },
        },
        deferRender: true,
        order: [[0, "asc"]],
        columns: [
            { data: "ref_no", sClass: "text-center" },
            { data: "computer_name" },
            { data: "complaint_type", sClass: "caps" },
            { data: "complaint" },
            { data: "complaint_details" },
            { data: "unit_status", sClass: "caps" },
            { data: "datetime_reported" },
        ],
        columnDefs: [
            {
                data: "unit_status",
                targets: -2,
                sortable: false,
                render: function (data, type, row) {
                    if (row.unit_status == "under warranty") {
                        return "<span class='label label-info'>To Be Replaced</span>";
                    }

                    if (row.unit_status == "close") {
                        return "<span class='label label-success'>Resolved</span>";
                    }

                    if (row.unit_status == "repaired") {
                        return "<span class='label label-warning'>Repaired</span>";
                    }

                    if (row.unit_status == "under repair") {
                        return "<span class='label label-danger'>Under Repair</span>";
                    }

                    return `<span class='label label-default'>${row.unit_status}</span>`;
                },
            },
        ],
        fnRowCallback: function (
            nRow,
            aData,
            iDisplayIndex,
            iDisplayIndexFull
        ) {
            var urgent = aData["is_urgent"];

            if (urgent === "1") {
                $(nRow).addClass("bg-lightBlue");
            }
        },
        initComplete: function () {
            $("select#status").prependTo("#pending_service_filter");
        },
        language: {
            processing:
                '<div class="processing-wrapper"> \
                            <div><i class="fa fa-spinner fa-spin"></i> Fetching ... Please wait...</div> \
                        </div>',
            emptyTable: "No service reports available",
            zeroRecords: "No service reports available",
            infoFiltered: "",
        },
    });

    $("select#status").on("change", function () {
        const selectedValue = $(this).val();
        obj.pending_services_list.column(6).search(selectedValue).draw();
    });
});
