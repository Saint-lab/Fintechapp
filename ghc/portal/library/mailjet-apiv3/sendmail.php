<?php
/**
* This call sends an email to one recipient, using a validated sender address
* Do not forget to update the sender address used in the sample
*/
use \Mailjet\Resources;
$mj = new \Mailjet\Client(getenv('bac9cffc47a3d9582f98c946d58481c4'), getenv('abb21392562363a60a760c49b97666fe'));
$body = [
    'FromEmail' => "admin@covisclub.com",
    'FromName' => "Covis Club Nigeria",
    'Subject' => "Introducing Covis Club",
    'Text-part' => "Dear Member, welcome to Covisclub",
    'Html-part' => "<h3>Dear Member, welcome to Covisclub!</h3><br/>May the delivery force be with you!",
    'Recipients' => [
        [
            'Email' => "ogbajigodwin@gmail.com"
        ]
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success() && var_dump($response->getData());


?>
