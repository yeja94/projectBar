CREATE VIEW Bars_view AS 
	SELECT b.bar_id, b.theme, b.price, b.name, a.street, a.city, a. state, a.zip
	FROM Bars b INNER JOIN bar_address a 
	ON b.name = a.name
	GROUP BY b.bar_id;