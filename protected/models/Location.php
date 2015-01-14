<?php

/**
 * This is the model class for table "{{location}}".
 *
 * The followings are the available columns in table '{{location}}':
 * @property string $id
 * @property string $location
 * @property string $details
 * @property string $picture
 */
class Location extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{location}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('location', 'required'),
            array('location, picture', 'length', 'max' => 250),
            array('details, map', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, location, details, picture, map', 'safe', 'on' => 'search'),
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
        $criteria->compare('location', $this->location, true);
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
     * @return Location the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getLocation($id) {
        $value = Location::model()->findByAttributes(array('id' => $id));
        if (empty($value->location)) {
            return null;
        } else {
            return $value->location;
        }
    }

    public static function get_images($id) {
        $value = Location::model()->findByAttributes(array('id' => $id));
        $filePath = Yii::app()->basePath . '/../uploads/images/' . $value->picture;
        if ((is_file($filePath)) && (file_exists($filePath))) {
            echo CHtml::image(Yii::app()->baseUrl . '/uploads/images/' . $value->picture, 'Picture', array('alt' => $value->location, 'class' => 'thumbnail', 'title' => $value->location, 'style' => ''));
        } else {
            echo CHtml::image(Yii::app()->baseUrl . '/uploads/images/resort.jpg', 'Picture', array('alt' => $value->location, 'class' => 'thumbnail', 'title' => $value->location, 'style' => ''));
        }
    }

}
