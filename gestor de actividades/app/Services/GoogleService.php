<?php

namespace App\Services;

use Google_Client;
use Google_Service_Classroom;
use Google_Service_Gmail;
use Google_Service_Calendar;

class GoogleService
{
    protected $client;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT'));
        $client->addScope(Google_Service_Classroom::CLASSROOM_COURSES);
        $client->addScope(Google_Service_Gmail::MAIL_GOOGLE_COM);
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $this->client = $client;
    }

    public function getClassroomService()
    {
        return new Google_Service_Classroom($this->client);
    }

    public function getGmailService()
    {
        return new Google_Service_Gmail($this->client);
    }

    public function getCalendarService()
    {
        return new Google_Service_Calendar($this->client);
    }
}
