
CREATE TABLE Kayttaja (
  id SERIAL PRIMARY KEY,
  kayttajatunnus varchar(24) NOT NULL,
  salasana varchar(24) NOT NULL,
  admin boolean DEFAULT FALSE 
);

CREATE TABLE Kategoria (
  nimi varchar(75) NOT NULL,
  id SERIAL PRIMARY KEY,
  kayttaja_id INTEGER REFERENCES Kayttaja(id)
);

CREATE TABLE Muistiinpano (
  id SERIAL PRIMARY KEY,
  nimi varchar(75) NOT NULL,
  prioriteetti INTEGER,
  kategoria_id INTEGER REFERENCES Kategoria(id),
  kuvaus text,
  lisatty date,
  tila boolean DEFAULT FALSE
);

CREATE TABLE Muistilista (
  kayttaja_id INTEGER REFERENCES Kayttaja(id),
  mp_id INTEGER REFERENCES Muistiinpano(id)
);

CREATE TABLE Kat_mp (
  kategoria_id INTEGER REFERENCES Kategoria(id),
  mp_id INTEGER REFERENCES Muistiinpano(id)
);

