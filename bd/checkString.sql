DELIMITER //
	CREATE FUNCTION checkString(_name VARCHAR(50)) 
	RETURNS VARCHAR(50) 
	DETERMINISTIC
	BEGIN
		DECLARE backString VARCHAR(50);	
		SET backString = SELECT IFNULL('-1',_name);
		RETURN backString;	
	END

//