-- Lisää INSERT INTO lauseet tähän tiedostoon
-- Kayttaja-taulun testidata
INSERT INTO Kayttaja (kayttajatunnus, salasana) VALUES ('testikayttaja', 'testisalasana');
INSERT INTO Kayttaja (kayttajatunnus, salasana, admin) VALUES ('testiadmin', 'testiadminsalasana', TRUE);
-- Kategoria-taulun testidata
INSERT INTO Kategoria (nimi) VALUES ('Kouluhommat');
-- Muistiinpano-taulun testidata
INSERT INTO Muistiinpano (nimi, prioriteetti, kategoria_id, kuvaus, lisatty) VALUES ('Muista tehdä tsohaa', 5, 1, 'Tsohan tietokantasovellus on kesken. Muista tehdä sitä joka viikko. Dedis on maanantaisin!', '2016-09-19');
-- Muistilista-taulun testidata
INSERT INTO Muistilista (kayttaja_id, mp_id) VALUES (1, 1);
-- Kat_mp taulun testidata
INSERT INTO Kat_mp (kategoria_id, mp_id) VALUES (1, 1);
