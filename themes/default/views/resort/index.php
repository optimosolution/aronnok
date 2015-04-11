<?php
/* @var $this LocationController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Resorts - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Resorts',
);
?>
<style>
    .headerbg{
        background-color: #999999;
        color: white;
        padding: 10px;
        font-size: 18px;
        text-transform: uppercase;
    }
    .tablebg{
        width: 100%;
        padding: 20px;
        background-color: #F5F5F5;
    }
</style>
<h1>Resorts</h1>
<div class="row">
    <?php
//    $this->widget('bootstrap.widgets.TbListView', array(
//        'dataProvider' => $dataProvider,
//        'itemView' => '_view',
//        'template' => '{items}{pager}',
//    ));
    $rangamati = Resort::model()->findAll(array('condition' => 'location=1'));
    $kaptai = Resort::model()->findAll(array('condition' => 'location=2'));
    $shubhalong = Resort::model()->findAll(array('condition' => 'location=3'));
    ?> 
</div>
<div class="row">
    <div class="span6">
        <?php
        print '<div class="headerbg">' . Location::getLocation(1) . '</div>';
        foreach ($rangamati as $key => $value) {
            ?>
            <table class="tablebg">
                <tr>
                    <td width="40%">
                        <?php echo Resort::get_images($value['id']); ?>  
                    </td>
                    <td width="60%">
                        <div class="rerort_name"><?php echo $value['resort']; ?></div>
                        <p><span class="text-success"><strong>Location:</strong> <?php echo CHtml::link(Location::getLocation($value['location']), array('location/view', 'id' => $value['location']), array('target' => '_blank')); ?></span></p>
                        <?php echo CHtml::link('Details', array('resort/view', 'id' => $value['id']), array('class' => 'btn btn-primary btn-sm', 'target' => '_blank')); ?>
                        <?php echo CHtml::link('Book Now!', array('reservation/index', 'location' => $value['location'], 'resort' => $value['id']), array('class' => 'btn btn-warning btn-sm', 'target' => '_blank')); ?>
                    </td>
                </tr>
            </table>
        <?php } ?>
    </div>
    <div class="span6">
        <div class="span6">
            <?php
            print '<div class="headerbg">' . Location::getLocation(2) . '</div>';
            foreach ($kaptai as $key => $value) {
                ?>
                <table class="tablebg">
                    <tr>
                        <td width="40%">
                            <?php echo Resort::get_images($value['id']); ?>  
                        </td>
                        <td width="60%">
                            <div class="rerort_name"><?php echo $value['resort']; ?></div>
                            <p><span class="text-success"><strong>Location:</strong> <?php echo CHtml::link(Location::getLocation($value['location']), array('location/view', 'id' => $value['location']), array('target' => '_blank')); ?></span></p>
                            <?php echo CHtml::link('Details', array('resort/view', 'id' => $value['id']), array('class' => 'btn btn-primary btn-sm', 'target' => '_blank')); ?>
                            <?php echo CHtml::link('Book Now!', array('reservation/index', 'location' => $value['location'], 'resort' => $value['id']), array('class' => 'btn btn-warning btn-sm', 'target' => '_blank')); ?>
                        </td>
                    </tr>
                </table>
            <?php } ?>
            <?php
            print '<div class="headerbg">' . Location::getLocation(3) . '</div>';
            foreach ($shubhalong as $key => $value) {
                ?>
                <table class="tablebg">
                    <tr>
                        <td width="40%">
                            <?php echo Resort::get_images($value['id']); ?>  
                        </td>
                        <td width="60%">
                            <div class="rerort_name"><?php echo $value['resort']; ?></div>
                            <p><span class="text-success"><strong>Location:</strong> <?php echo CHtml::link(Location::getLocation($value['location']), array('location/view', 'id' => $value['location']), array('target' => '_blank')); ?></span></p>
                            <?php echo CHtml::link('Details', array('resort/view', 'id' => $value['id']), array('class' => 'btn btn-primary btn-sm', 'target' => '_blank')); ?>
                            <?php echo CHtml::link('Book Now!', array('reservation/index', 'location' => $value['location'], 'resort' => $value['id']), array('class' => 'btn btn-warning btn-sm', 'target' => '_blank')); ?>
                        </td>
                    </tr>
                </table>
            <?php } ?>
        </div>
    </div>
</div>