php artisan scandinaver:command CommandName
php artisan scandinaver:query QueryName
php artisan scandinaver:update Domain


START TRANSACTION;

INSERT INTO `cards`(`word_id`, `translate_id`, `type`, language_id)
SELECT card.word_id, card.translate_id, word.sentence, word.language_id FROM card
JOIN word ON (card.word_id = word.id) WHERE 1;

INSERT INTO asset_cards(asset_id, card_id)
SELECT card.asset_id, cards.id FROM card
JOIN cards ON(card.word_id = cards.word_id AND card.translate_id=cards.translate_id);

COMMIT;


php artisan ide-helper:generate


Update word, translate
SET
word.word = (SELECT translate.value FROM translate where word.id = translate.word_id LIMIT 1),
translate.value = (SELECT word.word FROM word where word.id = translate.word_id LIMIT 1)

WHERE translate.sentence = 1
AND word.sentence = 1