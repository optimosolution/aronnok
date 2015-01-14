<?php

class BookController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

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
                'actions' => array('index', 'view', 'create'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update', 'admin', 'delete'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('update', 'admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
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
        $model = new Book;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Book'])) {
            $model->attributes = $_POST['Book'];
            if ($model->save()) {
                $to = 'booking@rangamatiresort.com';
                $subject = 'Booking request from ' . Yii::app()->name;
                $message = 'Name: ' . $model->title . ' ' . $model->first_name . ' ' . $model->last_name . '<br />';
                $message .= 'Email: ' . $model->email . '<br />';
                $message .= 'Mibile: ' . $model->mobile . '<br />';
                $message .= 'Phone: ' . $model->phone . '<br />';
                $message .= 'Address: ' . $model->address . '<br />';
                $message .= 'City: ' . $model->city . '<br />';
                $message .= 'State: ' . $model->state . '<br />';
                $message .= 'Zip code: ' . $model->zip . '<br />';
                $message .= 'Country: ' . Country::getCountry($model->country) . '<br />';
                $message .= 'Special Requests: ' . $model->special_requests . '<br />';
                $message .= 'Arrival: ' . UserAdmin::get_date($model->arrival) . '<br />';
                $message .= 'Departure: ' . UserAdmin::get_date($model->departure) . '<br />';
                $message .= 'Rooms: ' . $model->rooms . '<br />';
                $message .= 'Adults per room: ' . $model->adults_per_room . '<br />';
                $message .= 'Kids Per Room: ' . $model->kids_per_room;
                $fromName = $model->title . ' ' . $model->first_name . ' ' . $model->last_name;
                $fromMail = $model->email;
                $bccList = 'info@rangamatiresort.com';
                Massmail::sendMail($to, $subject, $message, $fromName, $fromMail, $bccList);
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

        if (isset($_POST['Book'])) {
            $model->attributes = $_POST['Book'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Book');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Book('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Book']))
            $model->attributes = $_GET['Book'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Book the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Book::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Book $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'book-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
