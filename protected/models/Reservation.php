<?php

/**
 * This is the model class for table "{{reservation}}".
 *
 * The followings are the available columns in table '{{reservation}}':
 * @property string $id
 * @property integer $user
 * @property string $reservation_code
 * @property integer $status
 */
class Reservation extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{reservation}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user', 'required'),
            array('user, status', 'numerical', 'integerOnly' => true),
            array('reservation_code', 'length', 'max' => 20),
            array('booking_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user, reservation_code, booking_date, status', 'safe', 'on' => 'search'),
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
            'user' => 'User',
            'reservation_code' => 'Reservation Code',
            'booking_date' => 'Booking Date',
            'status' => 'Status',
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
        $criteria->compare('user', $this->user);
        $criteria->compare('reservation_code', $this->reservation_code, true);
        $criteria->compare('booking_date', $this->booking_date, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['pageSize'],
            ),
            'sort' => array('defaultOrder' => 'id DESC')
        ));
    }

    public function search_history() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->condition = 't.user=' . Yii::app()->user->id;

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.user', $this->user);
        $criteria->compare('t.reservation_code', $this->reservation_code, true);
        $criteria->compare('t.booking_date', $this->booking_date, true);
        $criteria->compare('t.status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['pageSize'],
            ),
            'sort' => array('defaultOrder' => 'booking_date DESC')
        ));
    }

    public function search_user($user_id) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->condition = 't.user=' . $user_id;

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.user', $this->user);
        $criteria->compare('t.reservation_code', $this->reservation_code, true);
        $criteria->compare('t.booking_date', $this->booking_date, true);
        $criteria->compare('t.status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['pageSize'],
            ),
            'sort' => array('defaultOrder' => 'booking_date DESC')
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Reservation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function checkResarvation($room, $date, $from, $to, $location, $resort) {
        $date2 = date('Y-m-d');
        $reservation_status = Yii::app()->db->createCommand()
                ->select('reservation_status')
                ->from('{{reservation_item}}')
                ->where('date="' . $date . '" AND room=' . $room . ' AND reservation_status!=3')
                ->queryScalar();
        if (strtotime($date) < strtotime($date2)) {
            if ($reservation_status == 1) {
                return '<div class="btn_yellow">On Process</div>';
            } elseif ($reservation_status == 2) {
                return '<div class="btn_red">Booked</div>';
            } else {
                return '<div class="btn_white">Not Booked</div>';
            }
        } else {
            if ($reservation_status == 1) {
                return '<div class="btn_yellow">On Process</div>';
            } elseif ($reservation_status == 2) {
                return '<div class="btn_red">Booked</div>';
            } else {
                return CHtml::link('Book Now', array('reservation/add', 'room' => $room, 'date' => $date, 'from' => $from, 'to' => $to, 'location' => $location, 'resort' => $resort), array('class' => 'btn_green'));
            }
        }
    }

    public static function checkResarvationAdmin($room, $date) {
        $date2 = date('Y-m-d');
        $reservation_status = Yii::app()->db->createCommand()
                ->select('reservation_status')
                ->from('{{reservation_item}}')
                ->where('date="' . $date . '" AND room=' . $room)
                ->queryScalar();
        if (strtotime($date) < strtotime($date2)) {
            if ($reservation_status == 1) {
                return '<div class="btn_yellow">On Process</div>';
            } elseif ($reservation_status == 2) {
                return '<div class="btn_red">Booked</div>';
            } else {
                return '<div class="btn_white">Not Booked</div>';
            }
        } else {
            if ($reservation_status == 1) {
                return '<div class="btn_yellow">On Process</div>';
            } elseif ($reservation_status == 2) {
                return '<div class="btn_red">Booked</div>';
            } else {
                return '<div class="btn_green">Open</div>';
            }
        }
    }

    public static function getCode($id) {
        $value = Reservation::model()->findByAttributes(array('id' => $id));
        if (empty($value->reservation_code)) {
            return null;
        } else {
            return $value->reservation_code;
        }
    }

    public static function getStatus($id) {
        $value = Reservation::model()->findByAttributes(array('id' => $id));
        if (empty($value->status)) {
            return null;
        } else {
            return $value->status;
        }
    }

    public static function checkAction($reservation_id) {
        $status = Reservation::getStatus($reservation_id);
        if ($status == 1) {
            echo CHtml::link('Pay Now', array('reservation/payment', 'id' => $reservation_id), array('class' => 'btn btn-default btn-sm', 'style' => 'margin-right:5px;'));
            echo CHtml::link('Cancel', array('reservation/cancel', 'id' => $reservation_id), array('class' => 'btn btn-default btn-sm'));
        }
    }

}
