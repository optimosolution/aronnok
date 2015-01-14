<?php
/* @var $this ReservationController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->pageTitle = 'Reservation - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Reservation',
);
//echo date("Y", strtotime(@$_REQUEST['from']));
//Set report data
if (isset($_REQUEST['from']) && !empty($_REQUEST['from'])) {
    $from = $_REQUEST['from'];
} else {
    $from = date('Y-m-d');
}
if (isset($_REQUEST['to']) && !empty($_REQUEST['to'])) {
    $to = $_REQUEST['to'];
} else {
    $to = date('Y-m-d', strtotime("+6 days"));
}
if (isset($_REQUEST['location']) && !empty($_REQUEST['location'])) {
    $location = $_REQUEST['location'];
} else {
    $location = null;
}
if (isset($_REQUEST['resort']) && !empty($_REQUEST['resort'])) {
    $resort = $_REQUEST['resort'];
} else {
    $resort = null;
}
//Date Difference
$datetime1 = new DateTime($from);
$datetime2 = new DateTime($to);
$interval = $datetime1->diff($datetime2);
$totaldays = $interval->format('%a') + 1;
$colspan = (int) ($totaldays + 1);

Yii::app()->clientScript->registerScript('chain-select', "  
    $('#resort').chained('#location');
");
?>
<h1>Reservation</h1>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'reservation-form',
    'enableAjaxValidation' => false,
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'POST',
    'htmlOptions' => array('class' => ''),
        ));
?>
<script>
    $(function () {
        $('#from, #to').datepicker({dateFormat: "yy-mm-dd"});
        $('#from, #to').datepicker('option', {
            beforeShow: customRange
        });
    });

    function customRange(input) {
        if (input.id == 'to') {
            return {
                minDate: $('#from').datepicker("getDate")
            };
        } else if (input.id == 'from') {
            return {
                maxDate: $('#to').datepicker("getDate")
            };
        }
    }

    $(function () {
        $('#from, #to').datepicker({dateFormat: "yy-mm-dd"});
        $('#from, #to').datepicker('option', {
            beforeShow: customRanges
        });
    });

    function customRanges(input) {
        if (input.id == 'to') {
            return {
                minDate: $('#from').datepicker("getDate")
            };
        } else if (input.id == 'from') {
            return {
                maxDate: $('#to').datepicker("getDate")
            };
        }
    }
</script>
<div class="row">
    <div class="span2">
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'from',
            'id' => 'from',
            //'value' => isset($_REQUEST['from']) ? CHtml::encode($_REQUEST['from']) : date('Y-m-d'),
            'value' => isset($_REQUEST['from']) ? CHtml::encode($_REQUEST['from']) : '',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd', // save to db format
                'showOtherMonths' => true,
                'selectOtherMonths' => true,
                'changeMonth' => true,
                'changeYear' => true,
                'yearRange' => '-0:+5',
                //'altField' => '#self_pointing_id',
                'altFormat' => 'yy-mm-dd', // show to user format
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
                'class' => 'span2',
                'placeholder' => 'From Date',
            ),
        ));
        ?> 
    </div>
    <div class="span2">
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'to',
            'id' => 'to',
            //'value' => isset($_REQUEST['to']) ? CHtml::encode($_REQUEST['to']) : date('Y-m-t'),
            'value' => isset($_REQUEST['to']) ? CHtml::encode($_REQUEST['to']) : '',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd', // save to db format
                'showOtherMonths' => true,
                'selectOtherMonths' => true,
                'changeMonth' => true,
                'changeYear' => true,
                'yearRange' => '-0:+5',
                //'altField' => '#self_pointing_id',
                'altFormat' => 'yy-mm-dd', // show to user format
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
                'class' => 'span2',
                'placeholder' => 'To Date',
            ),
        ));
        ?> 
    </div>
    <div class="span2">
        <?php echo CHtml::dropDownList('location', isset($_REQUEST['location']) ? CHtml::encode($_REQUEST['location']) : '', CHtml::listData(Location::model()->findAll(array('condition' => '', 'order' => 'location')), 'id', 'location'), array('empty' => 'Select Location', 'class' => 'span2')); ?>
    </div>
    <div class="span2">
        <?php
        //echo CHtml::dropDownList('resort', isset($_REQUEST['resort']) ? CHtml::encode($_REQUEST['resort']) : '', CHtml::listData(Resort::model()->findAll(array('condition' => '', 'order' => 'resort')), 'id', 'resort'), array('empty' => 'All Resort', 'class' => 'span2'));
        echo Resort::get_resort_new('resort');
        ?>
    </div>
    <div class="span2">
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary btn-large check-availability')); ?>
    </div>    
</div>
<div class="row">
    <?php
    $totalOnProcess = ReservationItem::getTotalOnProcess();
    if ($totalOnProcess > 0):
        ?>
        <div class="span-2">
            <?php echo CHtml::link('Process', array('reservation/checkout'), array('class' => 'btn btn-primary btn-large check-availability')); ?>
        </div>
    <?php endif; ?>
    <div class="span-2">
        <?php echo CHtml::link('Reservation Log', array('reservation/history'), array('class' => 'btn btn-primary btn-large check-availability')); ?>
    </div>
    <div class="span-2">
        <?php echo CHtml::link('Payment', array('reservation/payment'), array('class' => 'btn btn-primary btn-large check-availability')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>  
<?php if (!Yii::app()->user->id) { ?>
    <div class="alert alert-danger bs-alert-old-docs">
        <strong style="margin-right: 10px;"><?php echo UserAdmin::get_date_name($from); ?></strong> to <strong><?php echo UserAdmin::get_date_name($to); ?></strong> If you already have an account with us, please <?php echo CHtml::link('login', array('site/login'), array('class' => 'text-success')); ?> at the login page or <?php echo CHtml::link('register', array('user/create'), array('class' => 'text-success')); ?> for Reservation.
    </div>
<?php } ?>
<?php
if (isset($_REQUEST['location']) && !empty($_REQUEST['location']) && isset($_REQUEST['resort']) && !empty($_REQUEST['resort'])) {
    $where = 'AND location=' . $_REQUEST['location'] . ' AND id=' . $_REQUEST['resort'];
} elseif (isset($_REQUEST['location']) && !empty($_REQUEST['location']) && empty($_REQUEST['resort'])) {
    $where = 'AND location=' . $_REQUEST['location'];
} elseif (isset($_REQUEST['resort']) && !empty($_REQUEST['resort']) && empty($_REQUEST['location'])) {
    $where = 'AND id=' . $_REQUEST['resort'];
} else {
    $where = null;
}
$array = Yii::app()->db->createCommand()
        ->select('*')
        ->from('{{resort}}')
        ->where('location IS NOT NULL ' . $where)
        ->queryAll();
foreach ($array as $key => $values) {
    echo '<div style="width:940px;overflow:auto;margin-bottom:20px;">';
    echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th colspan="' . $colspan . '">' . $values['resort'] . ', ' . Location::getLocation($values['location']) . '</th>';
    echo '</tr>';
    echo '<tr>';
    if ($values['id'] == 6 or $values['id'] == 8 or $values['id'] == 9) {
        echo '<td colspan="' . $colspan . '"><i class="icon-ok green"></i> For reservations please ' . CHtml::link('CONTACT US', array('site/contact'), array('class' => '', 'style' => '')) . '.</td>';
    } else {
        echo '<td class="room_title">&nbsp;</td>';
        $fromt = $from;
        for ($i = 1; $i <= $totaldays; $i++) {
            echo '<td><div class="btn_header">' . UserAdmin::get_date_name($fromt) . '</div></td>';
            $fromt = date('Y-m-d', strtotime($fromt . "+1 days"));
        }
    }
    echo '</tr>';
    $array_rooms = Yii::app()->db->createCommand()
            ->select('*')
            ->from('{{room}}')
            ->where('resort=' . $values['id'])
            ->queryAll();
    foreach ($array_rooms as $key => $value) {
        echo '<tr>';
        echo '<td class="room_title">' . CHtml::link($value['title'], array('reservation/room', 'id' => $value['id']), array('class' => '', 'target' => '_blank')) . '<br />BDT ' . number_format($value['rent'], 2, '.', '') . ' per night</td>';
        $fromt = $from;
        for ($i = 1; $i <= $totaldays; $i++) {
            echo '<td>' . Reservation::checkResarvation($value['id'], $fromt, $from, $to, $location, $resort) . '</td>';
            $fromt = date('Y-m-d', strtotime($fromt . "+1 days"));
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
}
?>