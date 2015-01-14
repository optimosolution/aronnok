<?php

/**
 * This is the model class for table "{{resort}}".
 *
 * The followings are the available columns in table '{{resort}}':
 * @property string $id
 * @property integer $location
 * @property string $resort
 * @property string $details
 * @property string $picture
 */
class Resort extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{resort}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('location, resort', 'required'),
            array('location', 'numerical', 'integerOnly' => true),
            array('resort, picture', 'length', 'max' => 250),
            array('details, map', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, location, resort, details, picture, map', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'location' => 'Location',
            'resort' => 'Resort',
            'details' => 'Details',
            'picture' => 'Picture',
            'map' => 'Location Map',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('location', $this->location);
        $criteria->compare('resort', $this->resort, true);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('picture', $this->picture, true);
        $criteria->compare('map', $this->map, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Resort the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getResort($id) {
        $value = Resort::model()->findByAttributes(array('id' => $id));
        if (empty($value->resort)) {
            return null;
        } else {
            return $value->resort;
        }
    }

    public static function get_images($id) {
        $value = Resort::model()->findByAttributes(array('id' => $id));
        $filePath = Yii::app()->basePath . '/../uploads/images/' . $value->picture;
        if ((is_file($filePath)) && (file_exists($filePath))) {
            echo CHtml::image(Yii::app()->baseUrl . '/uploads/images/' . $value->picture, 'Picture', array('alt' => $value->resort, 'class' => 'thumbnail', 'title' => $value->resort, 'style' => ''));
        } else {
            echo CHtml::image(Yii::app()->baseUrl . '/uploads/images/resort.jpg', 'Picture', array('alt' => $value->resort, 'class' => 'thumbnail', 'title' => $value->resort, 'style' => ''));
        }
    }

    public static function get_resort_new($field) {
        $rValue = Yii::app()->db->createCommand()
                ->select('id,location,resort')
                ->from('{{resort}}')
                ->order('resort')
                ->queryAll();
        echo '<select id="' . $field . '" name="' . $field . '" class="span2" placeholder="Select Resort">';
        echo '<option value="">All Resort</option>';
        foreach ($rValue as $key => $values) {
            if ($values["id"] == @$_REQUEST['resort']) {
                echo '<option selected="selected" value="' . $values["id"] . '" class="' . $values["location"] . '">' . $values["resort"] . '</option>';
            } else {
                echo '<option value="' . $values["id"] . '" class="' . $values["location"] . '">' . $values["resort"] . '</option>';
            }
        }
        echo '</select>';
    }
    
    public static function get_resort_admin($field) {
        $rValue = Yii::app()->db->createCommand()
                ->select('id,location,resort')
                ->from('{{resort}}')
                ->order('resort')
                ->queryAll();
        echo '<select id="' . $field . '" name="' . $field . '" class="span12" placeholder="Select Resort">';
        echo '<option value="">All Resort</option>';
        foreach ($rValue as $key => $values) {
            if ($values["id"] == @$_REQUEST['resort']) {
                echo '<option selected="selected" value="' . $values["id"] . '" class="' . $values["location"] . '">' . $values["resort"] . '</option>';
            } else {
                echo '<option value="' . $values["id"] . '" class="' . $values["location"] . '">' . $values["resort"] . '</option>';
            }
        }
        echo '</select>';
    }

}
