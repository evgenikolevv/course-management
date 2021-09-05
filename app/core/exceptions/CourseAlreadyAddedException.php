<?php

namespace Core\Exceptions;

use Exception;

class CourseAlreadyAddedException extends Exception
{
    private const COURSE_ALREADY_ADDED = 'This course is already added to favourite';

    public function __construct() {

        parent::__construct(self::COURSE_ALREADY_ADDED);
    }
}