<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Exceptions\CourseAlreadyAddedException;
use Models\Course;
use Utility\Auth;

class CourseController extends Controller
{
    private Course $courseModel;
    private array $data = [
        'courses' =>[],
        'error' => '',
        'message' => ''
    ];

    public function __construct()
    {   
        $this->courseModel = new Course();
    }

    public function findAll() : mixed
    {   
        $courses = $this->courseModel->findAll();
        $this->data['courses'] = $courses;
        
        return $this->render('courses/courses', $this->data);
    }

    public function findAllByUserId() : mixed
    {   
        if (!Auth::isLoggedIn()) {
            return $this->render('login');
        }

        $user = $_SESSION['user'];
        $this->data['courses'] = $this->courseModel->findAllByUserId($user['id']);
        return $this->render('courses/mycourses', $this->data);
    }

    public function addCourseToFavourite() : mixed
    {
        try{
            $user = $_SESSION['user'];
            $courseId = $_POST['course_id'];
            $this->courseModel->addCourseToFavourite($user['id'], $courseId);
            $this->data['courses'] = $this->courseModel->findAll();
            $message = 'Successfully added course to favourite';
            $this->data['message'] = $message;
            return $this->render('courses/courses', $this->data);
        }catch(CourseAlreadyAddedException $exception) {
            return $this->setData('courses/courses', $exception->getMessage());
       }
    }

    public function removeCourseFromFavourite() : mixed
    {
        try{
            $user = $_SESSION['user'];
            $courseId = $_POST['course_id'];
            $this->courseModel->removeCourseFromFavourite($user['id'], $courseId);
            $this->data['courses'] = $this->courseModel->findAllByUserId($user['id']);
            $message = 'Successfully removed course from favourite';
            $this->data['message'] = $message;
            return $this->render('courses/mycourses', $this->data);
        }catch(CourseAlreadyAddedException $exception) {
            return $this->setData('courses/mycourses', $exception->getMessage());
       }
    }

    private function setData($view, $error)
    {      
        $this->data['error'] = $error;
        $this->data['courses'] = $this->courseModel->findAll();
        return $this->render($view, $this->data);
    }
}