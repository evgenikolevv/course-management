# Course Management

Web app for course management. 
The application can act like website and rest api.  
In order to act like a rest api add header <b>course-api - Course API</b> in request and the application will start responding with jsons.    

## Features
1. Login
2. Register
3. Course Management

## Used tools
- PHP 8
- PostgreSQL
- HTML5
- CSS3
- Bootstrap 5
- XAMPP

## Rest API Documentation

### Authentication

Method | URL | Description | Request | Response |
--- | --- | --- | --- | ---
POST | /login | Login | Provide JSON with username and password |  
POST | /register | register | Provide JSON with username,password,firstname,lastname |  

### Course Management

Method | URL | Description | Request | Response |
--- | --- | --- | --- | ---
GET | /courses | lists all courses from database |  | JSON  
POST | /courses | adds course to favourite | Provide JSON with id of course |  
GET | /mycourses | lists all favourite courses |  | JSON  
POST | /mycourses | removes course from favourite | Provide id of course |    

## Requests

Register
> {  
> &nbsp; &nbsp; &nbsp; "username" : "user1",  
> &nbsp; &nbsp; &nbsp; "password" : "user1"  
> &nbsp; &nbsp; &nbsp; "password" : "Ivan"  
> &nbsp; &nbsp; &nbsp; "password" : "Ivanov"  
>}


Login
> {  
> &nbsp; &nbsp; &nbsp; "username" : "user1",  
> &nbsp; &nbsp; &nbsp; "password" : "user1"  
> }

Add course to favourite
> {  
> &nbsp; &nbsp; &nbsp; "course_id" : "1",  
> }

Remove course from favourite
> {  
> &nbsp; &nbsp; &nbsp; "course_id" : "1",  
> }

### Developed by Evgeni Kolev

