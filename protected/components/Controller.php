<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    public $userData;

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'application.views.layouts.column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'users' => array('*'),
                'actions' => array('login'),
            ),
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function init() {
        $this->statistics();
    }

    public function checkAccess($controller, $action) {
        $val = Yii::app()->db->createCommand()
                ->select('access')
                ->from('{{acl}}')
                ->where('LOWER(controller)="' . $controller . '" AND LOWER(actions)="' . $action . '" AND group_id=' . Yii::app()->user->group . ' AND controller_type=0')
                ->queryScalar();
        if (empty($val)) {
            $val = 1;
        } else {
            $val = $val;
        }
        return $val;
    }

    public function statistics() {
        $model = new Visitor;
        $model->user_type = 0;
        $model->user_id = Yii::app()->user->id;
        $model->user_name = Yii::app()->user->name;
        $model->server_time = new CDbExpression('NOW()');
        $model->page_title = $this->pageTitle;
        $model->page_link = Yii::app()->request->url;
        $model->browser = Yii::app()->browser->getBrowser();
        $model->visitor_ip = $_SERVER['REMOTE_ADDR'];
        $model->save();
    }

    public function get_sponsors($catid) {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{banner}}')
                ->where('published=1 AND catid=' . $catid)
                ->limit(4)
                ->order('ordering ASC, created_on DESC')
                ->queryAll();
        echo'<ul class="thumbnails">';
        foreach ($array as $key => $values) {
            echo '<li class="span2">';
            echo '<div class="thumbnail">';
            $banner = CHtml::image(Yii::app()->baseUrl . '/uploads/banners/' . $values['banner'], $values['name'], array("class" => '', 'title' => $values['name']));
            echo CHtml::link($banner, $values['clickurl'], array('target' => '_blank'));
            echo'</div>';
            echo '</li>';
        }
        echo '</ul>';
    }

    public function get_quote() {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{quote}}')
                ->where('published=1')
                ->order('quote ASC')
                ->queryAll();
        echo '<div id="quotes">';
        foreach ($array as $key => $values) {
            echo '<blockquote class="textItem" style="display: none;">';
            echo '<p>' . $values['quote'] . '</p>';
            echo'<small>' . $values['quoted_by'] . ' <cite title="Source Title">, ' . $values['designation'] . '</cite></small>';
            echo '</blockquote>';
        }
        echo'</div>';
    }

    public function get_banner_logo($catid) {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{banner}}')
                ->where('published=1 AND catid=' . $catid)
                ->order('created_on DESC')
                ->limit('1')
                ->queryAll();

        foreach ($array as $key => $values) {
            $banner = CHtml::image(Yii::app()->baseUrl . '/uploads/banners/' . $values['banner'], Yii::app()->name, array('class' => 'img-responsive alignleft', 'title' => Yii::app()->name));
            echo CHtml::link($banner, $values['clickurl'], array());
        }
    }

    function validate_msisdn($msisdn) {
        $msisdn = trim(preg_replace("/[^0-9]+/", "", $msisdn));
        $msisdn = preg_replace("/^(00)?(88)?0/", "", $msisdn);
        if (strlen($msisdn) != 10 || strncmp($msisdn, "1", 1) != 0) {
            Yii::app()->user->setFlash('error', 'Mobile number not correct!');
            return false;
        }
        $msisdn = "880" . $msisdn;
        return $msisdn;
    }

    public function send_sms($sms_text, $recipients, $ta = 'pv', $mask = '', $type = 'text') {
        $destination = '';
        if ($ta == 'pv') { # private message (to numbers)
            if (!is_array($recipients)) { # one or more numbers specified in string, comma delimited
                $recipients = explode(',', $recipients); # make array of numbers
            }
            $destination = implode(',', array_filter($recipients, "validate_msisdn")); # filter out invalid numbers
            //$destination = implode(',', array_filter($recipients, $this->validate_msisdn($recipients))); # filter out invalid numbers
        } else { # broadcast message (to group)
            $destination = strtoupper(trim($recipients));
        }
        if ($destination == '')
            return false;
        if ($type != 'flash')
            $type = 'text';

        $url = "http://sms.nixtecsys.com/index.php?app=webservices&ta=$ta&u=ecdstest"
                . "&h=c87a61caee57efb3efdbfc54ba458e27a00e9910&to=" . rawurlencode($destination)
                . "&msg=" . rawurlencode($sms_text) . "&mask=" . rawurlencode($mask)
                . "&type=$type";
        return file_get_contents($url);
    }

}
