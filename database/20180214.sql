-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 14 fév. 2018 à 09:32
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sudouest`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `code` varchar(20) COLLATE utf8_bin NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table des catégories';

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`code`, `nom`) VALUES
('boisson', 'Boisson'),
('charcuterie', 'Charcuterie'),
('fromage', 'Fromage'),
('fruitLegume', 'Fruits et légumes'),
('patisserie', 'Pâtisseries et Confiseries'),
('plat', 'Plat');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `utilisateur` varchar(25) COLLATE utf8_bin NOT NULL,
  `produit` int(11) NOT NULL,
  `quantite` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`utilisateur`, `produit`, `quantite`) VALUES
('Mykol', 3, 1),
('Mykol', 19, 1),
('Zegui81', 41, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProduit` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prix` float NOT NULL,
  `promotion` float NOT NULL,
  `stock` int(4) NOT NULL,
  `description` text COLLATE utf8_bin,
  `categorie` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `etat` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table des produits';

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `nom`, `prix`, `promotion`, `stock`, `description`, `categorie`, `etat`) VALUES
(1, 'Bordeaux rouge', 3.85, 0.3, 0, 'C\'est avec les valeurs qui ont fait sa renommée (sérieux, qualité, savoir-faire, exigence) que les oenologues de la Maison Kressmann sélectionnent des Bordeaux authentiques : les Bordeaux Grande Réserve. Bénéficiant d\'un élevage qui respecte et préserve au maximum le fruit, ces vins se caractérisent par leur souplesse, leur élégance et leur équilibre.', 'boisson', 1),
(2, 'Saint-Emilion', 7.5, 0, 1, 'Ce Saint Emilion Kressmann est issu à 20 % d’un cépage Cabernet Franc et à 80 % d’un cépage Merlot. Le vignoble de Bordeaux est le plus grand vignoble de France en AOC. Sa grande richesse est d’être constituée de 57 appellations différentes, couvrant au total plus de 110 000 hectares. Les œnologues de Kressmann sélectionnent chaque année des cuvées issues des principales régions en vins rouges, blancs et liquoreux. Ils recherchent des vins authentiques représentant bien le style de leur appellation et de leur millésime. Saint-Emilion Grande Réserve reflète bien le style de son terroir, souvent argilo-calcaire. Le cépage Merlot s’y épanouit à merveille donnant des vins ronds et charmeurs, au parfum de violette. Servez-le entre 16 et 18 °C.', 'boisson', 1),
(3, 'Tariquet Première Grives', 8.9, 0.5, 3, 'Ce vin Premières Grives est à l\'origine du succès et de la notoriété des vins du domaine de Tariquet.Les raisins sont récoltés à l\'automne, ils sont alors arrivés à grande maturité, et sont donc très sucrés.', 'boisson', 1),
(4, 'Château Les Peyroulet', 5, 0, 10, 'Un vin bio de qualité. Ce vin a obtenu la médaille d\'argent CGA, Paris 2013. Terroir : sol argilo-calcaire au sud de Bergerac.', 'boisson', 1),
(5, 'Pur jus de poires', 5.8, 0, 10, 'Les Côteaux de Pruines sont une exploitation familiale située à Pruines, village de tradition fruitière. Les vergers sont situés à 500 m d\'altitude, exposés plein sud et à l\'abri des vents froids. Ils sont travaillés de façon à respecter le rythme de la nature. Les fruits sont récoltés et emballés manuellement. Cueillis à maturité pour garantir une teneur en sucre et une saveur plus élevée, ils sont conservés en chambre froide traditionnelle. Les fruits sont transformés à la propriété en jus de fruit pasteurisé. Retrouvez la vraie saveur de la poire dans ce jus de fruits 100% naturel, sans ajout de sucre, de colorant, ou de conservateur.', 'boisson', 1),
(6, 'Terrine de canard', 2.3, 0, 198, 'Pour concocter cette délicieuse terrine de canard, le Canard du Midi a eu la bonne idée d\'ajouter à sa recette des lardons de magret fumé qui apportent une touche de gourmandise à la terrine de canard traditionnelle, grande spécialité du Sud-Ouest. Cette recette est un classique des terrines, mais dans le cas présent, elle est particulièrement réussie. Son plus : un bon goût fumé de magret qui lui donne une petite pointe de caractère en plus.  Le magret séché et fumé ajoute un supplément de saveur subtil qui fait toute la différence à la dégustation et qui se marie à la perfection avec la viande de porc et de canard. Cette terrine de tradition peut être servie à toutes les occasions, même les plus grandes.', 'charcuterie', 1),
(7, 'Saucisse sèche', 5.15, 0.1, 0, 'Viande de porc sélectionnée, boyau naturel, séchage en altitude dans le village mythique de Lacaune, véritable capitale de la saucisse... Tout est réuni pour faire un saucisson de qualité bien affiné qui mérite bien son label rouge.', 'charcuterie', 1),
(8, 'Terrine de chèvre', 4.2, 0, 10, 'C\'est pour aller jusqu\'au bout de sa démarche qualité, de ses convictions, de son engagement en faveur du respect de la terre, des animaux et de l\'équilibre alimentaire des Hommes, que le maison Roger Vidal fabriquant déjà des produits sans colorant ni conservateur a choisi de créer des terrines et des pâtés dont les ingrédients répondent tous aux normes de l\'agriculture biologique certifiées AB.', 'charcuterie', 1),
(9, 'Terrine de canard', 3.6, 0, 0, 'Le poivre vert est beaucoup moins puissant que le poivre noir, le poivre noir étant obtenu après séchage du poivre vert. L\'utilisation du poivre non séché apporte acidité et fraîcheur à cette terrine de canard pour combler vos papilles. A déguster à l\'apéritif sans modération.', 'charcuterie', 1),
(10, 'Parmentier de canard', 6.9, 0.4, 10, 'Le Parmentier de canard, une recette classique de la tradition culinaire du Sud-Ouest, il s\'agit d\'un hachis Parmentier classique ou la viande de bœuf a été remplacé par de la viande de canard, produit phare de la maison Comtesse du Barry. Vous allez adorer le bon goût du canard effiloché avec une pointe de vin de Madère et des échalotes justes confites. Le tout recouvert d\'un écrasé de pommes de terre cuisinés avec muscade, curcuma et crème fraîche. Accompagné ce plat de quelques feuilles de salades pour vous apporter une pointe de croquant et de fraîcheur.', 'plat', 1),
(11, 'Axoa de porc', 8.95, 0, 29, 'La ferme Elizaldia est située dans le petit village basque de Gamarthe. C’est dans ce cadre alliant tradition et paysages magnifique que sont élaborées toutes les recettes typiques de la région. Cet axoa de porc est l’un des plats traditionnels du Pays Basque. Préparé à partir de viande de porc de grande qualité et d’ingrédients sélectionnés pour leur saveur unique, il peut se dégusté réchauffé accompagné de pommes de terre, de riz ou de pâtes fraîches.', 'charcuterie', 1),
(12, 'Terrine landaise', 2.25, 0, 10, 'Une délicieuse recette des Landes aromatisée à l\'Armagnac. Conseils de dégustation : Servir frais sur une tranche de pain de campagne ou avec une salade composée le tout accompagné de vin rouge.', 'charcuterie', 1),
(13, 'Roquefort', 2.95, 0.1, 10, 'De réputation internationale, il est associé à l\'excellence de l\'agriculture française et à sa gastronomie. Il est même devenu l\'emblème de la résistance des producteurs de fromage au lait cru contre les demandes réitérées de la généralisation de la pasteurisation du lait.', 'fromage', 1),
(14, 'Truffes', 58.75, 0, 10, 'La truffe entière extra est une truffe d\'excellente qualité, de forme régulière et récoltée à parfaite maturité. Elle enchante merveilleursement vos préparations les plus raffinées de gibier, viande, volaille et poisson, sans oublier les oeufs ! (25g)', 'fruitLegume', 1),
(15, 'Piment d\'espelette', 8.8, 0.2, 46, 'Grâce à son grand parfum, la poudre de piment d\'Espelette (AOC) remplace avantageusement le poivre, particulièrement dans la cuisine Basque où elle est indispensable. Elle s\'utilise en assaisonnement dans les préparations ou en décoration juste avant de servir une escalope, un filet de poisson.', 'fruitLegume', 1),
(16, 'Haricots Tarbais secs', 13.05, 0, 10, 'Retrouvez le classique des haricots pour le cassoulet. Pure tradition du sud-ouest, ce haricot est label rouge et IGP. La récolte de ce haricot est manuelle, aucun traitement chimique n\'a été subi, il a une petite peau très fine ce qui lui permet d\'être plus digeste, les temps de cuisson est 50% moins long que pour les autres haricots.', 'fruitLegume', 1),
(17, 'Asperges des Landes', 7.04, 0.2, 17, 'L\'asperge est une plante exigeante qui trouve dans les Landes des conditions de culture idéales avec une terre légère et sableuse ainsi qu\'un climat océanique doux et humide. Buttées aux cours de leur croissance pour les protéger de la lumière, les asperges des Landes montrent un teint laiteux qui garantit leur texture savoureuse. Ces asperges bio sont pelées, conditionnées fraîches et rangées à la main pour préserver leurs qualités. Elles se présentent au naturel et se dégustent accompagnées d\'une mayonnaise, d\'une vinaigrette ou d\'une sauce moutarde.', 'fruitLegume', 1),
(18, 'Tomates séchées', 4.85, 0, 0, 'Le concentré de saveurs Ces tomates séchées non marinées sont à utiliser telles quelles ou à assaisonner comme vous le souhaitez. La tomate séchée est très riche en goût et particulièrement typée. Utilisez-la dans une salade, des oeufs cocottes, une sauce ou encore pour agrémenter un club-sandwich ! Penser à utiliser ces tomates non marinées en les réduisant en petits morceaux au mixeur pour les parsemer sur un plat ou dans une sauce.', 'fruitLegume', 1),
(19, 'Croquant de Cordes', 4.85, 0, 9, 'Corde sur Ciel est un petit village médiéval du Tarn plein de charme, perché en haut d\'une colline. Déambuler dans ses ruelles vous fera voyager au fil des siècles. Ce village au patrimoine impressionnant est aujourd\'hui classé Grand site Midi-Pyrénées. Outre son héritage architectural, Cordes sur Ciel garde précieusement sa recette de croquants aux amandes. Les croquants de Cordes sont des biscuits très fins et brillants ressemblant à de la dentelle, avec de belles amandes entières. N’hésitez pas à craquer pour ces croquants, difficiles à trouver hors du Tarn.', 'patisserie', 1),
(20, 'Griottes confites', 10.3, 0.1, 0, 'Trilogie de saveurs se succédant les unes aux autres et se combinant à l\'infini, la Guinette comblera l\'amateur éclairé à la recherche de plaisirs fins. Vous apprécierez la puissance et le fondant du chocolat, la chaleur de l\'Armagnac et le fruité légèrement acide de la cerise confite à cœurs, qui se succèdent et s\'accordent en bouche pour donner lieu à un moment de plaisir rare...', 'patisserie', 1),
(21, 'Confiture d\'abricot', 0.85, 0, 105, 'A déguster au petit déjeuner, sur une simple tartine, ou à mélanger dans un fromage blanc...la confiture d\'abricots la Sauvagine est onctueuse et savoureuse. Vous y retrouverez toutes les saveurs de l\'abricot !', 'patisserie', 1),
(22, 'Confiture de cerise noire', 1.5, 0.6, 10, 'La cerise noire, spécialité du pays basque, ne peut être comparée aux autres variétés de cerises. Sa douceur et ses saveurs vous feront craquer. Les fruits sont mijotés au sucre de canne, la confiture est préparée avec 60g de fruits pour 100g. La particularité des recettes Francis Miot est la cuisson préalable du sucre \"au boulé\" avant d’y plonger les fruits. Une cuisson plus courte pour préserver pleinement la saveur du fruit.', 'patisserie', 1),
(23, 'Tablette de chocolat noir', 4.95, 0, 76, 'Fondée en 1994, la chocolaterie Bovetti, certifiée HACCP, propose une large gamme créative et innovante. Présentés dans des emballages originaux, les chocolats sont fabriqués artisanalement et sont issus d’un savoir faire alliant modernité et tradition. Tous les chocolats sont pur beurre de cacao et toutes les matières premières sont de premier choix.', 'patisserie', 1),
(24, 'Canelés de Bordeaux', 3.55, 0, 10, 'Cette spécialité bordelaise, faite à partir d\'une pâte à crêpe riche en oeuf, est réussie quand les canelés ont pris une couleur brune caramélisée, sont croustillants à l\'extérieur et fondants à l\'intérieur. Trempés dans un sirop aromatisé au rhum, il garde une texture ferme et leurs arômes de caramel se marient bien avec le rhum.', 'patisserie', 1),
(25, 'Miel', 8, 0, 10, 'Très clair, liquide et avec une fin de bouche au bon goût du bonbon au miel, vous régalerez vos bébés et vos enfants. Il offre la particularité de rester liquide très longtemps, ce qui en fait un ingrédient de choix aussi bien en cuisine qu\'en pâtisserie. N\'hésitez pas à remplacer le sucre par ce miel, dans le café, dans vos yaourts, sur des fromages frais, mais attention au dosage, le miel ayant un pouvoir sucrant plus élevé que le sucre.', 'patisserie', 1),
(26, 'Coffret gastronomique', 29.5, 0, 10, 'Foie gras, champagne, perles de saveur, truffes et biscuits roses pour un coffret cadeau tout en raffinement pour les amateurs de gastronomie.', 'plat', 1),
(27, 'Tripous aveyronnais', 5.9, 0, 10, 'La Naucelloise s\'inscrit dans une démarche toujours plus qualitative et c\'est naturellement que le spécialiste du véritable tripou du Rouergue a eu envie de proposer sa recette phare en bio afin de favoriser les filières plus respectueuses de l\'environnement et l\'approvisionnement local. Tout cela sans sacrifier à la qualité qui a fait la réputation des tripous Chales Savy.', 'plat', 1),
(28, 'Confit de Canard', 13.45, 0, 10, 'Fabrication artisanale au coeur de l\'Aveyron à Laguiole Découvrez un produit réalisé par une entreprise \'maître artisan\' de qualité et très goûteux. Ce classique de la gastronomie du sud-ouest se déguste à tout moment. Les cuisses sont confites dans leur graisse pour encore plus de saveur et de tendresse.', 'plat', 1),
(29, 'Foie gras de canard', 5.7, 0, 10, 'Composé d\'un mélange de plusieurs foies gras finement hachés et assaisonnés, ses saveurs sont authentiques. Son aspect lisse permet de réaliser des tranches régulières pour une présentation parfaite sur toasts en entrée ou à l\'apéritif.', 'plat', 1),
(30, 'Cassoulet', 6.8, 0, 10, 'Le cassoulet au canard de la Maison Aulas... Trophée Lozère Gourmande 2010/2011 Les canards sont élevés sur le causse de Sauveterre en Lozère ou en Aveyron. Conseil dégustation : à faire réchauffer 15 min à feu doux. Prévoir une boîte de 400g pour 1 à 2 personnes ou une boîte de 900g pour 2 à 3 personnes.', 'plat', 1),
(31, 'b', 3, 0.03, 3, '', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `pseudo` varchar(25) COLLATE utf8_bin NOT NULL,
  `mail` varchar(50) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(255) COLLATE utf8_bin NOT NULL,
  `nom` varchar(30) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `naissance` date DEFAULT NULL,
  `adresse` varchar(70) COLLATE utf8_bin DEFAULT NULL,
  `codePostal` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `ville` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `role` int(1) NOT NULL,
  `supprime` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table des utilisateurs';

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`pseudo`, `mail`, `mdp`, `nom`, `prenom`, `naissance`, `adresse`, `codePostal`, `ville`, `role`, `supprime`) VALUES
('Mykol', 'michelcolas@gmail.com', '$2y$10$tn/ZLaLWQp4Yyl8hZh5POOvLEayMBJU1ftB0AX0FVdq5X3I0NZQF.', 'Colas', 'Michel', '1995-11-05', 'Chambre de bonne', '12000', 'Rodez', 0, 0),
('Zegui81', 'zeghmati.clement@hotmail.fr', '$2y$10$K9gqi.ExgrGy/tzT0cUGZueWF34HQrlEJRu9GUKUZ0RHxQpYfZr2K', 'Zeghmati', 'Clément', '1995-05-18', '7 impasse le jardin des aulnes', '81380', 'Lescure d\'Albigeois', 0, 0),
('admin', 'admin@sudouest.fr', '$2y$10$cDsdF.EbvqbF2zy.nzTkb.pvbo7ldHY0TgzICFJWRtdxuvSo/uTX.', 'Admin', NULL, NULL, NULL, NULL, NULL, 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`utilisateur`,`produit`),
  ADD KEY `fk_panier_produit` (`produit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `index_categorie` (`categorie`) USING BTREE;

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `fk_panier_produit` FOREIGN KEY (`produit`) REFERENCES `produit` (`idProduit`),
  ADD CONSTRAINT `fk_panier_utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`pseudo`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_produit_categorie` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`code`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
