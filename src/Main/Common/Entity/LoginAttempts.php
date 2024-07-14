<?php

namespace Microfw\Src\Main\Common\Entity;

/**
 * Description of LoginAttempts
 *
 * @author ARGomes
 */
class LoginAttempts extends ModelClass {

    protected $logTimestamp = false;
    protected $table_db = "loginattempts";
    protected $table_columns_like_db = [];
    protected $table_id_db = "user_id";
    private int $user_id;
    private int $time;

    /**
     * Get the value of id
     */
    public function getUser_Id() {
        if (isset($this->user_id)) {
            return $this->user_id;
        } else {
            return null;
        }
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setUser_Id($user_id) {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of time
     */
    public function getTime() {
        if (isset($this->time)) {
            return $this->time;
        } else {
            return null;
        }
    }

    /**
     * Set the value of time
     *
     * @return  self
     */
    public function setTime($time) {
        $this->time = $time;

        return $this;
    }
}
