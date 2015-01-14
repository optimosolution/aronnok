<?php

/**
 * This is the model class for table "{{reservation_item}}".
 *
 * The followings are the available columns in table '{{reservation_item}}':
 * @property string $id
 * @property integer $reservation_id
 * @property integer $user
 * @property integer $resort
 * @property integer $room
 * @property string $date
 * @property integer $reservation_status
 * @property integer $status
 */
class ReservationItem extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{reservation_item}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user, resort, room', 'required'),
            array('reservation_id, user, resort, room, reservation_status, status', 'numerical', 'integerOnly' => true),
            array('date, created_on', 'safe'),
            array('rent', 'length', 'max' => 10),
            array('room', 'checkAvaiability'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, reservation_id, user, resort, room, rent, date, created_on, reservation_status, status', 'safe', 'on' => 'search'),
        );
    }

    public function checkAvaiability($attribute, $params) {
        $total = Yii::app()->db->createCommand()
                ->select('COUNT(*)')
                ->from('{{reservation_item}}')
                ->where('resort=' . $this->resort . ' AND room=' . $this->room . ' AND date=DATE_FORMAT("' . $this->date . '", "%Y-%m-%d") AND reservation_status IN(1,2)')
                ->queryScalar();
        if ($total > 0) {
            $this->addError($attribute, 'This room already booked for ' . UserAdmin::get_date($this->date) . '. Please try another!');
        }
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
            'reservation_id' => 'Reservation',
            'user' => 'User',
            'resort' => 'Resort',
            'room' => 'Room',
            'rent' => 'Rent',
            'date' => 'Date',
            'reservation_status' => 'Reservation Status',
            'status' => 'Status',
            'created_on' => 'Created On',
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
    public function search($id) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->condition = 't.reservation_id=' . $id;

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.reservation_id', $this->reservation_id);
        $criteria->compare('t.user', $this->user);
        $criteria->compare('t.resort', $this->resort);
        $criteria->compare('t.room', $this->room);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.reservation_status', $this->reservation_status);
        $criteria->compare('t.status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    public function search_chechout() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->condition = 't.user=' . Yii::app()->user->id . ' AND reservation_id IS NULL';

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.reservation_id', $this->reservation_id);
        $criteria->compare('t.user', $this->user);
        $criteria->compare('t.resort', $this->resort);
        $criteria->compare('t.room', $this->room);
        $criteria->compare('rent', $this->rent, true);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.reservation_status', $this->reservation_status);
        $criteria->compare('t.status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 500,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ReservationItem the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getTotal($provider) {
        $total = 0;
        foreach ($provider->data as $data) {
            $t = $data->rent;
            $total += $t;
        }
        return 'BDT ' . number_format($total, 2, '.', '');
    }

    public static function getTotalOnProcess() {
        if (isset(Yii::app()->user->id)) {
            $total = Yii::app()->db->createCommand()
                    ->select('COUNT(*)')
                    ->from('{{reservation_item}}')
                    ->where('user=' . Yii::app()->user->id . ' AND reservation_id IS NULL')
                    ->queryScalar();
        } else {
            $total = 0;
        }

        return $total;
    }

    public static function getTotalAmount($reservation_id) {
        $total = Yii::app()->db->createCommand()
                ->select('IFNULL(SUM(rent),0)')
                ->from('{{reservation_item}}')
                ->where('reservation_id=' . $reservation_id)
                ->queryScalar();
        return 'BDT ' . number_format($total, 2, '.', '');
    }

}
