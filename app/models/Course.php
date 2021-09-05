<?php

namespace Models;

use Core\Database;
use Core\Exceptions\CourseAlreadyAddedException;

class Course
{   
    private const FIND_ALL = "SELECT id, name, created_at, updated_at, user_id FROM courses;";

    private const INSERT_INTO_USERS_COURSES = "INSERT INTO  courses_users(user_id, course_id) VALUES (:user_id, :course_id);";

    private const FIND_ALL_BY_USER_ID = "SELECT courses.id, courses.name, courses.created_at, courses.updated_at, courses.user_id FROM courses
                                         JOIN courses_users ON courses_users.course_id = courses.id
                                         JOIN users ON users.id=courses_users.user_id
                                         WHERE users.id = :id;";

    private const CHECK_IF_USERS_COURSES_ARE_ALREADY_ADDED = "SELECT user_id, course_id FROM courses_users 
                                                              WHERE user_id = :user_id AND course_id = :course_id;";

    private const REMOVE_FROM_USERS_COURSES = " DELETE FROM courses_users WHERE user_id = :user_id AND course_id = :course_id;";

    private Database $handler;

    public function __construct()
    {
        $this->handler = new Database();
    }

    public function findAll() : mixed
    {
        $this->handler->query(self::FIND_ALL);
        $courses = $this->handler->fetchAll();

        return $courses;
    }

    public function addCourseToFavourite($userId, $courseId) : void
    {   
        $this->checkIfCourseIsAddedToFavourite($userId, $courseId);

        $this->handler->query(self::INSERT_INTO_USERS_COURSES);
        $this->handler->bind(':user_id',$userId);
        $this->handler->bind(':course_id', $courseId);

        $this->handler->execute();
    }

    public function findAllByUserId(int $userId) : mixed
    {   
        $this->handler->query(self::FIND_ALL_BY_USER_ID);
        $this->handler->bind(':id',$userId);
        return $this->handler->fetchAll();
    }

    public function removeCourseFromFavourite($userId, $courseId) : void
    {
        $this->handler->query(self::REMOVE_FROM_USERS_COURSES);
        $this->handler->bind(':user_id', $userId);
        $this->handler->bind(':course_id', $courseId);

        $this->handler->execute();
    }

    private function checkIfCourseIsAddedToFavourite(int $userId, int $courseId) : bool
    {
        $this->handler->query(self::CHECK_IF_USERS_COURSES_ARE_ALREADY_ADDED);
        $this->handler->bind(':user_id', $userId);
        $this->handler->bind(':course_id', $courseId);

        $exists = $this->handler->fetchBool();

        if($exists) {
            throw new CourseAlreadyAddedException();
        }

        return false;
    }
}