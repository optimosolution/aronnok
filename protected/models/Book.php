<?php

/**
 * This is the model class for table "{{book}}".
 *
 * The followings are the available columns in table '{{book}}':
 * @property integer $id
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $mobile
 * @property string $phone
 * @property string $address
 * @property integer $city
 * @property integer $state
 * @property integer $zip
 * @property integer $country
 * @property string $special_requests
 * @property string $arrival
 * @property string $departure
 * @property integer $location
 * @property integer $rooms
 * @property integer $adults_per_room
 * @property integer $kids_per_room
 */
class Book extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{book}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, first_name, email, mobile', 'required'),
            array('zip, country, location, rooms, adults_per_room, kids_per_room', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 20),
            array('city, state, first_name, last_name, email', 'length', 'max' => 150),
            array('mobile, phone', 'length', 'max' => 100),
            array('address', 'length', 'max' => 250),
            array('special_requests, arrival, departure', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, first_name, last_name, email, mobile, phone, address, city, state, zip, country, special_requests, arrival, departure, location, rooms, adults_per_room, kids_per_room', 'safe', 'on' => 'search'),
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
            'title' => 'Title',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email Address',
            'mobile' => 'Mobile',
            'phone' => 'Phone',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State/Province',
            'zip' => 'ZIP/Postal',
            'country' => 'Country',
            'special_requests' => 'Special Requests',
            'arrival' => 'Arrival',
            'departure' => 'Departure',
            'location' => 'Location',
            'rooms' => 'Rooms',
            'adults_per_room' => 'Adults Per Room',
            'kids_per_room' => 'Kids Per Room',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('city', $this->city);
        $criteria->compare('state', $this->state);
        $criteria->compare('zip', $this->zip);
        $criteria->compare('country', $this->country);
        $criteria->compare('special_requests', $this->special_requests, true);
        $criteria->compare('arrival', $this->arrival, true);
        $criteria->compare('departure', $this->departure, true);
        $criteria->compare('location', $this->location);
        $criteria->compare('rooms', $this->rooms);
        $criteria->compare('adults_per_room', $this->adults_per_room);
        $criteria->compare('kids_per_room', $this->kids_per_room);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['pageSize'],
            ),
            'sort' => array('defaultOrder' => 'id DESC')
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Book the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
