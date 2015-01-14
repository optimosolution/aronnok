<?php

class ReservationController extends BackEndController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    
    protected function beforeAction($action) {
        $access = $this->checkAccess(Yii::app()->controller->id, Yii::app()->controller->action->id);
        if ($access == 1) {
            return true;
        } else {
            Yii::app()->user->setFlash('error', "You are not authorized to perform this action!");
            $this->redirect(array('/site/noaccess'));
        }
    }

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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'delete', 'create', 'update', 'add', 'payment', 'remove'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'create', 'update'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionPayment($id, $user) {
        $model = new Payment;
        $path = Yii::app()->basePath . '/../uploads/payment_slip';
        if (!is_dir($path)) {
            mkdir($path);
        }

        if (isset($_POST['Payment'])) {
            $model->attributes = $_POST['Payment'];
            $model->user = $user;
            //$model->reservation_code = Reservation::getCode($id);
            $model->dates = new CDbExpression('NOW()');
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
                    Yii::app()->db->createCommand('UPDATE {{reservation}} SET `status` = 4 WHERE user=' . $user . ' AND reservation_code=' . $model->reservation_code)->execute();
                    $this->redirect(array('reservation/view', 'id' => $id));
                }
            }
        }

        $this->render('payment', array(
            'model' => $model,
        ));
    }

    public function actionAdd($id, $user) {
        $model = new ReservationItem;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ReservationItem'])) {
            $model->attributes = $_POST['ReservationItem'];
            $model->reservation_id = $id;
            $model->user = $user;
            $model->rent = Room::getRent($model->room);
            $model->reservation_status = 1;
            $model->status = 0;
            if ($model->save()) {
                $this->redirect(array('reservation/view', 'id' => $id));
            }
        }

        $this->render('add', array(
            'model' => $model,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $modelr = new ReservationItem('search');
        $modelr->unsetAttributes();  // clear any default values
        if (isset($_GET['ReservationItem'])) {
            $modelr->attributes = $_GET['ReservationItem'];
        }

        //Payment
        $modelp = new Payment('search');
        $modelp->unsetAttributes();  // clear any default values
        if (isset($_GET['Payment'])) {
            $modelp->attributes = $_GET['Payment'];
        }

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'modelr' => $modelr,
            'modelp' => $modelp,
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
                if ($model->status == 2) {
                    //send confirmation mail to user  
                    $to = User::get_user_email($model->user);
                    $subject = 'Payment Confirmation for ' . Yii::app()->name;
                    $message = 'Dear ' . User::get_user_name($model->user) . ',<br /><br />';
                    $message .= 'You have submited Payment information from your ' . Yii::app()->name . ' account. Your Reservation has been Confirmed.';
                    $message .= '<br /><br />Warm regards,<br />' . Yii::app()->name . '<br />' . Yii::app()->params['adminEmail'] . '<br />http://' . $_SERVER["SERVER_NAME"];
                    Recovery::sendMailRecovery($to, $subject, $message);
                    //change Reservation item status
                    Yii::app()->db->createCommand('UPDATE {{reservation_item}} SET `reservation_status` = 2, `status` = 1 WHERE reservation_id=' . $model->id)->execute();
                }
                if ($model->status == 3) {
                    //change Reservation item status
                    Yii::app()->db->createCommand('UPDATE {{reservation_item}} SET `reservation_status` = 3 WHERE reservation_id=' . $model->id)->execute();
                }
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
            Yii::app()->db->createCommand('DELETE FROM {{reservation_item}} WHERE reservation_id=' . $id)->execute();

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
