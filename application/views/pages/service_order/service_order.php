<div class="row">
    <div class="col-lg-8 col-centered">
        <h1 class="itmms-page-header">
            <i class="fa fa-list-alt fa-fw"></i>
            <?php echo  preg_replace('/[^a-zA-Z0-9]/', ' ', ucwords($controller)) ?>
        </h1>
    </div>
</div>
<span class="hidden" id="user_name"><?php echo $sess_user; ?></span>
<div class="col-lg-8 col-centered bordered">
    <form class="horizontal-form" role="form" method="POST">
        <input type="hidden" name="if_pulled_out" value="0" />

        <table class="itmms-table">
            <tr>
                <td>
                    <legend class="padding10 itmms-title">Part I - Originator Details</legend>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <span class="col-lg-4 itmms-label">Employee ID:</span>
                        <span class="col-lg-8 itmms-label visible-lg">Employee Name:</span>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="emp_id" id="emp_id" placeholder="Input Employee ID">
                        </div>
                        <div class="col-lg-12 itmms-label-hidden-lg hidden-lg">Employee Name:</div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="emp_name" id="emp_name" placeholder="Input Employee Name">
                        </div>
                    </div>
                </td>
            </tr>
            <!-- <tr>
                <td>
                    <div class="form-group">
                        <div class="col-sm-12 itmms-label">Designation Type: </div>
                        <div class="col-lg-12">
                            <select class="form-control" name="designation_type" id="designation_type">
                                <option value="" disabled selected>Select Designation Type</option>
                                <option value="lecture">Lecture</option>
                                <option value="laboratory">Laboratory</option>
                                <option value="department">Department</option>
                                <option value="office">Office</option>
                            </select>
                        </div>
                    </div>
                </td>
            </tr> -->
            <tr>
                <td>
                    <div class="form-group">
                        <span class="col-sm-12 itmms-label">Designation</span>
                        <div class="col-lg-12">
                            <select class="form-control" name="cluster_id" id="cluster_id">
                                <option value="" disabled selected>Not yet selected</option>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <span class="col-sm-12 itmms-label">Position:</span>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="position" id="position" placeholder="Input Employee Position">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <span class="col-sm-12 itmms-label">Contact No.:</span>
                        <div class="col-lg-12">
                            <input type="number" min="0" class="form-control no-arrow" name="contact_no" id="contact_no" placeholder="Input Contact No.">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <legend class="padding10 itmms-title">Part II - Complaint Details</legend>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <span class="col-lg-12 itmms-label">Assigned Name:</span>
                        <div class="col-lg-12">
                            <select class="form-control" name="computer_name" id="computer_name" style="width: 100%;"></select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <span class="col-sm-12 itmms-label">Complaint Type:</span>
                        <div class="col-lg-12">
                            <select class="form-control" name="complaint_type" id="complaint_type">
                                <option value="" disabled selected>Select Complaint Type</option>
                                <option value="hardware">Hardware</option>
                                <option value="software">Software</option>
                            </select>
                        </div>

                    </div>
                </td>
            </tr>
            <!-- <tr class="complaint">
                <td>
                    <div class="form-group">
                        <span class="col-sm-12 itmms-label">Complaint <i><small>(Resource)</small></i>:</span>
                        <div class="col-lg-12">
                            <select class="form-control" name="complaint_resource_id" id="new_complaint">
                            </select>
                        </div>

                    </div>
                </td>
            </tr> -->
            <tr class="complaint">
                <td>
                    <div class="form-group">
                        <span class="col-lg-12 itmms-label">Complaint:</span>
                        <div class="col-lg-12">
                            <select class="form-control" name="complaint_resource_id[]" id="new_complaint">
                                <option value="" disabled selected>Not yet selected</option>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <span class="col-sm-12 itmms-label">Complaint Details:</span>
                        <div class="col-lg-12">
                            <select class="form-control" id="complaint_details" name="complaint_details">
                                <option disabled selected>Select Complaint Details</option>
                                <optgroup label="Access Point:">
                                    <option>No Power</option>
                                    <option>Solid Light on LAN Port</option>
                                    <option>Hang-up</option>
                                </optgroup>
                                <optgroup label="Camera:">
                                    <option>No Display</option>
                                    <option>No Power</option>
                                    <option>Can’t Detect</option>
                                    <option>Can’t Connect to NVR</option>
                                </optgroup>
                                <optgroup label="Network Video Recorder:">
                                    <option>No Display</option>
                                    <option>No Power</option>
                                    <option>Can’t Record</option>
                                    <option>Hang-up</option>
                                </optgroup>
                                <optgroup label="Personal Computer:">
                                    <option>No Power</option>
                                    <option>No Network</option>
                                    <option>OS repair</option>
                                    <option>Glitch Display</option>
                                    <option>Disk Boot Failure</option>
                                    <option>Blue Screen</option>
                                    <option>Flickering Display</option>
                                    <option>Black Screen Display</option>
                                    <option>Frequent Restart</option>
                                    <option>Loading</option>
                                    <option>Domain Login Failure</option>
                                    <option>Trust Relationship in Domain</option>
                                    <option>Can’t Detect Keyboard</option>
                                    <option>Can’t Detect Mouse</option>
                                    <option>Beeping</option>
                                    <option>Suddenly Turn-off</option>
                                    <option>Hang-up</option>
                                </optgroup>
                                <optgroup label="Printer:">
                                    <option>No Power</option>
                                    <option>Ink Overflow</option>
                                    <option>Paper Jam</option>
                                    <option>No Connection to PC</option>
                                    <option>Can’t Print</option>
                                    <option>Blinking</option>
                                </optgroup>
                                <optgroup label="Router:">
                                    <option>No Power</option>
                                    <option>Solid Light on LAN Port</option>
                                    <option>Hang-up</option>
                                </optgroup>
                                <optgroup label="Smart TV:">
                                    <option>No Display</option>
                                    <option>No Power</option>
                                    <option>Can’t Duplicate/Extend Display</option>
                                </optgroup>
                                <optgroup label="Switch:">
                                    <option>No Power</option>
                                    <option>Solid Light on LAN Port</option>
                                    <option>Hang-up</option>
                                </optgroup>
                                <optgroup label="Uninterruptible Power Supply:">
                                    <option>No Power</option>
                                    <option>Beeping</option>
                                    <option>Can’t Charge Battery</option>
                                </optgroup>
                                <option>Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group hide">
                        <span class="col-sm-12 itmms-label">Complaint Description</span>
                        <div class="col-lg-12">
                            <textarea class="form-control" rows="2" id="complaint_details_description" name="complaint_details_description" placeholder="Input Complaint Details"></textarea>
                        </div>
                    </div>
                </td>
            </tr>
            <!--             <tr>
                <td>
                    <div class="form-group">
                        <span class="col-sm-12 itmms-label">Received By:</span>
                        <div class="col-lg-12">
                            <input type="hidden" name="user_logged_in" value="<?php echo $sess_id ?>">
                            <select class="form-control" id="received_by" name="received_by"></select>
                        </div>
                    </div>
                </td>
            </tr> -->
            <tr>
                <td>
                    <div class="form-group">
                        <span class="col-sm-12 itmms-label">Assigned To:</span>
                        <div class="col-lg-12">
                            <select class="form-control" id="user_id" name="assigned_to"></select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <span class="col-sm-8 itmms-label">Date Reported:</span>
                        <span class="col-sm-4 itmms-label visible-lg">Time Reported:</span>
                        <div class="col-lg-8">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-calendar"></i>
                                <input type='text' class="datepicker-here form-control" id="date_reported" name="date_reported" readonly="readonly" />
                            </div>
                        </div>
                        <div class="col-lg-12 itmms-label-hidden-lg hidden-lg">Time Reported:</div>
                        <div class="col-lg-4">
                            <div class="bootstrap-timepicker">
                                <div class="inner-addon right-addon">
                                    <i class="fa fa-clock-o"></i>
                                    <input id="time_reported" type="text" name="time_reported" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <label class="checkbox-inline">
                                <input type="hidden" name="is_urgent" value="0">
                                <input type="checkbox" name="is_urgent" id="is_urgent" value="1">
                                <b>Mark as Urgent</b>
                            </label>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
