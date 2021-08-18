-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 18 août 2021 à 13:50
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `betguess`
--

-- --------------------------------------------------------

--
-- Structure de la table `bets`
--

CREATE TABLE `bets` (
  `id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `victoire_dom` tinyint(1) NOT NULL,
  `nul` tinyint(1) NOT NULL,
  `victoire_ext` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bets`
--

INSERT INTO `bets` (`id`, `match_id`, `user_id`, `victoire_dom`, `nul`, `victoire_ext`) VALUES
(188, 40, 1, 0, 0, 1),
(189, 43, 1, 1, 0, 0),
(190, 36, 1, 1, 0, 0),
(191, 37, 1, 1, 0, 0),
(192, 36, 13, 1, 0, 0),
(193, 41, 13, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `nom` varchar(30) NOT NULL,
  `sport_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`nom`, `sport_id`) VALUES
('Angers', 1),
('Bordeaux', 1),
('Boulazac', 3),
('Boulogne-Levallois', 3),
('Bourg-En-Bresse', 3),
('Brest', 1),
('Cesson Rennes Handball', 2),
('Chalon-sur Saône', 3),
('Châlons-Reims', 3),
('Chambéry Savoie Handball', 2),
('Chartres Métropole Handball', 2),
('Cholet', 3),
('Clermont', 1),
('Dijon', 3),
('Dunkerque Handball', 2),
('Fenix Toulouse Handball', 2),
('Gravelines-Dunkerque', 3),
('HBC Nantes', 2),
('Istres Provence Handball', 2),
('Le Mans', 3),
('Le Portel', 3),
('Lens', 1),
('Lille', 1),
('Limoges', 3),
('Limoges Handball', 2),
('Lorient', 1),
('Lyon', 1),
('Lyon-Villeurbanne', 3),
('Marseille', 1),
('Metz', 1),
('Monaco', 1),
('Monaco Basket', 3),
('Montpellier', 1),
('Montpellier Handball', 2),
('Nanterre', 3),
('Nantes', 1),
('Nice', 1),
('Orléans', 3),
('Paris-Saint-Germain', 1),
('Paris-Saint-Germain Handball', 2),
('Pau-Lacq-Orthez', 3),
('Pays d\'Aix Université Club', 2),
('Reims', 1),
('Rennes', 1),
('Roanne', 3),
('Saint-Etienne', 1),
('Saint-Raphaël Handball', 2),
('Strasbourg', 1),
('Strasbourg Basket', 3),
('Tremblay-En-France Handball', 2),
('Troyes', 1),
('US Créteil Handball', 2),
('US Ivry Handball', 2),
('USAM Nîmes Gard', 2);

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

CREATE TABLE `matchs` (
  `id` int(11) NOT NULL,
  `dom` varchar(30) NOT NULL,
  `ext` varchar(30) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `sport_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matchs`
--

INSERT INTO `matchs` (`id`, `dom`, `ext`, `date`, `sport_id`) VALUES
(36, 'Paris Saint-Germain', 'Bordeaux', '2021-10-30 20:45:00', 1),
(37, 'Lorient', 'Clermont', '2021-10-20 23:50:00', 1),
(38, 'Marseille', 'Monaco', '2021-10-23 21:45:00', 1),
(39, 'Dunkerque Handball', 'HBC Nantes', '2021-10-11 20:45:00', 2),
(40, 'Montpellier Handball', 'US Créteil Handball', '2021-10-20 20:45:00', 2),
(41, 'Chambéry Savoie Handball', 'Fenix Toulouse Handball', '2021-10-15 22:45:00', 2),
(42, 'Chalon-sur Saône', 'Cholet', '2021-10-20 19:52:00', 3),
(43, 'Limoges', 'Le Portel', '2021-10-20 19:53:00', 3),
(44, 'Orléans', 'Strasbourg Basket', '2021-10-30 00:30:00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `descp` varchar(40) NOT NULL,
  `article` text NOT NULL,
  `btn` varchar(10) NOT NULL,
  `imgs` text NOT NULL,
  `carousel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `titre`, `descp`, `article`, `btn`, `imgs`, `carousel`) VALUES
(1, 'Monaco avant le barrage de Ligue des champions!', 'Niko Kovac l\'assure : Monaco est prêt.', '<p style=\"text-align: left; \">À la veille d\'affronter le Chakhtior Donetsk en barrages aller de la Ligue des champions, l\'entraîneur de Monaco Niko Kovac a rappelé l\'importance de la rencontre et annoncé que son gardien, Alexander Nübel, était incertain.<img src=\"https://seeklogo.com/images/M/monaco-logo-9FAEF0E65E-seeklogo.com.png\" style=\"float: right;\" class=\"note-float-right\"></p><p style=\"text-align: left; \"><br></p><p style=\"text-align: left; \"><b>« Vous avez fait reposer Benoît Badiashile à Lorient, et Wissam Ben Yedder avait débuté sur le banc. L\'idée était de les préserver pour mardi. Est-ce le match le plus important de votre été ?&nbsp;»</b></p><p style=\"text-align: left; \">Benoît a joué beaucoup de matches et Wissam est revenu avec un peu de retard avec l\'Euro. Tous les matches sont importants, ceux de Ligue 1 comme ceux de Ligue des champions. On n\'a pas voulu mettre de côté les rencontres contre Nantes (1-1) et Lorient (0-1), même si on n\'a pas eu les résultats espérés. Mais le match de demain (mardi) est évidemment une grande occasion qui se présente à nous. Wissam et Benoît le débuteront, c\'est clair, parce que ce sont des joueurs très importants pour nous. Mais les autres matches sont aussi importants. On a un grand effectif. J\'aime changer de joueurs et profiter de la richesse de mon effectif.</p><p style=\"text-align: left; \"><br></p><p style=\"text-align: left; \"><b>« Je m\'attends à une équipe qui jouera différemment de Nantes et Lorient : ils vont jouer au foot, chercher à construire du jeu, attaquer, ils voudront marquer »</b></p><p style=\"text-align: left; \"><b>Vous disposez désormais de trois joueurs allemands dans l\'effectif, que pensez-vous de chacun d\'eux ?</b></p><p style=\"text-align: left; \">Je suis content de les avoir à Monaco. On connaît la qualité des trois. Kevin (Volland) est un joueur très important. Il a eu besoin d\'un peu de temps la saison dernière avant d\'exprimer toutes ses qualités. Alex (Nübel) n\'était pas numéro un, donc il avait besoin de temps. Il ne se sent pas bien. Il a mal au ventre, il est un peu gêné. Donc il ne sera pas là à l\'entraînement aujourd\'hui (lundi). On verra pour demain. Concernant Ismail (Jakobs), on est très contents de lui. Il a besoin de s\'adapter à un nouveau pays, à une nouvelle manière de jouer. On est très content des trois.</p><p style=\"text-align: left; \"><br></p><p style=\"text-align: left; \"><b>Vous avez dit la semaine dernière que Donetsk serait le favori. Vous attendez-vous à un match plus ouvert que vos deux premiers disputés en Championnat ?</b></p><p style=\"text-align: left; \">J\'ai dit que le Chakhtior était l\'adversaire le plus difficile que l\'on aurait pu tirer. Sur les quinze dernières années, ils ont joué treize fois la phase de groupes de la Ligue des champions. On se rappelle de leurs deux victoires contre le Real Madrid la saison passée. Ils ont beaucoup de joueurs brésiliens talentueux. Ils ont désormais en plus un entraîneur italien dont les équipes sont toujours très intéressantes et agréables à voir jouer. Je m\'attends à une équipe qui jouera différemment de Nantes et Lorient : ils vont jouer au foot, chercher à construire du jeu, attaquer, ils voudront marquer. Cela signifie aussi qu\'on aura des possibilités pour développer notre jeu et de nous créer des occasions. On les attend à quatre derrière, et pas à cinq comme Lorient. Pour nous, ils sont les favoris, mais on veut déjouer les pronostics. On veut atteindre notre objectif et cet objectif est clair : atteindre la phase de groupes de la Ligue des champions. On a travaillé très dur la saison dernière. Maintenant, c\'est une finale, une finale en deux matches. On est prêts physiquement, mentalement et tactiquement.&nbsp;</p>', 'Lire', 'img1.jpg', 1),
(2, 'Un bonheur incomplet!', 'Marseille laisse filer son avantage.', '<h3 style=\"text-align: center;\"><b>Menés 2-0 à la mi-temps, les Girondins de Bordeaux ont su réagir pour arracher le nul sur la pelouse de l’Olympique de Marseille, avec des buts de Timothée Pembélé et Rémi Oudin</b></h3><h3><br></h3><p style=\"text-align: left; \"><img src=\"https://s1.static-footeo.com/uploads/girondinsdebordeaux02/players/tom-lacoux__px8xoi.png\" style=\"width: 346px; float: left;\" class=\"note-float-left\"></p><p style=\"text-align: left; \"><span style=\"font-size: 1rem;\">Après avoir mené 2-0, Marseille a été tenu en échec par une équipe de Bordeaux qui s’est réveillée après la pause (2-2), dimanche soir au Stade</span><span style=\"font-size: 1rem;\">Vélodrome en clôture de la 2e journée de L1, et a manqué l’occasion de prendre la tête du classement.</span></p><p style=\"text-align: left; \"><span style=\"font-size: 1rem;\"><br></span>Avec quatre points en deux matches de championnat, l’OM de Jorge Sampaoli pointe à deux longueurs d’Angers, de Clermont et du Paris SG, en compagnie du voisin niçois, prochain adversaire et qui vient de renverser Lille (4-0).</p><p style=\"text-align: left; \">Si les Olympiens ont montré de réelles qualités offensives, les erreurs, voire les errances défensives constituent un frein dans l’optique d’une qualification en Ligue des champions la saison prochaine.</p><p style=\"text-align: left; \">L’OM est toujours en rodage à ce niveau. A l’image de Leonardo Balerdi, dont les gestes sont souvent mal maîtrisés et dont l’exclusion a été logique (88e).</p><p style=\"text-align: left; \">Pour Bordeaux, en revanche, la deuxième période, où se sont entremêlées solidarité et prises de risques, est synonyme de progrès. Elle peut préfigurer des lendemains plus rieurs pour le club du nouveau président, Gérard Lopez.</p><p style=\"text-align: left; \"><br></p><p style=\"text-align: center;\"><b>Les recrues parlent</b></p><p style=\"text-align: left; \">Son entraîneur, Vladimir Petkovic, avait pourtant concocté une équipe ultra-défensive en 5-4-1 «bloc bas» pour tenter de se rassurer après la défaite inaugurale à domicile face à Clermont (0-2). Et la sortie prématurée (14e) de l’attaquant nigérian Samuel Kalu, 23 ans, victime d’un malaise en début de rencontre (6e), n’a pas fait évoluer la donne.</p><p style=\"text-align: left; \">Le pari a tenu une demi-heure. Le temps pour l’Américain Konrad de la Fuente de placer une accélération côté gauche et de servir Gerson en débordement. Le plus gros transfert estival du club olympien (près de 20 millions d’Euros) a alors offert un caviar de centre en retrait pour le Turc Cengiz Ünder, qui n’a ps manqué son deuxième but en deux matches (1-0, 34e).</p><p style=\"text-align: left; \">Assis aux côtés de Jean-Pierre Papin, honoré par le club pour les 20 ans de son Ballon d’Or 1991, et de son patron Frank McCourt, le jeune président de l’OM Pablo Longoria pouvait enfin savourer.</p><p style=\"text-align: left; \">Comme à Montpellier la semaine dernière (3-2), ses recrues ont régalé. Mais cette fois-ci, elles ont enflammé un Vélodrome avec 50.000 personnes qui attendaient cela depuis un an et demi.</p><p style=\"text-align: left; \">Jusqu’à ce but, les hommes de Jorge Sampaoli n’étaient pourtant pas parvenus à créer de décalages dans l’arrière-garde bordelaise. Les coup-francs non cadrés de Dimitri Payet (5e et 31e) étaient à peine parvenus à équilibrer la frappe de Gideon Mensah, de peu à côté (24e).</p><p style=\"text-align: left; \"><br></p><p style=\"text-align: center;\"><b>Oudin tout seul</b></p><p style=\"text-align: left; \">Mais ce but a tout changé. Payet s’est lâché encore un peu plus. Aidé par l’apathie de Mexer puis de Laurent Koscielny, il a repiqué à l’entrée de la surface pour battre Benoit Costil d’une frappe à ras-de-terre (2-0, 41e).</p><p style=\"text-align: left; \">A la pause, Petkovic a donc réagi. Timothée Pembelé, 18 ans, tout juste prêté par le Paris SG, a remplacé un Mexer en difficulté. Et le «titi» parisien a commencé son festival côté droit. Il s’est joué du repli défensif inexistant de De la Fuente pour marquer avec l’aide de Luan Peres, qui a dévié le ballon (2-1, 51e).</p><p style=\"text-align: left; \">Marseille, désorganisé, a alors commencé à tanguer et à concéder des corners. Sur le troisième consécutif, Toma Basic a vu Rémi Oudin, absolument seul à l’entrée de la surface. Le remplaçant de Kalu a égalisé d’une parfaite reprise du gauche (2-2, 57e) à la grande joie des 170 supporteurs bordelais.</p><p style=\"text-align: left; \">La fin de rencontre, décousue, aurait pu permettre à chacune des équipes de l’emporter. Mais l’OM, déstabilisé par la deuxième période bordelaise, n’est jamais parvenu à maîtriser totalement la partie pour y croire vraiment.</p>', 'Lire', 'img8.jpg', 1),
(3, 'La victoire Nantaise a domicile!', 'Nantes cogne un petit Metz', '<h3 style=\"text-align: center;\"><b>Et si le seul problème du FC Nantes l\'an dernier était l\'absence de public ?</b></h3><h3><b><br></b></h3><p style=\"text-align: left; \">Pour ses retrouvailles avec ses supporters à la Beaujoire, l\'équipe d\'Antoine Kombouaré a tranquillement géré un Metz pas folichon (2-0, deux passes décisives de Moses Simon) et réussit ainsi un joli 4/6 pour lancer sa saison. Au cœur d\'une entame de match à sens unique, le crack Randal Kolo Muani inscrit son premier pion de la saison, de l\'extérieur du pied sur un service de Simon à la sortie d\'un une-deux côté gauche avec Fábio (11e). Les Canaris se mettent à l\'abri dès le retour des vestiaires avec encore le Nigérian au dynamitage, cette fois pour la tête de Ludovic Blas (48e). Les Grenats n\'ont ensuite jamais semblé en capacité de revenir, même si Habib Maïga (51e) et Vagner Dias (76e) ont mis Alban Lafont à contribution.</p><p style=\"text-align: left; \">À Nantes, il n\'y a pas de cellule de recrutement, mais encore quelques joueurs qui savent jouer au ballon.</p><p style=\"text-align: left; \"><br></p><h5 style=\"text-align: center;\"><b><span style=\"text-align: left;\">«&nbsp;</span>à 6, on ne peut pas gagner un match&nbsp;<span style=\"text-align: left;\">»</span></b></h5><h5 style=\"text-align: center;\"><b><span style=\"text-align: left;\"><br></span></b></h5><p style=\"text-align: left; \">Dominés dans les duels, ayant les plus grandes difficultés à construire, les Grenats n\'ont pas existé et se sont incliné 2-0 à Nantes, lors de la deuxième journée de Ligue 1.</p><p style=\"text-align: left; \">Le manque d\'agressivité des Messins était criant sur l\'ouverture du score nantaise, quand Simon a eu tout le temps de centrer de la gauche pour Kolo Muani, seul devant Oukidja (12e, 1-0). On espérait que la mi-temps serve de déclic pour, enfin, lancer la rencontre... Les Canaris n\'ont mis que quatre minutes pour doubleur leur avance. Le pressing nantais a empêché le FC Metz de ressortir la balle et Simon, encore lui, a pu servir Blas auteur d\'une belle tête au second poteau (49e, 2-0).</p><p style=\"text-align: left; \">A l\'actif du FC Metz ? Bien peu. Deux occasions franches au moment où le match était déjà joué. Maïga a manqué son face à face avec Lafont (53e) et la tête de Vagner a été repoussée par le gardien nantais (76e). Sarr trop discret, Centonze aligné dans l\'axe de la défense à trois, les Grenats ont tâtonné tactiquement.&nbsp;</p>', 'Lire', 'img3.jpg', 1),
(4, 'CSC', 'Le défi', 'hihi', 'lerrrr', 'img4.jpg', 0),
(5, 'jnijbnu', 'unubu', 'byuhbyub', 'zrr', 'img5.jpg', 0),
(6, 'zerzer', 'nuhnikl,', 'ol,ko,ionubuyb', 'ezr', 'img6.jpg', 0),
(7, 'lp^l^^;pl^;', 'uhnuyhyb', 'btvbghker,,k', 'yuhjnil', 'img7.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ratio`
--

CREATE TABLE `ratio` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `sport` int(11) NOT NULL,
  `gagner` int(11) NOT NULL,
  `perdu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ratio`
--

INSERT INTO `ratio` (`id`, `user`, `match_id`, `sport`, `gagner`, `perdu`) VALUES
(13, 1, 36, 1, 1, 0),
(16, 1, 40, 2, 1, 0),
(17, 1, 43, 3, 1, 0),
(18, 1, 37, 1, 1, 0),
(19, 13, 36, 1, 1, 0),
(20, 13, 41, 2, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `result`
--

CREATE TABLE `result` (
  `match_id` int(11) NOT NULL,
  `r_victoire_dom` int(11) DEFAULT 0,
  `r_nul` int(11) DEFAULT 0,
  `r_victoire_ext` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `result`
--

INSERT INTO `result` (`match_id`, `r_victoire_dom`, `r_nul`, `r_victoire_ext`) VALUES
(36, 1, 0, 0),
(37, 1, 0, 0),
(38, 0, 0, 0),
(39, 0, 0, 0),
(40, 0, 0, 1),
(41, 0, 0, 1),
(42, 0, 0, 0),
(43, 1, 0, 0),
(44, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sport_id`
--

CREATE TABLE `sport_id` (
  `football` int(11) NOT NULL,
  `handball` int(11) NOT NULL,
  `basket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sport_id`
--

INSERT INTO `sport_id` (`football`, `handball`, `basket`) VALUES
(1, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `DateRegister` date DEFAULT current_timestamp(),
  `admin` int(11) NOT NULL DEFAULT 0,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `DateRegister`, `admin`, `img`) VALUES
(1, 'EmericLuis', '$2y$10$19Coy14AtP4bZssh.Tlb4OhqjROpH8hS.mS5259WoqYi5VdHMdbTq', 'emeric.luis22@gmail.com', '2021-08-11', 1, ''),
(13, 'AccountTest', '$2y$10$fbP0.N1IZp7yPU4/gU81VucZbYNIKIC8mdalD37b2zYbER8CAm2s.', 'ok@ok.fr', '2021-08-27', 0, ''),
(14, 'test123456', '$2y$10$M1/acxdP2XZHqMwa10TdRO9raBPBqTJG49MNW9zrHB43MNNXdMUI.', 'etetz@zerzer.fr', '2021-08-04', 0, ''),
(15, 'SimpleTest', '$2y$10$JDHkZA565nmmKSeKv54sn.BTCtfjxhRTXLgBj2LXIEWYcE0Y9LeXq', 'rtaeaze@zrzer.fr', '2021-08-17', 0, ''),
(16, 'SimpleTest2', '$2y$10$pLL4GuLefszgKEgwFOziGONVGGFseGilBQHJuwCZ70ZLusnhArBU2', 'rtaeaihipze@zrzer.fr', '2021-08-17', 0, ''),
(17, 'helloooo', '$2y$10$r3G290.KOB4VAIE4QTWu9uyDmj5so.XF1RFOW/kB6iaiSmK0NVZNq', 'lol@xd.fr', '2021-08-17', 0, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bets`
--
ALTER TABLE `bets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ratio`
--
ALTER TABLE `ratio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_username` (`user`);

--
-- Index pour la table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`match_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bets`
--
ALTER TABLE `bets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT pour la table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `ratio`
--
ALTER TABLE `ratio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ratio`
--
ALTER TABLE `ratio`
  ADD CONSTRAINT `user_username` FOREIGN KEY (`user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
