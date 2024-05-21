function date_picker($date, id, position) {
    var _datepicker = $(id)
        .datepicker({
            changeMonth: true,
            changeYear: true,
            position: position,
            language: "en",
            altField: id,
        })
        .data("datepicker");

    set_datepicker(_datepicker, $date);
}

function set_datepicker($value, $date) {
    $value.selectDate(new Date($date));
}

function set_report_title(title, date_from, date_to) {
    $(document).prop(
        "title",
        title + "Report as of " + date_from + " - " + date_to
    );
}

function ajax_get_complaint_by_type(id, value) {
    var $complaint = $(id);

    return $.ajax({
        url: "ajax_service_order/get_complaint_details/" + value,
        type: "get",
        dataType: "json",
        beforeSend: function () {
            var $loader = $("<option />");

            $loader
                .attr("value", "")
                .text("Fetching...")
                .prop("selected", true);

            $complaint.append($loader);
        },
        success: function (result) {
            if (result instanceof Array) {
                var $select = $("<option />");
                $select.attr("value", "").text("Select Complaint");

                $complaint.empty();
                $complaint.append($select);

                $.each(result, function (index, value) {
                    var $option = $("<option />");

                    $option
                        .attr("value", result[index].resource_id)
                        .text(result[index].resource_name);
                    $complaint.append($option);
                });
            }
            $(".complaint").show();
            $(".complaint2").remove();
        },
        error: function (xhr, status) {
            alert(xhr.responseText);
        },
    });
}

function get_all_user_details_of_admin_encoder(id) {
    var $select_option = $(id);

    return $.ajax({
        url: "ajax_user/get_all_user_details_of_admin_encoder",
        type: "get",
        dataType: "json",
        beforeSend: function () {
            var $loader = $("<option />");

            $loader
                .attr("value", "")
                .text("Fetching...")
                .prop("selected", true);

            $select_option.append($loader);
        },
        success: function (result) {
            if (result instanceof Array) {
                var $select = $("<option />");
                $select.attr("value", "").text("Select TSG Personnel");

                $select_option.empty();
                $select_option.append($select);

                $.each(result, function (index, value) {
                    var $option = $("<option />");

                    $option
                        .attr("value", result[index].id)
                        .text(
                            result[index].firstname +
                                " " +
                                result[index].lastname
                        );
                    $select_option.append($option);
                });
            }
        },
        error: function (xhr, status) {
            alert(xhr.responseText);
        },
    });
}

function get_all_user_details_of_admin() {
    var $assisted_by = $("#user_id");

    return $.ajax({
        url: "ajax_user/get_all_user_details_of_admin",
        type: "get",
        dataType: "json",
        beforeSend: function () {
            var $loader = $("<option />");

            $loader
                .attr("value", "")
                .text("Fetching...")
                .prop("selected", true);

            $assisted_by.append($loader);
        },
        success: function (result) {
            if (result instanceof Array) {
                var $select = $("<option />");
                $select.attr("value", "").text("Select TSG Personnel");

                $assisted_by.empty();
                $assisted_by.append($select);

                $.each(result, function (index, value) {
                    var $option = $("<option />");

                    $option
                        .attr("value", result[index].id)
                        .text(
                            result[index].firstname +
                                " " +
                                result[index].lastname
                        );
                    $assisted_by.append($option);
                });
            }
        },
        error: function (xhr, status) {
            alert(xhr.responseText);
        },
    });
}

function ajax_get_computer(cluster_id) {
    var $computer = $("#computer_name");

    return $.ajax({
        url: "ajax_computer/get_computer_details_for_service_order",
        type: "get",
        dataType: "json",
        data: { cluster_id: cluster_id },
        beforeSend: function () {
            var $loader = $("<option />");

            $loader
                .attr("value", "")
                .text("Fetching...")
                .prop("selected", true);

            $computer.append($loader);
        },
        success: function (result) {
            $computer.empty();

            if (result instanceof Array && result.length > 0) {
                var $select = $("<option />");
                $select.attr("value", "NA").text("Not Applicable");

                $computer.append($select);

                var groups = {
                    department: $('<optgroup label="Department"></optgroup>'),
                    office: $('<optgroup label="Office"></optgroup>'),
                    laboratory: $('<optgroup label="Laboratory"></optgroup>'),
                    lecture: $('<optgroup label="Lecture"></optgroup>'),
                };
                $.each(result, function (index, value) {
                    var computer = result[index];

                    var $option = $("<option />");
                    $option
                        .attr("value", result[index].computer_name)
                        .text(result[index].computer_name);

                    groups[computer.designation_type].append($option);
                });

                Object.keys(groups).forEach((groupKey) => {
                    if (groups[groupKey].children().length) {
                        $computer.append(groups[groupKey]);
                    }
                });
            } else {
                var $select = $("<option />");
                $select
                    .attr({
                        value: "NA",
                        disabled: true,
                        selected: true,
                    })
                    .text("No computers assigned to selected designation");

                $computer.append($select);
            }
        },
        error: function (xhr, status) {
            alert(xhr.responseText);
        },
    });
}

function ajax_get_clusters() {
    var $cluster_id = $("#cluster_id");

    return $.ajax({
        url: "ajax_cluster/get_all_cluster_details",
        type: "get",
        dataType: "json",
        beforeSend: function () {
            var $loader = $("<option />");

            $loader
                .attr("value", "")
                .text("Fetching...")
                .prop("selected", true);

            $cluster_id.append($loader);
        },
        success: function (result) {
            if (result instanceof Array) {
                var $select = $("<option />");
                $select
                    .attr({
                        value: "",
                        disabled: "",
                        selected: "",
                    })
                    .text("Select Department/Office");

                $cluster_id.empty();
                $cluster_id.append($select);

                $.each(result, function (index, value) {
                    var $option = $("<option />");

                    $option
                        .attr("value", result[index].cluster_id)
                        .text(
                            result[index].cluster_code +
                                " - " +
                                result[index].cluster_name
                        );
                    $cluster_id.append($option);
                });
            }
        },
        error: function (xhr, status) {
            alert(xhr.responseText);
        },
    });
}

function ajax_get_classroom_designation_for_computer(
    type,
    designationId = "designation"
) {
    var $room = $("#" + designationId);

    return $.ajax({
        url: "ajax_classroom/get_classroom_details_by_type/" + type,
        type: "get",
        dataType: "json",
        beforeSend: function () {
            var $loader = $("<option />");

            $loader
                .attr("value", "")
                .text("Fetching...")
                .prop("selected", true);

            $room.append($loader);
        },
        success: function (result) {
            console.log("result", result);
            if (result instanceof Array) {
                var $select = $("<option />");

                $room.empty();

                $.each(result, function (index, value) {
                    var $option = $("<option />");

                    var room = result[index];
                    $option
                        .attr("value", room.room_no)
                        .text(room.cluster_code + " - " + room.room_no);
                    $room.append($option);
                });
            }
        },
        error: function (xhr, status) {
            alert(xhr.responseText);
        },
    });
}

function ajax_get_cluster_designation_for_computer(
    type,
    designationId = "designation"
) {
    var $room = $("#" + designationId);

    return $.ajax({
        url: "ajax_cluster/get_cluster_details_by_type/" + type,
        type: "get",
        dataType: "json",
        beforeSend: function () {
            var $loader = $("<option />");

            $loader
                .attr("value", "")
                .text("Fetching...")
                .prop("selected", true);

            $room.append($loader);
        },
        success: function (result) {
            if (result instanceof Array) {
                var $select = $("<option />");

                $room.empty();

                $.each(result, function (index, value) {
                    var $option = $("<option />");

                    $option
                        .attr("value", result[index].cluster_code)
                        .text(
                            result[index].cluster_name +
                                " (" +
                                result[index].cluster_code +
                                ")"
                        );
                    $room.append($option);
                });
            }
        },
        error: function (xhr, status) {
            alert(xhr.responseText);
        },
    });
}

function ajax_get_all_designation_for_computer() {
    var $room = $("#designation");

    return $.ajax({
        url: "ajax_classroom/get_all_designation_for_computer",
        type: "get",
        dataType: "json",
        beforeSend: function () {
            var $loader = $("<option />");

            $loader
                .attr("value", "")
                .text("Fetching...")
                .prop("selected", true);

            $room.append($loader);
        },
        success: function (result) {
            if (result instanceof Array) {
                var $select = $("<option />");

                $room.empty();

                $.each(result, function (index, value) {
                    var $option = $("<option />");
                    if (result[index].cluster_code) {
                        $option
                            .attr("value", result[index].room_no)
                            .text(
                                result[index].room_no +
                                    " - " +
                                    result[index].cluster_code
                            );
                        $room.append($option);
                    } else {
                        $option
                            .attr("value", result[index].room_no)
                            .text(result[index].room_no);
                        $room.append($option);
                    }
                });
            }
        },
        error: function (xhr, status) {
            alert(xhr.responseText);
        },
    });
}

function init() {
    $.validator.setDefaults({
        debug: true,
        errorClass: "form-error",
        success: "valid",
        validClass: "form-valid",
        focusInvalid: true,
    });

    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    });

    jQuery.validator.addMethod("regex", function (value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    });

    jQuery.validator.addMethod(
        "notEqual",
        function (value, element, param) {
            // return this.optional(element) || value != param;
            return this.optional(element) || value != $(param).val();
        },
        "Value should be different"
    );

    toastr.options = {
        toastClass: "alert",
        iconClasses: {
            error: "alert-error",
            info: "alert-info",
            success: "alert-success",
            warning: "alert-warning",
        },
        closeButton: true,
        closeHtml: '<button type="button" class="close">&times;</button>',
        debug: true,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-bottom-left",
        preventDuplicates: true,
        onclick: null,
        showDuration: 300,
        hideDuration: 1000,
        timeOut: 5000,
        extendedTimeOut: 5000,
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
}

function getEndDate(date, dateCreated) {
    const [number, type] = date.split(" ");
    const endDate = dateCreated.clone();
    endDate.add(number, type.includes("month") ? "M" : "y");
    return endDate;
}

function getHealthPercentage(endDate, dateCreated) {
    const today = moment();
    const total = endDate.diff(dateCreated);
    const current = endDate.diff(today);

    return Math.floor((current / total) * 100);
}

function getHealthPercentageClassLabel(healthPercentage) {
    let labelClass = "label-success";

    if (healthPercentage <= 10) {
        labelClass = "label-danger";
    } else if (healthPercentage <= 30) {
        labelClass = "label-warning";
    }

    return labelClass;
}

function getLowestHealthPart(parts) {
    let lowestHealthPercentage = 100;
    let lowestHealthPart = {};

    if (parts.length > 0) {
        parts.forEach((part) => {
            const dateCreated = moment(
                part.date_created,
                "YYYY-MM-DD HH:mm:ss"
            );
            const endDate = getEndDate(part.depreciation_value, dateCreated);
            const healthPercentage = getHealthPercentage(endDate, dateCreated);

            if (lowestHealthPercentage > healthPercentage) {
                lowestHealthPercentage = healthPercentage;
                lowestHealthPart = part;
            }
        });
    }

    return {
        lowestHealthPercentage: Math.max(lowestHealthPercentage, 0),
        lowestHealthPart,
    };
}

function getUnitStatusDescription(unitStatus) {
    if (unitStatus == "under warranty") {
        return "To Be Replaced";
    }

    if (unitStatus == "close") {
        return "Resolved";
    }

    if (unitStatus == "repaired") {
        return "Repaired";
    }

    if (unitStatus == "under repair") {
        return "Under Repair";
    }

    return unitStatus;
}
