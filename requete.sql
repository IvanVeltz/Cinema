-- Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur
SELECT 
    f.titre,
    f.annee_sortie,
    TIME_FORMAT(SEC_TO_TIME(f.duree * 60), '%H:%i') AS duree_format_hh_mm,
    CONCAT(p.prenom, ' ', p.nom) AS realisateur
FROM 
    realisateur r
INNER JOIN 
    personne p ON p.id_personne = r.id_personne
INNER JOIN 
    film f ON f.id_realisateur = r.id_realisateur

-- Liste des films dont la durée excède 2h15 classés par durée (du + long au + court)
SELECT 
    f.titre,
    TIME_FORMAT(SEC_TO_TIME(f.duree * 60), '%H:%i') AS duree_format_hh_mm
FROM 
    film f
WHERE 
	f.duree > 135
ORDER BY
	f.duree DESC


-- Liste des films d’un réalisateur (en précisant l’année de sortie) 
SELECT 
    f.titre,
    f.annee_sortie,
    CONCAT(p.prenom, ' ', p.nom) AS realisateur
FROM 
    realisateur r
INNER JOIN 
    personne p ON p.id_personne = r.id_personne
INNER JOIN 
    film f ON f.id_realisateur = r.id_realisateur
WHERE 
    r.id_realisateur = 1

-- Nombre de films par genre (classés dans l’ordre décroissant)

SELECT
    g.type,
    COUNT(e.id_film) AS nbr_de_film
FROM
    etre e
INNER JOIN
    genre g ON g.id_genre = e.id_genre
GROUP BY
    e.id_genre
ORDER BY 
    nbr_de_film DESC

--  Nombre de films par réalisateur (classés dans l’ordre décroissant)
SELECT 
    CONCAT(p.prenom, ' ', p.nom) AS realisateur,
    COUNT(f.id_film) AS nbr_de_film
FROM 
    film f 
INNER JOIN 
    realisateur r ON r.id_realisateur = f.id_realisateur
INNER JOIN 
    personne p ON p.id_personne = r.id_personne
GROUP BY 
    r.id_realisateur 
ORDER BY 
    nbr_de_film DESC

-- Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe

SELECT 
    f.titre,
    CONCAT(p.prenom, ' ', p.nom) AS acteurs,
    p.sexe
FROM 
    casting c
INNER JOIN 
    acteur a ON a.id_acteur = c.id_acteur
INNER JOIN 
    personne p ON p.id_personne = a.id_personne
INNER JOIN 
    film f ON f.id_film = c.id_film
WHERE 
    c.id_film = 1

-- Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de
-- sortie (du film le plus récent au plus ancien)

SELECT 
    f.titre,
    r.nom_role,
    f.annee_sortie
FROM 
    casting c
INNER JOIN 
    acteur a ON a.id_acteur = c.id_acteur
INNER JOIN 
    personne p ON p.id_personne = a.id_personne
INNER JOIN 
    film f ON f.id_film = c.id_film
INNER JOIN 
    role r ON r.id_role = c.id_role
WHERE 
    a.id_acteur = 2
ORDER BY 
    f.annee_sortie DESC

-- Liste des personnes qui sont à la fois acteurs et réalisateurs

SELECT 
    CONCAT (p.nom, ' ', p.prenom) AS realisateur_et_acteur
FROM
    personne p 
INNER JOIN 
    acteur a ON a.id_personne = p.id_personne
INNER JOIN
    realisateur r ON r.id_personne = p.id_personne

-- Liste des films qui ont moins de 10 ans (classés du plus récent au plus ancien)

SELECT 
    f.titre,
    f.annee_sortie
FROM 
    film f
WHERE 
    f.annee_sortie > YEAR(CURDATE()) - 10

-- Nombre d’hommes et de femmes parmi les acteurs

SELECT 
    p.sexe,
    COUNT(*)
FROM
    personne p 
INNER JOIN 
    acteur a ON a.id_personne = p.id_personne
GROUP BY 
    p.sexe

-- Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)


SELECT 
    CONCAT(p.nom, ' ', p.prenom) AS acteurs,
    CAST(TIMESTAMPDIFF(YEAR, p.date_naissance_personne, CURDATE()) AS SIGNED) AS age
FROM 
    personne AS p
INNER JOIN 
    acteur AS a ON a.id_personne = p.id_personne
WHERE 
    TIMESTAMPDIFF(YEAR, p.date_naissance_personne, CURDATE()) >= 50;

-- Acteurs ayant joué dans 3 films ou plus

SELECT 
    CONCAT(p.nom, ' ', p.prenom) AS acteurs
FROM 
    personne p 
INNER JOIN
    acteur a ON a.id_personne p.id_personne
INNER JOIN
    casting c ON c.id_acteur = a.id_acteur
GROUP BY 
    acteurs 
HAVING
    COUNT(c.id_acteur) > 3





