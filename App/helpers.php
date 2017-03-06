<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 2/2/2017
     * Time: 12:29 PM
     */

    function flash($msg, $type = 'info')
    {
        session()->flash('flash_msg', $msg);
        session()->flash('flash_msg_type', $type);
    }