rm duplicates

WITH Duplikate AS (
    SELECT ID, vorname,
           ROW_NUMBER() OVER (PARTITION BY ID ORDER BY vorname) AS rn
    FROM Test
)
DELETE FROM Test
WHERE ID IN (
    SELECT ID
    FROM Duplikate
    WHERE rn > 1
);

