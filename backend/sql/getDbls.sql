SELECT c.*, oc.id as oc_id
FROM `country` c left join operator_country oc on oc.country_id = c.ID
ORDER BY `name`, c.`ID`
LIMIT 50