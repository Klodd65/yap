<?php
require_once '_includes/functions.php';
require_once '_includes/twilio-client.php';
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

$conferences = $twilioClient->conferences->read(array ("friendlyName" => $_REQUEST['conference_name'] ));
$participants = $twilioClient->conferences($conferences[0]->sid)->participants->read();?>

<Response>
<?php if (count($participants) > 0) {
    insertCallEventRecord(EventId::VOLUNTEER_ANSWERED, (object)['conference_name' => $_REQUEST['conference_name']]);
    error_log("Volunteer picked up or put to their voicemail, asking if they want to take the call, timing out after 15 seconds of no response.") ?>
    <Gather numDigits="1" timeout="15" action="helpline-answer-response.php?conference_name=<?php echo $_REQUEST['conference_name']?>&amp;service_body_id=<?php echo $_REQUEST['service_body_id'] . getSessionLink(true)?>" method="GET">
        <Say voice="<?php echo voice(); ?>" language="<?php echo setting('language') ?>">
            <?php echo word('you_have_a_call_from_the_helpline') ?>
        </Say>
    </Gather>
<?php } else {
    insertCallEventRecord(EventID::CALLER_HUP, (object)['conference_name' => $_REQUEST['conference_name']]);
    error_log("The caller hungup.") ?>
    <Say voice="<?php echo voice(); ?>" language="<?php echo setting('language') ?>">
        <?php echo word('the_caller_hungup') ?>
    </Say>
    <Hangup/>
<?php } ?>
</Response>
