<?php
/* @var $this BookController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Books',
);
?>
<div class="row book-start">
    <div class="span12">	
        <br /><br />
        <h1>Book your room<br /><small>When would you like to stay with us?</small></h1>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'book-form',
            'action' => array('/book/create'),
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal')
        ));
        ?>
        <div class="row">
            <div class="span4">
                <h3><span>Check-in</span> date</h3>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'from',
                    'id' => 'from',
                    'options' => array(
                        'showAnim' => 'fold',
                        'dateFormat' => 'yy-mm-dd', // save to db format
                        'showOtherMonths' => true,
                        'selectOtherMonths' => true,
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => '+0:+5',
                        //'altField' => '#self_pointing_id',
                        'altFormat' => 'yy-mm-dd', // show to user format
                    ),
                    'htmlOptions' => array(
                        'style' => 'height:20px;',
                        'class' => 'span3',
                    ),
                ));
                ?>
                <h3><span>Check-out</span> date</h3>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'to',
                    'id' => 'to',
                    'options' => array(
                        'showAnim' => 'fold',
                        'dateFormat' => 'yy-mm-dd', // save to db format
                        'showOtherMonths' => true,
                        'selectOtherMonths' => true,
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => '+0:+5',
                        //'altField' => '#self_pointing_id',
                        'altFormat' => 'yy-mm-dd', // show to user format
                    ),
                    'htmlOptions' => array(
                        'style' => 'height:20px;',
                        'class' => 'span3',
                    ),
                ));
                ?>
                <h3><span>Rooms</span> and people</h3>
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Rooms</label>
                    <div class="controls">
                        <select class="span1 select_rooms" name="rooms" id="rooms">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>			
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Adults per room</label>
                    <div class="controls">
                        <select class="span1 select_adults" name="adults_per_room" id="adults_per_room">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Kids per room</label>
                    <div class="controls">
                        <select class="span1 select_kids" name="kids_per_room" id="kids_per_room">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <?php echo CHtml::submitButton('Book Now!', array('class' => 'btn btn-primary btn-large book-now', 'style' => 'margin-left:125px;')); ?>
            </div>			
            <div class="span4">
                <div class="row">
                    <div class="span4">
                        <h3><span>Resort</span> Locations</h3>
                        <?php
                        $array = Yii::app()->db->createCommand()
                                ->select('*')
                                ->from('{{content}}')
                                ->where('state=1 AND catid=5 OR catid IN(SELECT c.id FROM {{content_category}} c WHERE c.parent_id=5)')
                                ->order('ordering ASC, created DESC')
                                ->queryAll();
                        $a = 1;
                        foreach ($array as $key => $values) {
                            ?>
                            <div class="room_selector" <?php if ($a > 1) echo 'style="display: none;"'; ?>>
                                <h5><a href="#" class="pull-left"><i class="icon-chevron-left"></i></a><?php echo $values['title']; ?><a href="#" class="pull-right "><i class="icon-chevron-right"></i></a></h5>
                                <?php echo CHtml::image(Yii::app()->baseUrl . '/uploads/images/' . $values['images'], $values['title'], array("class" => '', 'title' => $values['title'])); ?>
                                <p><?php echo $values['introtext']; ?></p>
                            </div>
                            <?php
                            $a++;
                        }
                        ?>                        
                    </div>					
                </div>
            </div>
            <div class="span4">
                <div class="row">
                    <div class="span4">
                        <h3><span>Resort</span> Rooms</h3>
                        <?php
                        $array = Yii::app()->db->createCommand()
                                ->select('*')
                                ->from('{{content}}')
                                ->where('state=1 AND catid=2 OR catid IN(SELECT c.id FROM {{content_category}} c WHERE c.parent_id=2)')
                                ->order('ordering ASC, created DESC')
                                ->queryAll();
                        $b = 1;
                        foreach ($array as $key => $values) {
                            ?>
                            <div class="room_selector" <?php if ($b > 1) echo 'style="display: none;"'; ?>>
                                <h5><a href="#" class="pull-left"><i class="icon-chevron-left"></i></a><?php echo $values['title']; ?><a href="#" class="pull-right "><i class="icon-chevron-right"></i></a></h5>
                                        <?php echo CHtml::image(Yii::app()->baseUrl . '/uploads/images/' . $values['images'], $values['title'], array("class" => '', 'title' => $values['title'])); ?>
                                <p><?php echo $values['introtext']; ?></p>
                            </div>
                            <?php
                            $b++;
                        }
                        ?>
                    </div>					
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
        <br /><br />		
        <p>Please note: All single rooms have one single bed and sleeps one adult. A 25-inch TV is included. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui.</p>
        <br /><br />			
    </div>
</div>