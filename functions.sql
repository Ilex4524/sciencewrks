CREATE OR REPLACE FUNCTION main.add_admin_manually(_firstname VARCHAR, _lastname VARCHAR, _birth_date TIMESTAMP,
							_inn, _email, _password) AS $$
	BEGIN
		INSERT INTO main.staff(firstname, lastname, birth_date, inn) VALUES ($1, $2, $3, $4);
		INSERT INTO main.department_staff(employee) VALUES((SELECT currval('main.staff_id_seq')));
		INSERT INTO main.users(id, email, password) VALUES((SELECT currval('main.department_staff_id_seq')), $5, $6);
		INSERT INTO main.admins(id) VALUES((SELECT currval('main.users_id_seq')));
	END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION main.is_email_exists(_email TEXT) 
RETURNS INTEGER AS $$
	BEGIN
		IF EXISTS(SELECT id FROM main.users WHERE email = $1) THEN
			RETURN 1;
		ELSE RETURN 0; END IF;
	END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION main.is_inn_exists(_inn CHAR(10)) 
RETURNS INTEGER AS $$
	BEGIN
		IF EXISTS(SELECT id FROM main.staff WHERE inn = $1) THEN
			RETURN 1;
		ELSE RETURN 0; END IF;
	END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION main.user_login(_email TEXT) 
RETURNS TABLE(_password TEXT, _id INT) AS $$
	BEGIN
		RETURN QUERY SELECT password, id FROM main.users WHERE email = $1;
	END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION main.user_register(_lastname VARCHAR, _firstname VARCHAR, _email VARCHAR, 
						_inn VARCHAR, _birthday TIMESTAMP, _password TEXT, _avatar TEXT) 
RETURNS INT AS $$
	BEGIN
		INSERT INTO main.staff(lastname, firstname, inn, birth_date, photo)
		VALUES(_lastname, _firstname, _inn, _birthday, _avatar);
		INSERT INTO main.users VALUES((SELECT currval('main.staff_id_seq')), _email, _password);
		IF EXISTS (SELECT currval('main.staff_id_seq')) THEN 
			RETURN 1;
		ELSE RETURN 0; END IF;
	END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION main.get_next_avatar() 
RETURNS INT AS $$
	DECLARE 
		avatar INT;
	BEGIN
		SELECT max(id) INTO avatar FROM main.staff;
		IF avatar IS NOT NULL THEN 
			RETURN avatar;
		ELSE RETURN 1; END IF;
	END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION main.check_is_admin(_id INT)
RETURNS INT AS $$
	BEGIN
		RETURN (SELECT COALESCE(id, 0) FROM main.admins WHERE id = $1);
	END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION main.postgres_create_admin(_lastname VARCHAR, _firstname VARCHAR, _birthday TIMESTAMP, 
							_inn VARCHAR, _email VARCHAR, _password TEXT)
RETURNS VOID AS $$
	BEGIN
		INSERT INTO main.staff(lastname, firstname, birth_date, inn) VALUES($1, $2, $3, $4);
		INSERT INTO main.users VALUES((SELECT currval('main.staff_id_seq')), $5, md5($6));
		INSERT INTO main.admins VALUES((SELECT currval('main.staff_id_seq')));
	END;
$$ LANGUAGE plpgsql;
--SELECT main.postgres_create_admin('Ясинская', 'Александра', '01.08.1997', '1111111111', 'ilex4524@gmail.com', 're4524re');

CREATE OR REPLACE FUNCTION main.get_user_data(_id INT)
RETURNS TABLE(firstname VARCHAR, lastname VARCHAR, birth_date TIMESTAMP, inn VARCHAR, photo TEXT, 
		email VARCHAR, is_admin TEXT)
AS $$
	BEGIN
		RETURN QUERY 
		SELECT s.firstname, s.lastname, s.birth_date, s.inn, s.photo, u.email, 
		CASE WHEN a.id IS NULL THEN '' ELSE 'checked' END
		FROM main.staff s NATURAL JOIN main.users u LEFT JOIN main.admins a USING(id)
		WHERE s.id = _id;		 
	END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION main.get_all_users()
RETURNS TABLE(firstname VARCHAR, lastname VARCHAR, birth_date TIMESTAMP, inn VARCHAR, email VARCHAR, id INT)
AS $$
	BEGIN
		RETURN QUERY
		SELECT s.firstname, s.lastname, s.birth_date, s.inn, u.email, u.id 
		FROM main.staff s NATURAL JOIN main.users u;
	END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION main.user_edit(_firstname VARCHAR, _lastname VARCHAR, _birth_date TIMESTAMP, 
						_inn VARCHAR, _email VARCHAR, _admin BOOL, _id INT)
RETURNS INT AS $$
	BEGIN
		UPDATE main.staff SET firstname = $1, lastname = $2, birth_date = $3,
		inn = $4 WHERE id = _id;	
		UPDATE main.users SET email = $5 WHERE id = _id;
		IF _admin = TRUE THEN IF NOT EXISTS (SELECT id FROM main.admins WHERE id = _id) 
		THEN INSERT INTO main.admins VALUES (_id); END IF;
		ELSE IF EXISTS (SELECT id FROM main.admins WHERE id = _id) THEN 
		DELETE FROM main.admins WHERE id = _id; END IF;
		END IF;
		RETURN 1;
	END;
$$ LANGUAGE plpgsql;
