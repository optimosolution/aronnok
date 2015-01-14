<?php

// php /home/rangamat/public_html/protected/yiic.php cron
class CronCommand extends CConsoleCommand {

    /**
     * Send mail method
     */
    public static function sendMail($email, $subject, $message, $fromName, $fromMail) {
        $adminEmail = $fromName . '<' . $fromMail . '>';
        $headers = "MIME-Version: 1.0\r\nFrom: $adminEmail\r\nReply-To: $adminEmail\r\nContent-Type: text/html; charset=utf-8";
        $message = wordwrap($message, 70);
        $message = str_replace("\n.", "\n..", $message);
        return mail($email, '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $headers);
    }

    public function actionIndex() {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{reservation}}')
                ->where('DATE_ADD(booking_date, INTERVAL 30 MINUTE) < NOW() AND status=1')
                ->queryAll();
        foreach ($array as $key => $values) {
            //change Reservation status
            Yii::app()->db->createCommand('UPDATE {{reservation}} SET `status` = 3 WHERE id=' . $values['id'])->execute();
            //change Reservation item status
            Yii::app()->db->createCommand('UPDATE {{reservation_item}} SET `reservation_status` = 3 WHERE reservation_id=' . $values['id'])->execute();
        }

//        $subject = 'Test mail';
//        $fromNames = Yii::app()->params['adminName'];
//        $fromMails = Yii::app()->params['bookingEmail'];
//        $to_name = 'Saidur Rahman';
//        $to_mail = 'saidurwd@gmail.com';
//        $recipients = "{$to_name}<{$to_mail}>";
//        $body = 'This is a test mail.';
//        $this->sendMail($recipients, $subject, $body, $fromNames, $fromMails);
    }

}
