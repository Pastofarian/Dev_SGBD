CREATE TABLE categories (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL
);

INSERT INTO categories (id, name)
VALUES (-1, 'Catégorie inconnue');

CREATE TABLE recipes (
   id INT PRIMARY KEY AUTO_INCREMENT,
   name VARCHAR(255) NOT NULL,
   category_id INT DEFAULT -1,
   FOREIGN KEY (category_id) REFERENCES categories(id) 
   ON DELETE SET DEFAULT 
   ON UPDATE SET DEFAULT 
);


CREATE TABLE ingredients (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE ingredientRecipe (
  ingredient_id INT,
  recipe_id INT,
  PRIMARY KEY (ingredient_id, recipe_id),
  FOREIGN KEY (ingredient_id) REFERENCES ingredients(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

INSERT INTO categories (name)
VALUES ('Entrée'), ('Plat principal'), ('Dessert'), ('Soupe'), ('Boisson'), ('Salade');

INSERT INTO ingredients (name)
VALUES ('Oignon'), ('Carotte'), ('Pomme de terre'), ('Ail'), ('Poireau'), ('Céleri'), ('Persil'),
       ('Thym'), ('Feuille de laurier'), ('Beurre'), ('Moules'), ('Bière'), ('Lard'), ('Pain'),
       ('Fromage'), ('Oeufs'), ('Lait'), ('Farine'), ('Sucre'), ('Chocolat');

INSERT INTO recipes (name, category_id)
VALUES ('Moules au vin blanc', 1), ('Gaufres belges', 3), ('Stoemp', 2),
       ('Waterzooi', 2), ('Carbonade flamande', 2), ('Soupe de tomates aux boulettes', 4),
       ('Salade aux endives belges', 6), ('Chocolat chaud belge', 5), ('Croquettes aux crevettes', 1),
       ('Nez de Gand', 3);

-- Moules au vin blanc (1)
INSERT INTO ingredientRecipe (ingredient_id, recipe_id)
VALUES (11, 1), (1, 1), (4, 1), (10, 1), (7, 1), (8, 1), (9, 1);

-- Gaufres belges (2)
INSERT INTO ingredientRecipe (ingredient_id, recipe_id)
VALUES (15, 2), (16, 2), (17, 2), (18, 2), (10, 2);

-- Stoemp (3)
INSERT INTO ingredientRecipe (ingredient_id, recipe_id)
VALUES (3, 3), (2, 3), (6, 3), (10, 3), (1, 3);

-- Waterzooi (4)
INSERT INTO ingredientRecipe (ingredient_id, recipe_id)
VALUES (1, 4), (5, 4), (2, 4), (10, 4), (7, 4), (8, 4), (9, 4);

-- Carbonade flamande (5)
INSERT INTO ingredientRecipe (ingredient_id, recipe_id)
VALUES (1, 5), (13, 5), (12, 5), (3, 5), (7, 5), (8, 5), (9, 5);

-- Soupe de tomates aux boulettes (6)
INSERT INTO ingredientRecipe (ingredient_id, recipe_id)
VALUES (1, 6), (2, 6), (4, 6), (15, 6), (17, 6), (16, 6);

-- Salade aux endives belges (7)
INSERT INTO ingredientRecipe (ingredient_id, recipe_id)
VALUES (1, 7), (15, 7), (14, 7);

-- Chocolat chaud belge (8)
INSERT INTO ingredientRecipe (ingredient_id, recipe_id)
VALUES (20, 8), (19, 8), (16, 8);

-- Croquettes aux crevettes (9)
INSERT INTO ingredientRecipe (ingredient_id, recipe_id)
VALUES (1, 9), (4, 9), (17, 9), (10, 9), (15, 9);

-- Nez de Gand (10)
INSERT INTO ingredientRecipe (ingredient_id, recipe_id)
VALUES (13, 10), (14, 10), (15, 10), (1, 10);

