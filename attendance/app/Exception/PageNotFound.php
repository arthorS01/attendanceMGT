<?php

namespace app\Exception;

use Exception;

class PageNotFound extends Exception{

    protected $message = "The page is not found bro";
}