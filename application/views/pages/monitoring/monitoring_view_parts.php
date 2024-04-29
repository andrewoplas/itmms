<div class="hide-this">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="itmms-page-header">
                <?= $computer->computer_name; ?>
            </h1>
        </div>
    </div>
    <hr />

    <?php if (isset($replaced_parts)) : ?>
        <div id="monitoring-chart-tooltip">
            <div class="part-name"></div>
            <div class="date-added"></div>
        </div>
    <?php endif; ?>

    <?php foreach ($query as $row) : ?>
        <div class="row part-row hidden">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <input type="hidden" class="depreciation-value" value="<?= $row->depreciation_value ?>" />
                    <input type="hidden" class="date-created" value="<?= $row->date_created ?>" />

                    <div class="panel-heading">
                        <b><?= $row->parts_name; ?></b>
                        <span class="label label-success health">Health: <span class="value"></span></span>

                        <?php if (isset($replaced_parts)) : ?>
                            <?php
                            $replaced_part = NULL;
                            foreach ($replaced_parts as $rp) {
                                if ($rp->part_id == $row->id) {
                                    $replaced_part = $rp;
                                    break;
                                }
                            };
                            ?>

                            <?php if ($replaced_part != NULL) : ?>
                                <span class="label label-info replacement">Replacement: <?= (new DateTime($replaced_part->date_created))->format('F j, Y g:iA')  ?></span>
                            <?php endif ?>
                        <?php endif ?>
                    </div>

                    <?php
                    $has_replacement = in_array(strtolower($row->parts_name), ['computer set', "branded", "cloned"]) && $replaced_parts;
                    $class = $has_replacement ? 'computer-set-chart' : '';
                    $data = $has_replacement ? json_encode($replaced_parts) : '';
                    ?>

                    <div class="panel-body">
                        <canvas data-replaced-parts='<?= $data ?>' class="line-chart <?= $class ?>" height="<?= in_array(strtolower($row->parts_name), ['computer set', "branded", "cloned"]) ? 100 : 70 ?>"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
