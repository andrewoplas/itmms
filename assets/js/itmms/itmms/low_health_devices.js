$(function ($) {
    var obj = {};

    obj.low_health_devices = $("#health-table")
        .on("init.dt", function () {
            tippy("[data-tippy-content]");
        })
        .DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            paging: false,
            searching: false,
            deferRender: true,
            bInfo: false,
            ajax: {
                url: "ajax_computer/get_computer_details_for_table",
                data: function (d) {
                    d.start = 0;
                    d.length = 9999;
                },
                dataSrc: function (response) {
                    if(!response.data) {
                        return [];
                    }

                    const data = response.data.filter((device) => {
                        const { lowestHealthPercentage } = getLowestHealthPart(
                            device.parts
                        );

                        return lowestHealthPercentage <= 10;
                    });

                    const count = data.length;
                    if (count > 0) {
                        $("#health-table-heading .count").text(`(${count})`);
                    }

                    return data;
                },
            },
            columns: [
                { data: "designation" },
                { data: "computer_name" },
                { data: "computer_type" },
                { data: "lifespan_left", sClass: "text-center" },
                { data: "brand_clone_name" },
            ],
            columnDefs: [
                {
                    data: "lifespan_left",
                    targets: -2,
                    sortable: false,
                    render: function (data, type, row) {
                        const {
                            lowestHealthPercentage: health,
                            lowestHealthPart: part,
                        } = getLowestHealthPart(row.parts);

                        return `
                            <span class="monitoring-health label ${getHealthPercentageClassLabel(
                                health
                            )}" data-tippy-content="Part Name: ${
                            part.parts_name
                        }">${health}%
                                ${
                                    health <= 10
                                        ? `<i class="fa fa-info-circle fa-fw"></i>`
                                        : ""
                                }
                            </span>
                        `;
                    },
                },
            ],
            language: {
                processing:
                    '<div class="processing-wrapper"> \
                                    <div><i class="fa fa-spinner fa-spin"></i> Fetching ... Please wait...</div> \
                                </div>',
                emptyTable: "No device(s) available in the database!",
                zeroRecords: "No device found!",
                infoFiltered: "",
            },
        });
});
