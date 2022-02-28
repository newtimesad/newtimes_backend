<?php

/** @var BusinessProfile $profile */

use common\models\BusinessProfile;

?>
<div class="kyc-accepted">
    <p>Hello,</p>
    <p>Your KYC verification for <?= $profile->name ?> profile has been rejected.</p>
    <p>Please check the profile information and photos</p>
</div>
