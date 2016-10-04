
INSERT INTO Kayttaja (kayttajatunnus, salasana) VALUES ('testikayttaja', 'testisalasana');

INSERT INTO Kayttaja (kayttajatunnus, salasana, admin) VALUES ('testiadmin', 'testiadminsalasana', TRUE);

INSERT INTO Kategoria (nimi, kayttaja_id) VALUES ('Kouluhommat', 1);

INSERT INTO Kategoria (nimi, kayttaja_id) VALUES ('Arkiaskareet', 1);

INSERT INTO Muistiinpano (kayttaja_id ,nimi, prioriteetti, kuvaus, lisatty) VALUES (1, 'Muista tehdä tsohaa', 4, 'Tsohan tietokantasovellus on kesken. Muista tehdä sitä joka viikko. Dedis on maanantaisin!', '2016-09-19');

INSERT INTO Kat_mp (kategoria_id, mp_id) VALUES (1, 1);

INSERT INTO Muistiinpano (kayttaja_id, nimi, prioriteetti, kuvaus, lisatty) VALUES (1, 'Muista tehdä javalabraa', 5, 'Javalabran työkin on kesken, dedis on perjantaisin!', '2016-09-26');

INSERT INTO Kat_mp (kategoria_id, mp_id) VALUES (1, 2);

INSERT INTO Kat_mp (kategoria_id, mp_id) VALUES (2, 1);