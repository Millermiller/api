SELECT a0_.id AS id_0,
a0_.result AS result_1,
a0_.user_id AS user_id_2,
a0_.language_id AS language_id_3,
a0_.created_at AS created_at_4,
a0_.updated_at AS updated_at_5,
a0_.asset_id AS asset_id_6,
a0_.user_id AS user_id_7,
a0_.lang AS lang_8

FROM assets_users a1_, assets_users a0_
INNER JOIN assets a2_ ON a0_.asset_id = a2_.id
WHERE a0_.user_id = ?
AND a2_.language_id = ?
