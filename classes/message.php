<?php

class Message
{

    private $id;
    private $chatid;
    private $message;
    private $userid;
    private $ts;
    private $jsonContent;

    public function __construct()
    {
        $this->jsonContent = file_get_contents('data/messages.json');
    }
    public function getName($userid)
    {
        return $user->getName($userid);
    }

    public function getMessage($chatid, $format)
    {
        $jsonData = json_decode($this->jsonContent, true);
        return (json_last_error() == JSON_ERROR_NONE);

        foreach ($jsonData as $key => $value) {
            if ($value['chatid'] == $chatid) {
                if ($format == 'html') {
                    $message = $value['message'];
                } elseif ($format == 'json') {
                    print_r($value['message']);
                    $message = $value['message'];
                }
                return $message;
            }
        }
    }

    public function getMessagesOrderBy($chatid, $format)
    {
        $jsonData = json_decode($this->jsonContent, true);
        //return (json_last_error() == JSON_ERROR_NONE);

        usort($jsonData, function ($a, $b) {
            return $a['ts'] <=> $b['ts'];
        });
        foreach ($jsonData as $key => $value) {
            if ($value['chatid'] == $chatid) {
                $value['ts'] = $this->fixTime($value['ts']);
                if ($format == 'html') {
                    echo 'chatid:'. " : " . $value['chatid'] . "<br />";
                    echo 'userid:'. " : " . $value['userid'] . "<br />";
                    echo 'message:'. " : " . $value['message'] . "<br />";
                    echo 'ts:'. " : " . $value['ts'] . "<br />";

                } else {
                    echo json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_INVALID_UTF8_IGNORE | JSON_INVALID_UTF8_SUBSTITUTE | JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_LINE_TERMINATORS | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);

                }
            }
        }
    }

    public function getMessageAsHtml($id)
    {
        $jsonData = json_decode($this->jsonContent, true);

        foreach ($jsonData as $key => $value) {
            if ($value['id'] == $id) {
                $message = $value['message'];

                  return json_encode($message,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }
        }
    }

    public function fixTime($ts)
    {

        $datetime = new DateTime();
        $datetime->setTimestamp($ts);

        $ny_time = new DateTimeZone('America/New_York');
        $datetime->setTimezone($ny_time);
        return $datetime->format('Y-m-d H:i:s');

    }

}
