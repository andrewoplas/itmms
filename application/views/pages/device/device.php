<div class="row">
    <div class="col-lg-8 col-centered">
        <h1 class="itmms-page-header">
            <i class="fa fa-desktop fa-fw"></i>
            Device
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-centered bordered">
        <form class="horizontal-form" method="POST" id="add_new_user" role="form">
            <table class="itmms-table">
                <!-- COMPUTER DETAILS -->
                <tr>
                    <td>
                        <legend class="padding10 itmms-title">Device Details</legend>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <div class="col-sm-12 itmms-label">Device Type: </div>
                            <div class="col-lg-12">
                                <select class="form-control" name="computer_type" id="computer_type">
                                    <option value="">Select Device Type</option>
                                    <option value="Branded">Branded Computer</option>
                                    <option value="Cloned">Cloned Computer</option>
                                    <option value="Access Point">Access Point</option>
                                    <option value="Hard Drive">Hard Disk</option>
                                    <option value="Keyboard">Keyboard</option>
                                    <option value="Media Converter">Media Converter</option>
                                    <option value="Memory">Memory</option>
                                    <option value="Monitor">Monitor</option>
                                    <option value="Motherboard">Motherboard</option>
                                    <option value="Mouse">Mouse</option>
                                    <option value="Power Supply">Power Supply</option>
                                    <option value="Printer">Printer</option>
                                    <option value="Router">Router</option>
                                    <option value="SFP">Small Form-factor Pluggable</option>
                                    <option value="Switch">Switch</option>
                                    <option value="TV">TV</option>
                                    <option value="UPS">UPS</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <div class="col-sm-12 itmms-label">Specification Details:</div>
                            <div class="col-lg-12">
                                <textarea class="form-control" rows="5" id="brand_clone_name" name="brand_clone_name" placeholder="Input Details"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- PARTS DEPRECIATION -->
                <tr>
                    <td>
                        <legend class="padding10 itmms-title">Device Parts</legend>
                    </td>
                </tr>
                <tr>
                    <td>

                        <div class="computer-parts-container">
                            <div class="computer-parts-item">
                                <div class="col-lg-6">
                                    <span>Parts: </span>
                                    <select class="form-control" name="computer_parts[]" id="computer_parts">
                                        <option selected disabled>Select Parts</option>
                                        <option value="Branded">Branded Computer</option>
                                        <option value="Cloned">Cloned Computer</option>
                                        <option value="Access Point">Access Point</option>
                                        <option value="Hard Drive">Hard Disk</option>
                                        <option value="Keyboard">Keyboard</option>
                                        <option value="Media Converter">Media Converter</option>
                                        <option value="Memory">Memory</option>
                                        <option value="Monitor">Monitor</option>
                                        <option value="Motherboard">Motherboard</option>
                                        <option value="Mouse">Mouse</option>
                                        <option value="Power Supply">Power Supply</option>
                                        <option value="Printer">Printer</option>
                                        <option value="Router">Router</option>
                                        <option value="SFP">Small Form-factor Pluggable</option>
                                        <option value="Switch">Switch</option>
                                        <option value="TV">TV</option>
                                        <option value="UPS">UPS</option>
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <span>Value: </span>
                                    <select class="form-control" name="parts_depreciation_value[]" id="parts_depreciation_value">
                                        <option selected disabled>Select Depreciation Value</option>
                                        <option value="6 months">6 months</option>
                                        <option value="8 months">8 months</option>
                                        <option value="10 months">10 months</option>
                                        <option value="1 year">1 year</option>
                                        <option value="2 years">2 years</option>
                                        <option value="3 years">3 years</option>
                                        <option value="4 years">4 years</option>
                                        <option value="5 years">5 years</option>
                                    </select>
                                </div>

                                <br /><br /><br />
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary pull-right btn-add-part">
                            <i class="fa fa-plus"></i>
                            Add Part
                        </button>
                    </td>
                </tr>
                <!-- DESIGNATION DETAILS -->
                <tr>
                    <td>
                        <legend class="padding10">Designation Details</legend>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <div class="col-sm-5 itmms-label">Designation Type: </div>
                            <div class="col-sm-4 itmms-label visible-lg">Designation:</div>
                            <div class="col-sm-3 itmms-label visible-lg">Workstation No.:</div>
                            <div class="col-lg-5">
                                <select class="form-control" name="designation_type" id="designation_type">
                                    <option value="">Select Designation Type</option>
                                    <option value="lecture">Lecture</option>
                                    <option value="laboratory">Laboratory</option>
                                    <option value="department">Department</option>
                                    <option value="office">Office</option>
                                </select>
                            </div>
                            <div class="col-lg-12 itmms-label-hidden-lg hidden-lg">Designation:</div>
                            <div class="col-lg-4">
                                <select class="form-control" name="designation" id="designation"></select>
                            </div>
                            <div class="col-lg-12 itmms-label-hidden-lg hidden-lg">Workstation No.:</div>
                            <div class="col-lg-3">
                                <!--  <span class="input-group-addon group-custom bg-darkCyan fg-white">WS</span> -->
                                <input type="text" class="form-control" name="workstation_no" id="workstation_no" placeholder="e.g. ABCD12">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <div class="col-sm-12 itmms-label">Input by <i>(<small>TSG Personnel</small>)</i>:</div>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="assigned_to" id="assigned_to" placeholder="Input Assigned To">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <div class="col-sm-12 itmms-label">Date Inputted:</div>
                            <div class="col-lg-12">
                                <div class="inner-addon right-addon">
                                    <i class="fa fa-calendar"></i>
                                    <input type='text' class="datepicker-here form-control" id="date_assigned" name="date_assigned" readonly="readonly" />
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="itmms-label" id="set_hide">
                            <small><a href="javascript:void(0)" class="fg-red" id="set">Set manual assigned name?</a></small>
                        </div>
                        <div class="form-group hidden" id="set_computer_name">
                            <div class="col-sm-12 itmms-label">Assigned Name:</div>
                            <div class="col-sm-12">
                                <div class="inner-addon right-addon">
                                    <i class="fa fa-warning"></i>
                                    <input type="text" class="form-control" name="computer_name" id="computer_name" placeholder="Assigned Name">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button </div>
                            </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
