<!doctype html>
<?php
set_include_path('/Users/jsheflin/projects/DevChallenge-PHP-OOP');
include_once 'classes/message.php';
include_once 'classes/user.php';

$user = new User();
$message = new Message();
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Render Results</title>

</head>

<body>
    <h1>Echo Messages for Chat ID = 3 Here as HTML</h1>
    <div><?php
/* Call Your Class Here using echo() */
echo $message->getMessagesOrderBy(3, 'html');
?></div>

    <h1>Render Messages for Chat ID = 8 Here as JSON</h1>
    <div><?php /* Call Your Class Here using json_encode() */
echo $message->getMessagesOrderBy(8, 'json');
?></div>

    <h1>Render User ID = 100 Here as JSON</h1>
    <div><?php /* Call Your Class Here using json_encode() */
echo $user->getUser(100);
?></div>

    <h1>Echo Message ID = 459 Here as HTML</h1>
    <div><?php /* Call Your Class Here using echo() */
echo $message->getMessageAsHtml(459);
?></div>
</body>
</html>