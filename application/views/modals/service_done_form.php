<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="pull-right btn btn-default btn-danger btn-circle" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-check-square-o"></i>&nbsp;Service done report</h4>
    </div>
    <form method="post" class="form-horizontal">
        <div class="modal-body">
            <input type="hidden" name="complaint" id="complaint" />

            <div class="form-group">
                <div class="col-sm-12 itmms-label">Reference Number:<i class="fa fa-lock fg-gray pull-right padding-right5"></i></div>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="ref_no" id="ref_no" readonly>
                    <input type="hidden" class="form-control" name="computer_name" id="computer_name" readonly>
                </div>
            </div>
            <div id="finished">
                <div class="form-group">
                    <div class="col-sm-3 itmms-label">Date finished:</div>
                    <div class="col-sm-9">
                        <div class="inner-addon right-addon">
                            <i class="fa fa-calendar"></i>
                            <input type='text' class="datepicker-here form-control" id="date_finished" name="date_finished" readonly />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 itmms-label">Time finished:</div>
                    <!-- <div class="col-lg-12 itmms-label-hidden-lg hidden-lg">Time finished:</div> -->
                    <div class="col-sm-9">
                        <div class="inner-addon right-addon">
                            <i class="fa fa-clock-o"></i>
                            <input id="time_finished" type="text" name="time_finished" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div id="replaced">
                <div class="form-group">
                    <div class="col-sm-3 itmms-label">Date replaced:</div>
                    <div class="col-sm-9">
                        <div class="inner-addon right-addon">
                            <i class="fa fa-calendar"></i>
                            <input type='text' class="datepicker-here form-control" id="date_replaced" name="date_replaced" readonly />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 itmms-label">Time replaced:</div>
                    <!-- <div class="col-lg-12 itmms-label-hidden-lg hidden-lg">Time replaced:</div> -->
                    <div class="col-sm-9">
                        <div class="inner-addon right-addon">
                            <i class="fa fa-clock-o"></i>
                            <input id="time_replaced" type="text" name="time_replaced" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12 itmms-label">Completed By:</div>
                <div class="col-sm-12">
                    <select class="form-control" name="completed_by" id="user_id"></select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 itmms-label">Unit Status:</div>
                <div class="col-sm-12">
                    <select class="form-control" name="unit_status" id="unit_status">
                        <option value="">Select Unit Status</option>
                        <option value="repaired">Repaired</option>
                        <option value="under warranty">Replacement</option>
                    </select>
                </div>
            </div>

            <div class="form-group hidden computer-parts-field">
                <div class="col-sm-12">
                    <span class="itmms-label" for="computer_part">Part: </span>
                    <select class="form-control" name="computer_part" id="computer_part">
                        <option selected disabled>Select Part</option>
                        <option value="Monitor">Monitor</option>
                        <option value="Hard Drive">Hard Drive</option>
                        <option value="Motherboard">Motherboard</option>
                        <option value="Power Supply">Power Supply</option>
                        <option value="Processor">Processor</option>
                        <option value="RAM">RAM</option>
                        <option value="Video Card">Video Card</option>
                        <option value="Computer Set">Computer Set</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12 itmms-label">Diagnose / Troubleshooting Report:</div>
                <div class="col-sm-12">
                    <textarea class="form-control" rows="5" name="action_taken" placeholder="Type here ..." id="action_taken"></textarea>
                </div>
            </div>
            <!--             <div class="form-group" id="return">
                <div class="col-sm-12 itmms-label">Received By:</div>
                <div class="col-sm-12">
                      <input type="text" class="form-control" name="returned_to" id="returned_to" placeholder="Input Returned to Personnel" />
                </div>
            </div> -->
            <div class="form-group" id="property">
                <div class="col-sm-6 itmms-label margin-right">Property clerk:</div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="property_clerk" id="property_clerk" placeholder="Input Property Clerk" />
                </div>
                <div class="col-sm-6 margin-negative-top" id="property_date">
                    <div class="inner-addon right-addon">
                        <div class="col-sm-6 margin-negative-left">Date Resolved:</div>
                        <i class="fa fa-calendar margin-top"></i>
                        <input type='text' class="form-control" id="property_date_received" name="property_date_received" placeholder="Input Date Replaced" />
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Done</button>
        </div>
    </form>
</div>
