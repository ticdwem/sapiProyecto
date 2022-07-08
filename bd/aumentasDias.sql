DECLARE _dayOfWeek INT;
DECLARE _salida date
SELECT WEEKDAY(CURDATE()) INTO _dayOfWeek;


if(_dayOfWeek = 6) then
	set _salida = select DATE_ADD(CURDATE(), INTERVAL 2 DAY);
ELSE
	set _salida = select DATE_ADD(CURDATE(), INTERVAL 2 DAY);
END if;

RETURN _salida;