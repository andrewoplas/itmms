$( function( $ ) {
    var obj = {};

    obj.loader = '<img src="assets/images/loader/loader.gif" class="loader" />';

    init();

    $( document ).on( 'click', '[data-bind]', function(e) {
        e.preventDefault();

        var url = $( this ).data( 'bind' ),
            room_id = $( this ).data( 'id' ),
            method = $( this ).data( 'method' );

        load_modal( url, room_id, method );
    } );

    $('[data-role="type"]').click(function(e){
        $(this).addClass('active').siblings().removeClass('active');

        obj.classroom_list.ajax.reload();
    });

    $( document ).on( 'click', '#small [type="submit"]', function(e) {
        e.preventDefault();
        var $small_modal = $('#small');

        switch(obj.method){
            case 'delete':
                obj.delete_classroom_by_room_id( $small_modal );
                break;
        }
    });

    obj.classroom_list = $('#classroom-list').DataTable({
        'processing': true,
        'serverSide': true,
        'responsive': true,
        'ajax': {
            'url': 'ajax_classroom/get_classroom_details_for_table',
            'data': function ( d ) {
                d.type = $('.active[data-role="type"]').text().toLowerCase();
                d.cluster_id = $('[name="cluster_id"]').val();
            }
        },
        'deferRender': true,
        'order': [[0, 'asc']],
        'columns': [
            { 'data': 'room_id', 'sClass': 'text-center' },
            { 'data': 'room_no' },
            { 'data': 'type', 'sClass': 'caps' },
            { 'data': 'actions' },
        ],
        'columnDefs': [
            {
                'data': 'actions',
                'targets': -1,
                'sortable': false,
                'render' : function ( data, type, row ) {
                    var html = '<div class="text-center"> \
                            <div class="btn-group"> \
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-itmms" data-toggle="dropdown"> \
                                    <i class="fa fa-chevron-down fa-fw"></i> \
                                </button> \
                                <ul class="dropdown-menu pull-right" role="menu"  style="padding: 0 0 7px 0"> \
                                    <li> \
                                        <span class="dropdown-title text-center">Action Bar</span> \
                                    </li> \
                                    <li> \
                                        <a href="'+ row.type + '/' + row.room_no + '"><i class="fa fa-external-link fa-fw fg-cyan"></i> View Room</a> \
                                    </li> \
                                    <li> \
                                        <a href="javascript:void(0)" data-method="edit" data-bind="edit_classroom" data-id="' + row.room_id + '"><i class="fa fa-edit fa-fw fg-yellow"></i> Edit Entry</a> \
                                    </li>';
                                    if(!row.designation) {
                                        html += '<li> \
                                            <a href="javascript:void(0)" data-method="delete" data-bind="confirmation" data-id="' + row.room_id + '"><i class="fa fa-trash fa-fw fg-red"></i> Delete Entry</a> \
                                        </li>';
                                    }
                                html +=  '</ul> \
                            </div> \
                        </div>';
                    return html;
                }
            }
        ],
        'language': {
            "processing": '<div class="processing-wrapper"> \
                                <div><i class="fa fa-spinner fa-spin"></i> Fetching ... Please wait...</div> \
                            </div>',
            'emptyTable': 'No classroom(s) available in the database!',
            'zeroRecords': 'No classroom(s) found!',
            "infoFiltered": ""
        }
    });

    obj.ajax_update_classroom_details = function ( $form, $modal ){
        var $submit = $form.find( '[type="submit"]' );

        $.ajax( {
            url : 'ajax_classroom/update_classroom_details',
            type : 'post',
            dataType : 'json',
            data : $form.serialize(),
            beforeSend : function(){
                $submit.text( 'Processing...' ).prop( 'disabled', true );
            },
            success : function( result ) {
                if(result.status){
                    obj.classroom_list.ajax.reload();
                    $( '.classroom-wrapper' ).load( 'dashboard .classroom-wrapper > li' );
                    toastr.success('Sucessfully updated!', "itmms | Classroom");

                    $modal.modal( 'hide' );
                }
                else{
                    toastr.error( "Nothing to update", "itmms | Classroom");
                }

                $submit.text( 'Update' ).prop( 'disabled', false );
            },
            error : function( xhr, status ){
                alert( xhr.responseText );
            }
        } );
    }

    obj.delete_classroom_by_room_id = function( $small_modal ) {
        $.ajax({
            url : 'ajax_classroom/delete_classroom_by_room_id',
            type : 'post',
            dataType : 'json',
            data : { room_id : obj.room_id },
            success : function( result ){
                if( result.status ) {
                    obj.classroom_list.ajax.reload();
                    $( '.classroom-wrapper' ).load( 'dashboard .classroom-wrapper > li' );
                    toastr.success( 'Removed!', "itmms | User" );

                    $small_modal.modal( 'hide' );
                }
                else {
                    toastr.error( 'Unable to delete', " itmms | User" );
                }
            },
            error : function( xhr, status ) {
                alert( xhr.responseText );
            }
        });
    }

    obj.ajax_get_modal_content = function( ajax_url, $modal ) {
        return $.ajax({
            url : ajax_url,
            type : 'get',
            dataType : 'html',
            beforeSend: function(){
                $modal.find( '.modal-content' ).html( obj.loader );
            },
            success: function( response ) {
                var html = $( $.parseHTML( response ) ),
                    content = html.filter( '.modal-content' ).html();

                $modal.find( '.modal-content' ).html( content );
            },
            error: function( xhr, status ) {
                alert( xhr.responseText );
            }
        });
    }

    function ajax_get_classroom_details_by_id( $modal ) {
        var $form = $modal.find( 'form' ),
            $field = $modal.find( 'div' );

        return $.ajax({
            url : 'ajax_classroom/get_classroom_details_by_id',
            type : 'get',
            dataType : 'json',
            data : { id : obj.room_id },
            success: function( result ) {

                $.each( result, function(index, value) {
                    $form.find( '[name=' + index + ']' ).val(value);
                } );
            },
            error : function( xhr, status ) {
                alert( xhr.responseText );
            }
        });
    };

    function validate($form, $modal){
        $form.validate({
            rules: {
                room_no : {
                    required : true,
                    remote : {
                        url : 'ajax_classroom/is_classroom_no_available_on_update',
                        type : "post",
                        data: {
                            room_id: function() {
                              return $( '[name="room_id"]' ).val();
                            }
                        }
                    }
                },
                classroom_type : {
                    required : true
                }
            },
            messages : {
                room_no : {
                    required : "Room No. is required",
                    remote : "Room No. is not available"
                },
                classroom_type : {
                    required : "Room Type is required"
                }

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
                obj.ajax_update_classroom_details( $form, $modal );
            }
        });
    }

    function load_modal( url, room_id, method ) {
        var $modal = $( '#large' ),
            $medium_modal = $('#medium'),
            $small_modal = $('#small'),
            ajax_url = 'modal/' + url;

        obj.method = method;
        obj.room_id = room_id;

        switch(obj.method) {
            case 'edit' :
                obj.ajax_get_modal_content( ajax_url, $medium_modal ).done( function() {
                    ajax_get_classroom_details_by_id( $medium_modal ).done( function() {
                        validate( $medium_modal.find( 'form' ), $medium_modal );
                        $medium_modal.modal( {
                            show : true,
                            backdrop: 'static',
                        });
                    });
                });
                break;
            case 'delete' :
                obj.ajax_get_modal_content( ajax_url, $small_modal ).done( function(){
                    $small_modal.modal( {
                        show : true,
                        backdrop: 'static',
                    });
                });
                break;
        }
    }
});
