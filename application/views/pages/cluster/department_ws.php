<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-trello"></i>&nbsp;<?php echo strtoupper($this->uri->segment(2)) ?>
            <span class="pull-right">
                <span class="ws-legend">
                    <span><i class="fa fa-desktop fg-lightBlue ws-legend-item"></i> On Service</span>
                    <span><i class="fa fa-wrench fg-lightRed ws-legend-item"></i> Received</span>
                    <span><i class="fa fa-exchange fg-grayLight ws-legend-item"></i> Pending</span>
                </span>
            </span>
        </h1>
    </div>
</div>

<div class="toggle-header">
    <h4>Rooms</h4>

    <div>
        <span><b><small>Type: </small></b></span>
        <span class="btn-group" role="group">
            <button type="button" class="btn btn-default active" data-role="type">All</button>
            <button type="button" class="btn btn-default" data-role="type">Laboratory</button>
            <button type="button" class="btn btn-default" data-role="type">Lecture</button>
        </span>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <input type="hidden" name="cluster_id" value="<?= $cluster->cluster_id ?>" />
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-hover table-bordered width100" id="classroom-list">
                        <thead>
                            <tr>
                                <th class="text-center" data-priority="1">ID</th>
                                <th data-priority="3">Room No</th>
                                <th>Room Type</th>
                                <th class="text-center" data-priority="2"><i class="fa fa-wrench fa-fw"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h4>Devices</h4>
    </div>

    <?php
    foreach ($query as $row) :
        $computer = $this->computer->get_computer_status_by_computer_name($row->computer_name);

        $panel_color = 'panel-lightBlue';
        $icon = 'fa-desktop';

        if ($computer) {
            if ($computer->status === 'received') {
                $panel_color = 'panel-red';
                $icon = 'fa-wrench';
            } else
                if ($computer->status === 'pending') {
                $panel_color = 'panel-gray';
                $icon = 'fa-exchange';
            }
        }
    ?>
        <a href="javascript:void(0)" title="View Details" data-bind="view_computer_history" data-id="<?php echo $row->computer_id ?>" data-name="<?php echo $row->computer_name ?>" data-method="view">
            <div class="col-lg-1-5 col-xs-4 col-sm-4">
                <div class="panel <?php echo $panel_color ?> ">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <i class="fa <?php echo $icon ?> fa-2x fg-dark"></i>
                            </div>
                            <div class="col-xs-12 text-center" style="margin-top: 0.5em">
                                <div><?php echo $row->computer_name ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <?php
    endforeach;
    ?>
</div>
