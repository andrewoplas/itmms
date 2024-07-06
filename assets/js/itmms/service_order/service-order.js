$( function( $ ) {
    var obj = {};

    init();
    date_picker(new Date(), '#date_reported', 'top right');
    ajax_get_clusters();
    validate();
    typeahead();
    initialize_received_assigned();
    add_remove_complaint();

    $('#time_reported').timepicker({
        template: false,
        minuteStep: 1,
        showInputs: false
    });

    $('#computer_name').select2();

    obj.user_name = $('#user_name').text();

    $('.complaint').hide();

    // $( document ).on( 'change', '#designation_type', function(){
    //     var value = $(this).val();

    //     if( value ) {
    //         switch(value){
    //             case 'laboratory':
    //             case 'lecture':
    //                 ajax_get_classroom_designation_for_computer(value, 'cluster_id');
    //                 break;
    //             case 'department':
    //             case 'office':
    //                 ajax_get_cluster_designation_for_computer(value, 'cluster_id');
    //                 break;
    //         }
    //     }
    //     else{
    //         $('#designation').prop('disabled', false).empty().append('<option default value="">Not yet selected</option>');
    //     }
    // });

    $('#new_complaint').prop('disabled', false).empty().append('<option default disabled value="">Not yet selected</option>');
    $( document ).on( 'change', '#complaint_type', function(){
        var value = $(this).val();
        if(value) {
            ajax_get_complaint_by_type('#new_complaint', value).done(function() {
                $("#new_complaint").prop("selectedIndex", 1);

                updateComplaintDetailsOptions();
            });
        }
        else {
            $('#new_complaint').prop('disabled', false).empty().append('<option default disabled value="">Not yet selected</option>');
        }
    });

    $('#computer_name').prop('disabled', false).empty().append('<option default value="">Not yet selected</option>');

    $( document ).on( 'change', '#cluster_id', function(){
        var value = $(this).val();
        if(value) {
            ajax_get_computer(value);
        }
        else {
            $('#computer_name').prop('disabled', false).empty().append('<option default value="">Not yet selected</option>');
        }
    });

    $( document ).on( 'change', '#new_complaint', function(){
        updateComplaintDetailsOptions();
    });

    $( document ).on( 'change', '#complaint_details', function(){
        var value = $(this).val();
        $('#complaint_details_description').parents('.form-group').toggleClass('hide', value != 'Others');
    });

    function add_remove_complaint() {
        var addButton = $('.add-button');
        var fieldHTMLTop = '<tr class="complaint2">' +
                            '<td>' +
                                '<div class="form-group">' +
                                    '<div class="col-lg-12">' +
                                        '<div class="input-group" id="complaint-container">';
                                            var fieldHTMLBottom = '<span class="input-group-btn">' +
                                                '<button class="btn btn-danger remove-button" type="button" title="Remove field">' +
                                                    'x' +
                                                '</button>' +
                                            '</span>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</td>' +
                        '</tr>';

        $(addButton).click(function(){
            var ddl = $("#new_complaint").clone();
            ddl.attr("name", "complaint_resource_id[]");

            $(".itmms-table tr.complaint").last().after(fieldHTMLTop);
            $("#complaint-container").append(ddl);
            $("#complaint-container").append(fieldHTMLBottom);
        });

        $(".itmms-table").on('click','.remove-button',function(){
            $(this).closest('tr').remove();
        });
    }

    obj.ajax_add_service_order = function ( $form ){
        var $submit = $form.find( '[type="submit"]' );
        let data = '';

        // Update the complain details if selected is "Others"
        if($form.find("#complaint_details").val() == 'Others') {
            const serializedArray = $form.serializeArray()
            for (let i = 0; i < serializedArray.length; i++) {
                if(serializedArray[i].name === 'complaint_details') {
                    serializedArray[i].value = $form.find("#complaint_details_description").val();
                    break;
                }
            }

            data = jQuery.param(serializedArray);
        } else {
            data = $form.serialize()
        }

        $.ajax( {
            url : 'ajax_service_order/add_service_order/' + obj.user_name,
            type : 'post',
            dataType : 'json',
            data : data,
            beforeSend : function(){
                $submit.text( 'Processing...' ).prop( 'disabled', true );
            },
            success : function( result ) {
                if(result.status){
                    if(result.access_rights === 'add')
                        toastr.success( "Added!", "itmms | Service Order" );
                    else
                        toastr.success( "Added! <a role='button' class='btn btn-sm-toastr' href='tasks'><i class='fa fa-external-link'></i> View List</a>", "itmms | Service Order" );
                }
                else{
                    toastr.error( "Failed to add", "itmms | Service Order" );
                }

                validate();
                $('#emp_id').val('');
                $('#emp_name').val('');
                $('#cluster_id').val('');
                $('#position').val('');
                $('#contact_no').val('');
                $('#computer_name').val(null).trigger('change');
                $('#computer_name').prop('disabled', false).empty().append('<option default value="">Not yet selected</option>');
                $('#complaint_type').val('');
                $('#new_complaint').val('');
                $('#complaint_details').val('');
                $('#user_id').val('');
                $('#is_urgent').prop( 'checked', false );
                date_picker(new Date(), '#date_reported', 'top right');
                $submit.text( 'Submit' ).prop( 'disabled', false );
                $('.complaint').hide();
                $('.complaint2').remove();
            },
            error : function( xhr, status ){
                alert( xhr.responseText );
            }
        } );
    };

    function initialize_received_assigned() {
        get_all_user_details_of_admin_encoder('#received_by').done( function() {
            $("#received_by").val($('[name=user_logged_in]').val());
        });
        get_all_user_details_of_admin();
    }

    function typeahead() {
        var users = new Bloodhound({
                                datumTokenizer: Bloodhound.tokenizers.whitespace,
                                queryTokenizer: Bloodhound.tokenizers.whitespace,
                                remote:{
                                    url: 'ajax_user/get_all_users/%q',
                                    wildcard: '%q'
                                }
                          });

        users.initialize();

        $('#emp_id').typeahead(null,{
            name: 'users',
            source : users,
            displayKey : 'emp_id',
            templates : {
                suggestion : function( user ) {
                    var html = '';

                    html += '<div class="media">';
                        html += '<div class="media-left">';
                            html += '<img class="media-object img-circle padding5" src="assets/images/avatars/default_profile.png" alt="' + user.emp_name + '-avatar">';
                        html += '</div>';
                        html += '<div class="media-body">';
                            html += '<ul class="list-unstyled">';
                            html += '<li><strong class="media-heading">' + user.emp_name + '</strong></li>';
                            html += '<li>' + user.cluster_code + ' - ' + user.cluster_name + '</li>';
                            html += '</ul>';
                         html += '</div>';
                    html += '</div>';

                    return html;
                }
            }
        });

        $('#emp_id').bind('typeahead:select', function( e, suggestion ) {
            var $emp_name = $('#emp_name'),
                $department = $('#cluster_id'),
                $position = $('#position'),
                $contact_no = $('#contact_no');

            $emp_name.val(suggestion.emp_name);
            $department.val(suggestion.cluster_id);
            $position.val(suggestion.position);
            $contact_no.val(suggestion.contact_no);
            ajax_get_computer(suggestion.cluster_id);
        });
        $('#emp_id').bind('typeahead:autocomplete', function( e, suggestion ) {
            var $emp_name = $('#emp_name'),
                $department = $('#cluster_id'),
                $position = $('#position'),
                $contact_no = $('#contact_no');

            $emp_name.val(suggestion.emp_name);
            $department.val(suggestion.cluster_id);
            $contact_no.val(suggestion.contact_no);
            ajax_get_computer(suggestion.cluster_id);

        });
        $('#emp_id').bind('typeahead:cursorchange', function( e, suggestion ) {
            var $emp_name = $('#emp_name');

        });
    }

    function validate(){
        var $form = $('form');

        $form.validate({
            rules: {
                emp_id : {
                    required : true
                },
                emp_name : {
                    required : true
                },
                cluster_id : {
                    required : true
                },
                position : {
                    required : true
                },
                contact_no : {
                    required : true,
                    number : true
                },
                computer_name : {
                    required: true
                },
                complaint_type : {
                    required : true
                },
                'complaint_resource_id[]' : {
                    required : true
                },
                complaint_details : {
                    required : true
                },
                complaint_details_description: {
                    required : function() {
                        return $form.find("#complaint_details").val() == 'Others';
                    }
                },
                date_reported : {
                    required : true
                },
                time_reported : {
                    required : true
                },
            },
            messages : {
                emp_id : {
                    required : "Employee ID is required"
                },
                emp_name : {
                    required : "Employee ID is required"
                },
                cluster_id : {
                    required : "Department/Office name is required"
                },
                position : {
                    required : "Position is required"
                },
                contact_no : {
                    required : "Contact number is required",
                    number : "Number only please"
                },
                computer_name : {
                    required: "Device name is required"
                },
                complaint_type : {
                    required : "Complaint type is required"
                },
                'complaint_resource_id[]' : {
                    required : "Complaint is required"
                },
                complaint_details : {
                    required : "Complaint details is required"
                },
                complaint_details_description : {
                    required : "Complaint description is required"
                },
                date_reported : {
                    required : "Date reported is required"
                },
                time_reported : {
                    required : "Time reported is required"
                },
            },
            highlight: function( element, errorClass, validClass ){
                $(element).addClass( errorClass ).removeClass( validClass );
            },
            unhighlight: function( element, errorClass, validClass ){
                // $(element).removeClass( errorClass ).addClass( validClass );
                $(element).removeClass( errorClass );
            },
            errorPlacement: function( erorr, element ){
                erorr.insertAfter(element);
            },
            submitHandler: function(){
                obj.ajax_add_service_order( $form );
            }
        });
    }

    function updateComplaintDetailsOptions() {
        const value = $('#new_complaint').children(':selected').text();

        $('#complaint_details').find('optgroup').hide();
        $('#complaint_details').find(`optgroup[label="${value}:"]`).show();
        $('#complaint_details').prop('selectedIndex', 0);
    }
});
