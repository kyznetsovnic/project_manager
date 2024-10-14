SELECT *
FROM developers
WHERE status = 'active';


SELECT *
FROM projects
WHERE status = 'active';


SELECT
    p.id,
    p.name,
    CONCAT(c.name, ' ', c.surname) AS customer_fullname
FROM projects p
         JOIN customers c on c.id = p.customer_id;


SELECT
    p.id,
    p.name,
    CONCAT(c.name, ' ', c.surname) AS customer,
    GROUP_CONCAT(developer.name SEPARATOR ', ') AS developers
FROM projects p
         JOIN (
    SELECT
        d.id,
        dp.project_id AS pid,
        CONCAT(d.name, ' ', d.surname, ' ', d.patronymic) AS name
    FROM developers d
             JOIN developer_project dp on d.id = dp.developer_id
) AS developer on p.id = developer.pid
         JOIN customers c on p.customer_id = c.id
GROUP BY p.id;


SELECT
    d.id,
    dp.project_id AS pid,
    CONCAT(d.name, ' ', d.surname, ' ', d.patronymic) AS developer_fullname
FROM developers d
         JOIN developer_project dp on d.id = dp.developer_id;


SELECT ROUND(AVG(age), 1) AS age
FROM developers
WHERE status = 'active';


SELECT
    dp.project_id,
    p.name,
    p.status,
    COUNT(developer_id) AS developer_count
FROM developers d
         JOIN developer_project dp on d.id = dp.developer_id
         JOIN projects p on dp.project_id = p.id
WHERE p.status = 'active'
GROUP BY dp.project_id
ORDER BY dp.project_id;


