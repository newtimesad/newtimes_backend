<?php

namespace common\factory;

use common\models\BusinessProfile;

class MailFactory extends \Da\User\Factory\MailFactory
{
    public static function makeKycAcceptedMailerService(BusinessProfile $profile)
    {
        $to = $profile->user->email;
        $from = \Yii::$app->params['senderEmail'];
        $subject = "KYC Verification Accepted";
        $params = [
            'profile' => $profile
        ];

        return self::makeMailerService('kyc_accepted', $from, $to, $subject, 'kyc_accepted', $params);
    }

    public static function makeKycRejectedMailerService(BusinessProfile $profile)
    {
        $to = $profile->user->email;
        $from = \Yii::$app->params['senderEmail'];
        $subject = "KYC Verification Rejected";
        $params = [
            'profile' => $profile
        ];

        return self::makeMailerService('kyc_rejected', $from, $to, $subject, 'kyc_rejected', $params);
    }


}