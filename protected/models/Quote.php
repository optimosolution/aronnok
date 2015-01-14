<?php

/**
 * This is the model class for table "{{quote}}".
 *
 * The followings are the available columns in table '{{quote}}':
 * @property string $id
 * @property string $quote
 * @property string $quoted_by
 * @property string $designation
 * @property integer $published
 */
class Quote extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{quote}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('published', 'numerical', 'integerOnly' => true),
            array('quote', 'length', 'max' => 255),
            array('quoted_by, designation', 'length', 'max' => 150),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, quote, quoted_by, designation, published', 'safe', 'on' => 'search'),
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
            'quote' => 'Quote',
            'quoted_by' => 'Quoted By',
            'designation' => 'Designation',
            'published' => 'Published',
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
        $criteria->compare('quote', $this->quote, true);
        $criteria->compare('quoted_by', $this->quoted_by, true);
        $criteria->compare('designation', $this->designation, true);
        $criteria->compare('published', $this->published);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Quote the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
