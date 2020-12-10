<?php


namespace App;


class Tracker
{
    private $tracking_data = [];

    /**
     * Tracker constructor.
     *
     * @package App
     */
    public function __construct()
    {
        $this->saveTrackingDataToDB();
    }

    /**
     * Set $tracking_data array to latest history with email, session id,time and request URI
     *
     * @return array
     */
    private function setTrackingData()
    {
        return $this->tracking_data = [
            'email' => $_SESSION['email'] ?? null,
            'session_id' => session_id(),
            'time' => $this->getTimeVisited(),
            'REQUEST_URI' => $_SERVER['REQUEST_URI'],
        ];
    }

    /**
     * Write tracking data to database
     */
    private function saveTrackingDataToDB(): void
    {
        $this->setTrackingData();
        App::$db->insertRow('tracker', $this->tracking_data);
    }


    private function getTimeVisited()
    {
        date_default_timezone_set('Europe/Vilnius');
        return date('Y-m-d H:i:s');
    }

    /**
     * Get tracking data array;
     *
     * @return array
     */
    public function getTrackingData(): array
    {
        return $this->tracking_data;
    }

    /**
     * Get browsing history of user by user email
     *
     * @param string $user_email
     * @return array
     */
    public function getUserHistoryByEmail(string $user_email): array
    {
        return App::$db->getRowsWhere('tracker', ['email' => $user_email]) ?? [];
    }


    /**
     * Get browsing history of user by session ID
     *
     * @param string $user_session_id
     * @return array
     */
    public function getUserHistoryBySessionId(string $user_session_id): array
    {
        return App::$db->getRowsWhere('tracker', ['session_id' => $user_session_id]) ?? [];
    }

    public function run()
    {
    }

}