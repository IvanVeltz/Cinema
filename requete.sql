-- Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur
SELECT 
    f.titre,
    f.annee_de_sortie,
    TIME_FORMAT(SEC_TO_TIME(f.duree * 60), '%H:%i') AS duree_format_hh_mm,
    CONCAT(a.prenom, ' ', a.nom) AS realisateur
FROM 
    realisateur r
INNER JOIN 
    acteur a ON a.id_acteur = r.id_acteur
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
    f.annee_de_sortie,
    CONCAT(a.prenom, ' ', a.nom) AS realisateur
INNER JOIN 
    acteur a ON a.id_acteur = r.id_acteur
INNER JOIN 
    film f ON f.id_realisateur = r.id_realisateur
WHERE 
    f.id_realisateur = 1

-- Nombre de films par genre (classés dans l’ordre décroissant)

SELECT
    g.categorie,
    COUNT(po.id_film) AS nbr_de_film
FROM
    posseder po
INNER JOIN
    genre g ON g.id_genre = po.id_genre
GROUP BY
    po.id_genre
ORDER BY 
    nbr_de_film DESC

--  Nombre de films par réalisateur (classés dans l’ordre décroissant)
SELECT 
    COUNT(f.id_film) AS nbr_de_film,
    CONCAT(a.prenom, ' ', a.nom) AS realisateur
FROM 
    film f 
INNER JOIN 
    realisateur r ON r.id_realisateur = f.id_realisateur
INNER JOIN 
    acteur a ON a.id_acteur = r.id_acteur
GROUP BY 
    f.id_realisateur 
ORDER BY 
    nbr_de_film DESC

-- Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe

SELECT 
    f.titre,
    CONCAT(a.prenom, ' ', a.nom) AS acteurs,
    a.sexe
FROM 
    jouer j
INNER JOIN 
    acteur a ON a.id_acteur = j.id_acteur
INNER JOIN 
    film f ON f.id_film = j.id_film
WHERE 
    j.id_film = 1

-- Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de
-- sortie (du film le plus récent au plus ancien)

SELECT 
    f.titre,
    j.role,
    f.annee_de_sortie
FROM 
    jouer j
INNER JOIN 
    acteur a ON a.id_acteur = j.id_acteur
INNER JOIN 
    film f ON f.id_film = j.id_film
WHERE 
    a.id_acteur = 2
ORDER BY 
    f.annee_de_sortie DESC

