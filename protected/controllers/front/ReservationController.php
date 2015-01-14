<?php

class ReservationController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'room'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'add', 'checkout', 'remove', 'continue', 'payment', 'history', 'cancel'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCancel() {
        Yii::app()->db->createCommand('UPDATE {{reservation}} SET `status` = 3 WHERE user=' . Yii::app()->user->id . ' AND id=' . $_REQUEST['id'])->execute();
        //change Reservation item status
        Yii::app()->db->createCommand('UPDATE {{reservation_item}} SET `reservation_status` = 3 WHERE reservation_id=' . $_REQUEST['id'])->execute();
        Yii::app()->user->setFlash('success', 'Payment has been Canceled successfully');
        $this->redirect(array('reservation/history'));
    }

    public function actionHistory() {
        $model = new Reservation('search_history');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Reservation'])) {
            $model->attributes = $_GET['Reservation'];
        }

        $this->render('history', array(
            'model' => $model,
        ));
    }

    public function actionPayment() {
        $model = new Payment;
        $path = Yii::app()->basePath . '/../uploads/payment_slip';
        if (!is_dir($path)) {
            mkdir($path);
        }

        if (isset($_POST['Payment'])) {
            $model->attributes = $_POST['Payment'];
            $model->dates = new CDbExpression('NOW()');
            $model->user = Yii::app()->user->id;
            if ($model->validate()) {
                //Picture upload script
                if (@!empty($_FILES['Payment']['name']['payment_slip'])) {
                    $model->payment_slip = $_POST['Payment']['payment_slip'];

                    if ($model->validate(array('payment_slip'))) {
                        $model->payment_slip = CUploadedFile::getInstance($model, 'payment_slip');
                    } else {
                        $model->payment_slip = null;
                    }
                    $model->payment_slip->saveAs($path . '/' . time() . '_' . str_replace(' ', '_', strtolower($model->payment_slip)));
                    $model->payment_slip = time() . '_' . str_replace(' ', '_', strtolower($model->payment_slip));
                }
                if ($model->save()) {
                    Yii::app()->db->createCommand('UPDATE {{reservation}} SET `status` = 4 WHERE user=' . Yii::app()->user->id . ' AND reservation_code=' . $model->reservation_code)->execute();
                    //send mail to user            
                    $subject = 'Payment information for ' . Yii::app()->name;
                    $message = 'Dear ' . User::get_user_name(Yii::app()->user->id) . ',<br /><br />';
                    $message .= 'Thanks for the payment. Your booking will be confirmed by next half an hour. Please contact us if you do not get a confirmatory email. Your Reservation code was <strong>' . $model->reservation_code . '</strong>.';
                    $message .= '<br /><br />Warm regards,<br />' . Yii::app()->name . '<br />' . Yii::app()->params['bookingEmail'] . '<br />http://' . $_SERVER["SERVER_NAME"];
                    Recovery::sendMailRecovery(Yii::app()->user->email, $subject, $message);
                    //send mail to Administrator            
                    $message1 = 'Dear ' . Yii::app()->name . ',<br /><br />';
                    $message1 .= User::get_user_name(Yii::app()->user->id) . ' have submited payment for Reservation code <strong>' . $model->reservation_code . '</strong>. He has been paid <strong>BDT:' . $model->amount . '</strong>.';
                    $message1 .= '<br /><br />Warm regards,<br />' . Yii::app()->name . '<br />' . Yii::app()->params['bookingEmail'] . '<br />http://' . $_SERVER["SERVER_NAME"];
                    Recovery::sendMailRecovery(Yii::app()->params['bookingEmail'], $subject, $message1);

                    Yii::app()->user->setFlash('success', 'Payment has been completed successfully');
                    $this->redirect(array('reservation/index'));
                }
            }
        }

        $this->render('payment', array(
            'model' => $model,
        ));
    }

    public function actionContinue() {
        $model = new Reservation;
        $model->user = Yii::app()->user->id;
        $model->reservation_code = time();
        $model->booking_date = new CDbExpression('NOW()');
        $model->status = 1;
        if ($model->save()) {
            Yii::app()->db->createCommand('UPDATE {{reservation_item}} SET `reservation_id` = ' . $model->id . ' WHERE user=' . Yii::app()->user->id . ' AND reservation_id IS NULL')->execute();
            //send mail to user            
            $subject = 'Reservation information for ' . Yii::app()->name;
            $message = 'Dear ' . User::get_user_name(Yii::app()->user->id) . ',<br /><br />';
            $message .= 'Thanks for choosing us. Your booking will be confirmed after payment. However, the process will be valid for next 15 minutes only. Your Reservation code is <strong>' . $model->reservation_code . '</strong>. Total Amount ' . ReservationItem::getTotalAmount($model->id) . '.';
            $message .= '<br /><br />Warm regards,<br />' . Yii::app()->name . '<br />' . Yii::app()->params['bookingEmail'] . '<br />http://' . $_SERVER["SERVER_NAME"];
            Recovery::sendMailRecovery(Yii::app()->user->email, $subject, $message);
            //send mail to Administrator            
            $message1 = 'Dear ' . Yii::app()->name . ',<br /><br />';
            $message1 .= User::get_user_name(Yii::app()->user->id) . ' have requested for Reservation from ' . Yii::app()->name . ' account. Reservation code is <strong>' . $model->reservation_code . '</strong>. Total Amount ' . ReservationItem::getTotalAmount($model->id) . '.';
            $message1 .= '<br /><br />Warm regards,<br />' . Yii::app()->name . '<br />' . Yii::app()->params['bookingEmail'] . '<br />http://' . $_SERVER["SERVER_NAME"];
            Recovery::sendMailRecovery(Yii::app()->params['bookingEmail'], $subject, $message1);

            //Send message to user mobile
            //$mobile_number = User::get_user_mobile(Yii::app()->user->id);
            //$mobile_message = 'Your booking will be confirmed after payment. Reservation code ' . $model->reservation_code . '. Amount ' . ReservationItem::getTotalAmount($model->id);
            //echo @$this->send_sms($mobile_message, $mobile_subject);
            //echo $this->send_sms($mobile_message, '01911731214');
            //echo send_sms("Hello World", "01911731214", 'pv', "Aronnok");
            //echo @$this->send_sms($mobile_message, $mobile_number, 'pv', 'Aronnok');
            //print $mobile_number . '</br>' . $mobile_message;

            Yii::app()->user->setFlash('success', 'Your Reservation code is <strong>' . $model->reservation_code . '</strong>. Also please check your confirmation email for Reservation details.');
            $this->redirect(array('reservation/payment', 'id' => $model->id));
        }
    }

    public function actionCheckout() {
        $model = new ReservationItem('search_chechout');
        $model->unsetAttributes();  // clear any default values        
        if (isset($_GET['ReservationItem'])) {
            $model->attributes = $_GET['ReservationItem'];
        }

        $this->render('checkout', array(
            'model' => $model,
        ));
    }

    public function actionAdd() {
        $model = new ReservationItem;
        $model->user = Yii::app()->user->id;
        $model->resort = Room::getResortFromRoom($_GET['room']);
        $model->room = $_GET['room'];
        $model->date = $_GET['date'];
        $model->reservation_status = 1;
        $model->rent = Room::getRent($_GET['room']);
        $model->status = 0;
        $model->created_on = new CDbExpression('NOW()');

        if ($model->save()) {
            $this->redirect(array('reservation/index', 'from' => $_REQUEST['from'], 'to' => $_REQUEST['to'], 'location' => $_REQUEST['location'], 'resort' => $_REQUEST['resort']));
        }
    }

    public function actionRoom($id) {
        $this->render('room', array(
            'model' => $this->loadModelRoom($id),
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Reservation;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Reservation'])) {
            $model->attributes = $_POST['Reservation'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Reservation'])) {
            $model->attributes = $_POST['Reservation'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionRemove($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModels($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('checkout'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Reservation');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Reservation('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Reservation'])) {
            $model->attributes = $_GET['Reservation'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Reservation the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Reservation::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function loadModelRoom($id) {
        $model = Room::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function loadModels($id) {
        $model = ReservationItem::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Reservation $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'reservation-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
