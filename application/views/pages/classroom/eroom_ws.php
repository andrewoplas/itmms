<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-flask"></i>&nbsp;<?php echo strtoupper(urldecode($this->uri->segment(2))) ?>
            <span class="pull-right">
                <span class="ws-legend">
                    <span><i class="fa fa-desktop fg-lightBlue ws-legend-item"></i> On Service</span>
                    <span><i class="fa fa-wrench fg-lightRed ws-legend-item"></i> Under Repair</span>
                    <span><i class="fa fa-exchange fg-grayLight ws-legend-item"></i> Pending</span>
                </span>
            </span>
        </h1>
    </div>
</div>
<div class="row">
    <?php
    foreach ($query as $row) :
        $computer = $this->computer->get_computer_status_by_computer_name($row->computer_name);

        $panel_color = 'panel-lightBlue';
        $icon = 'fa-desktop';

        if ($computer) {
            if ($computer->status === 'open') {
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
