	
CREATE TABLE users(
	id SERIAL NOT NULL,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT pk_users_id PRIMARY KEY(id),
	CONSTRAINT ux_users_username UNIQUE(username)
);

CREATE TABLE courses(
	id SERIAL NOT NULL,
	name VARCHAR(255) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	user_id INT NOT NULL,
	CONSTRAINT pk_courses_id PRIMARY KEY(id),
	CONSTRAINT fk_courses_users_id FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE courses_users(
	user_id INT NOT NULL,
	course_id INT NOT NULL,
	CONSTRAINT fk_user_course_id FOREIGN KEY(user_id) REFERENCES users(id),
	CONSTRAINT fk_course_user_id FOREIGN KEY(course_id) REFERENCES courses(id),
	CONSTRAINT ux_users_courses UNIQUE(user_id,course_id)
);