-- Dans phpMyAdmin (ou autre outil) mais via l’onglet SQL, on va apprendre à afficher, ajouter, modifier et supprimer des données en SQL.

-- Crée une base de données becode.
-- Importe le fichier students.sql qui se trouve dans ce dossier.
-- Dans un second fichier .sql, tu stockeras les requêtes qui te permettront de réaliser ces actions :

-- 1 . Affiche toutes les données.

SELECT * FROM students
SELECT * FROM school

-- 2 . Affiche uniquement les prénoms.

SELECT prenom FROM students

-- 3 . Affiche les prénoms, les dates de naissance et l’école de chacun.

SELECT prenom, datenaissance, school FROM students;

-- 4 . Affiche uniquement les élèves qui sont de sexe féminin.

SELECT * FROM students WHERE genre='F'

-- Affiche uniquement les élèves qui font partie de l’école d'Addy.

SELECT school FROM students WHERE nom='Addy' ==> response = '1'

SELECT * FROM students WHERE school='1'

-- Affiche uniquement les prénoms des étudiants, par ordre inverse à l’alphabet (DESC). Ensuite, la même chose mais en limitant les résultats à 2.

SELECT prenom FROM students ORDER BY prenom DESC;

SELECT prenom FROM students ORDER BY prenom DESC LIMIT 2;

-- Ajoute Ginette Dalor, née le 01/01/1930 et affecte-la à Bruxelles, toujours en SQL.

INSERT INTO students (nom, prenom, datenaissance, genre, school) VALUES ('Ginette', 'Dalor', '1930-01-01', 'F', '1');

-- Modifie Ginette (toujours en SQL) et change son sexe et son prénom en “Omer”.

UPDATE students SET prenom = 'Omer', sexe = 'M' WHERE prenom = 'Ginette';

-- Supprimer la personne dont l’ID est 3.

DELETE FROM students WHERE id=3

-- Modifier le contenu de la colonne School de sorte que "1" soit remplacé par "Liege" et "2" soit remplacé par "Gent". (attention au type de la colonne !)

UPDATE students SET School = CASE 
                                  WHEN school = 1 THEN 'Liege'::varchar 
                                  WHEN school = 2 THEN 'Gent'::varchar 
                                  ELSE school::varchar 
                                  END;



