set @name = 'Великобритания';
set @id = 47;
delete from country_region where country_id in (
SELECT c.ID FROM `country` c left join operator_country oc on oc.country_id = c.ID where c.ID != @id and c.name = @name
);
update port set country_id = @id where country_id in (
SELECT c.ID FROM `country` c left join operator_country oc on oc.country_id = c.ID where c.ID != @id and c.name = @name
);
delete from `country` where ID in (
SELECT c.ID FROM `country` c left join operator_country oc on oc.country_id = c.ID where c.ID != @id and c.name = @name
);