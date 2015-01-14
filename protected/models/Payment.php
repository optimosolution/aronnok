<?php

/**
 * This is the model class for table "{{payment}}".
 *
 * The followings are the available columns in table '{{payment}}':
 * @property string $id
 * @property integer $user
 * @property string $reservation_code
 * @property string $bkash_tno
 * @property string $amount
 * @property string $payment_slip
 * @property string $dates
 */
class Payment extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{payment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user, reservation_code, amount, dates', 'required'),
            array('user, reservation_code', 'numerical', 'integerOnly' => true),
            array('reservation_code, bkash_tno', 'length', 'max' => 50, 'min' => 10),
            array('amount', 'length', 'max' => 13),
            array('payment_slip', 'length', 'max' => 250),
            array('reservation_code', 'checkCode'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user, reservation_code, bkash_tno, amount, payment_slip, dates', 'safe', 'on' => 'search'),
        );
    }

    public function checkCode($attribute, $params) {
        $total = Yii::app()->db->createCommand()
                ->select('COUNT(*)')
                ->from('{{reservation}}')
                //->where('user=' . Yii::app()->user->id . ' AND reservation_code="' . $this->reservation_code . '"')
                ->where('reservation_code="' . $this->reservation_code . '"')
                ->queryScalar();

        if ($total <= 0) {
            $this->addError($attribute, 'Reservation Code not matching. Please enter correct Reservation Code.');
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
            'user' => 'User',
            'reservation_code' => 'Reservation Code',
            'bkash_tno' => 'Bkash TrxID',
            'amount' => 'Amount',
            'payment_slip' => 'Payment Slip',
            'dates' => 'Dates',
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
    public function search($reservation_code) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->condition = 't.reservation_code=' . $reservation_code;

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.user', $this->user);
        $criteria->compare('t.reservation_code', $this->reservation_code, true);
        $criteria->compare('t.bkash_tno', $this->bkash_tno, true);
        $criteria->compare('t.amount', $this->amount, true);
        $criteria->compare('t.payment_slip', $this->payment_slip, true);
        $criteria->compare('t.dates', $this->dates, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Payment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function get_payment_slip($id) {
        $value = Payment::model()->findByAttributes(array('id' => $id));
        $filePath = Yii::app()->basePath . '/../uploads/payment_slip/' . $value->payment_slip;
        if ((is_file($filePath)) && (file_exists($filePath))) {
            return CHtml::image(Yii::app()->baseUrl . '/uploads/payment_slip/' . $value->payment_slip, 'Slip', array('alt' => $value->reservation_code, 'class' => 'nav-user-photo', 'title' => $value->reservation_code, 'style' => 'width:50px;'));
        } else {
            return 'No Slip';
        }
    }

}
