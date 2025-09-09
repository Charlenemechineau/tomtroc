-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 09 sep. 2025 à 12:45
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `author` varchar(250) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(250) NOT NULL,
  `disponibilite` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `description`, `image`, `disponibilite`, `user_id`) VALUES
(1, 'Ester', 'Alabaster', 'Le Livre d\'Esther : Curieux et passionnant, le génie d\'Esther réside dans son mélange mystérieux et unique de hasard et de providence divine. Si son intrigue paraît aléatoire et hasardeuse au premier abord, elle invite à la considérer comme une rencontre décisive avec Dieu.\r\n\r\nC\'est un encouragement pour chacun de nous, à observer et à écouter, avec curiosité et attention, les œuvres implicites de Dieu dans les moments heureux.\r\n\r\n Ce n\'est peut-être pas explicite ou comme on pourrait s\'y attendre, mais Dieu est assurément là.', 'livre_1_mini.png\r\n', 'disponible', 1),
(2, 'the kinfolk Table', 'Nathan Williams', 'J’ai récemment plongé dans les pages de ‘The Kinfolk Table’ et j’ai été\r\nEnchanté par cette œuvre captivante. Ce livre va bien au-delà d’une\r\n Simple collection de recettes ; il célèbre l’art de partager des moments\r\nAuthentiques autour de la table..\r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le\r\ndépart, transportant le lecteur dans un voyage à travers des recettes et\r\ndes histoires qui mettent en avant la beauté de la simplicité et de la \r\nConvivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des \r\nSouvenirs durables avec les êtres chers. \r\n\r\n‘The Kinfolk Table’ incarne parfaitement l’esprit de la cuisine et de la \r\nCamaraderie, et il est certain que ce livre trouvera une place spéciale\r\nDans le cœur de tout amoureux de la cuisine et des rencontres\r\nInspirantes.', 'book_2_68b1b5c6175b7_livre_2_mini.png', 'Disponible', 2),
(4, 'wabi sabi', 'beth kempton', 'Le wabi sabi ( « wah-bi sah-bi » ) est un concept captivant issu de l\'esthétique japonaise, qui nous aide à voir la beauté dans l\'imperfection, à apprécier la simplicité et à accepter la nature éphémère de toutes choses.\r\n \r\nAvec ses racines dans le zen et la voie du thé, la sagesse intemporelle du wabi sabi est plus pertinente que jamais pour la vie moderne, alors que nous recherchons de nouvelles façons d\'aborder les défis de la vie et de chercher un sens au-delà du matérialisme.\r\n \r\nLe wabi sabi est un antidote rafraîchissant à notre monde trépidant et axé sur la consommation, qui vous encouragera à ralentir, à vous reconnecter à la nature et à être plus doux avec vous-même. Il vous aidera à tout simplifier et à vous concentrer sur l\'essentiel. Du respect du rythme des saisons à la création d\'un foyer accueillant, de la relecture de l\'échec au vieillissement harmonieux, le wabi sabi vous apprendra à trouver plus de joie et d\'inspiration tout au long de votre vie parfaitement imparfaite. \r\n\r\nCe livre est le guide ultime pour appliquer les principes du wabi sabi afin de transformer chaque aspect de votre vie et de trouver le bonheur là où vous êtes.', 'livre_3_mini.png', 'Disponible', 2),
(5, 'milk & honey', 'rupi kaur', 'Milk and Honey est un recueil de poésie et de prose sur la survie. Il traite de l\'expérience de la violence, des abus, de l\'amour, de la perte et de la féminité.\r\n\r\nLe livre est divisé en quatre chapitres, chacun ayant un objectif différent. Il traite d\'une douleur différente, il guérit un chagrin différent. Milk and Honey emmène le lecteur à travers les moments les plus amers de la vie et y trouve de la douceur, car la douceur est partout, pourvu qu\'on soit prêt à la regarder.', 'livre_4_mini.webp\r\n', 'disponible', 3),
(6, 'delight', 'justin rossow', 'Ce livre vous aidera à découvrir la Joie, la Pensée, le Jeu, le Délicieux et le Désirable dans votre vie avec Dieu. « Délice ! » vous invite à vivre l\'aventure de suivre Jésus d\'une manière authentique, accessible et concrète.\r\n\r\nBien sûr, vous connaîtrez les difficultés et l\'échec. Bien sûr, vous connaîtrez le chagrin et la honte. Mais vous n\'avez pas à porter le fardeau de bien marcher dans la foi ; vous faites déjà bondir Jésus de joie et chanter son chant joyeux . Le Créateur de l\'Univers vous considère comme quelqu\'un d\'exceptionnel. Même lorsque la vie est confuse ou difficile, l\'Esprit vous façonne avec soin et joie.\r\n\r\nÊtes-vous fatigué de la religion ?\r\nÊtes-vous accablé par l’anxiété ou le doute ?\r\nAspirez-vous à quelque chose de plus dans votre vie de foi ?\r\n\r\nLâchez prise. Respirez profondément. Et explorons ce que signifie suivre Jésus dans l\'aventure de votre vie – une aventure jalonnée de défis, de repentir et de difficultés, mais surtout marquée par la joie mutuelle !\r\n\r\n\r\n\r\nL\'Éternel prendra plaisir à toi,\r\nIl te calmera dans son amour,\r\nIl se réjouira à ton sujet avec allégresse.\r\n\r\n(Sophonie 3:17)\r\n\r\n\r\n\r\n« Je vous ai dit ces choses, afin que ma joie soit en vous,\r\net que votre joie soit parfaite. »\r\n\r\n(Jean 15:11)', 'livre_5_mini.webp', 'non disponible', 4),
(7, 'milwaukee mission', 'elder cooper low', 'J’ai récemment plongé dans les pages de ‘The Kinfolk Table’ et j’ai été\r\nEnchanté par cette œuvre captivante. Ce livre va bien au-delà d’une\r\n Simple collection de recettes ; il célèbre l’art de partager des moments\r\nAuthentiques autour de la table.\r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le\r\ndépart, transportant le lecteur dans un voyage à travers des recettes et\r\ndes histoires qui mettent en avant la beauté de la simplicité et de la \r\nConvivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des \r\nSouvenirs durables avec les êtres chers. \r\n\r\n‘The Kinfolk Table’ incarne parfaitement l’esprit de la cuisine et de la \r\nCamaraderie, et il est certain que ce livre trouvera une place spéciale\r\nDans le cœur de tout amoureux de la cuisine et des rencontres\r\nInspirantes.\r\n', 'livre_6_mini.jpeg', 'disponible', 5),
(8, 'minimaliste graphics', 'julia schonlau', 'J’ai récemment plongé dans les pages de ‘The Kinfolk Table’ et j’ai été\r\nEnchanté par cette œuvre captivante. Ce livre va bien au-delà d’une\r\n Simple collection de recettes ; il célèbre l’art de partager des moments\r\nAuthentiques autour de la table.\r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le\r\ndépart, transportant le lecteur dans un voyage à travers des recettes et\r\ndes histoires qui mettent en avant la beauté de la simplicité et de la \r\nConvivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des \r\nSouvenirs durables avec les êtres chers. \r\n\r\n‘The Kinfolk Table’ incarne parfaitement l’esprit de la cuisine et de la \r\nCamaraderie, et il est certain que ce livre trouvera une place spéciale\r\nDans le cœur de tout amoureux de la cuisine et des rencontres\r\nInspirantes.\r\n', 'livre_7_mini.jpeg', 'disponible', 6),
(9, 'hygge', 'meik wiking', 'Garanti pour apporter chaleur et réconfort à votre vie, Le Petit Livre du Hygge est le livre dont nous avons tous besoin. Le hygge a été décrit comme un concept aussi vaste que « le confort de l\'âme » ou « la quête des plaisirs quotidiens ».\r\n\r\nLe Petit Livre du Hygge est le livre dont nous avons tous besoin en ce moment, et il vous apportera, à vous et à vos proches, chaleur et réconfort cet hiver. Hooga ? Hhyooguh ? Heurgh ? Peu importe la prononciation du mot « hygge ».\r\n\r\nL\'important est de le ressentir. Que vous soyez blotti sur un canapé avec un être cher ou que vous partagiez un repas réconfortant avec vos amis proches, le hygge consiste à créer une atmosphère propice à la détente. Le Petit Livre du Hygge est l\'introduction incontournable et définitive au hygge , écrite par Meik Wiking, PDG de l\'Institut de recherche sur le bonheur de Copenhague.\r\n\r\nCe livre regorge de recherches originales sur le hygge, ainsi que de magnifiques photos, recettes et idées pour vous aider à ajouter une touche de magie danoise à votre vie. De la part des fans du Petit Livre du Hygge : « C\'est le livre le plus douillet du monde ! » « Ce livre est fait pour les amoureux du confort » « Parfait pour lire lors d\'une nuit orageuse de janvier » « Un livre agréable à lire pendant les mois d\'hiver, il vous aide à vous détacher du chaos de la vie » « Si vous voulez un livre qui vous emmène dans un endroit heureux à chaque fois\r\n', 'livre_8_mini.webp', 'disponible', 3),
(10, 'innovation', 'matt ridley', 'L\'innovation est l\'événement majeur de l\'ère moderne, la raison pour laquelle nous connaissons à la fois des améliorations spectaculaires de notre niveau de vie et des changements perturbateurs dans notre société. Oubliez les symptômes à court terme comme Donald Trump et le Brexit : c\'est l\'innovation elle-même qui les explique et qui façonnera le XXIe siècle, pour le meilleur et pour le pire.\r\n\r\nPourtant, l\'innovation reste un processus mystérieux, mal compris des décideurs politiques et des hommes d\'affaires, difficile à mettre en œuvre, mais inévitable et inexorable lorsqu\'il se produit.\r\n\r\nMatt Ridley soutient dans cet ouvrage que nous devons changer notre façon de concevoir l\'innovation, pour la considérer comme un processus progressif, ascendant et fortuit, qui se produit dans la société et résulte directement de l\'habitude humaine d\'échanger, plutôt que comme un processus ordonné, descendant, se développant selon un plan.\r\n\r\nL\'innovation est fondamentalement différente de l\'invention, car elle consiste à transformer des inventions en objets pratiques et abordables. Elle s\'accélère dans certains secteurs et ralentit dans d\'autres. Il s\'agit toujours d\'un phénomène collectif et collaboratif, et non d\'une affaire de génie solitaire. Elle est progressive, fortuite, recombinante, inexorable, contagieuse, expérimentale et imprévisible.\r\n\r\nElle se produit principalement dans quelques régions du monde à la fois. Elle ne peut toujours pas être modélisée correctement par les économistes, mais elle peut facilement être découragée par les politiques. Loin d\'être excessivement innovante, nous sommes peut-être au bord d\'une famine d\'innovation.', 'Livre_9_mini.jpg', 'disponible', 7),
(11, 'psalms', 'alabaster', 'Ce recueil ancien et intemporel de poésie et de chants met en lumière toute la gamme des expériences émotionnelles et spirituelles que nous traversons en tant qu\'êtres humains. Les lecteurs y découvrent le deuil, la douleur, les lamentations, l\'amour, la joie, le pardon et ce que signifie se connecter à Dieu au cœur de nos vies complexes.\r\n\r\nL\'approche d\'Alabaster réinvente l\'expérience du livre dans son intégralité. Intégrant des images qui éclairent les thèmes et les messages du texte, ce livre aidera le lecteur à aborder les Écritures d\'une manière nouvelle. Le Livre des Psaumes dans la Nouvelle Traduction Vivante (NLT) est idéal pour les études bibliques, les groupes religieux ou les moments de dévotion individuelle.\r\n\r\nAlabaster crée en pensant au lecteur, notamment en utilisant soigneusement l\'espace négatif, des polices lisibles et des mises en page qui permettent une exploration réfléchie entre le texte et les images.\r\n', 'livre_10_mini.webp', 'disponible', 8),
(12, 'thinking, fast & slow', 'Daniel kahneman', 'Pourquoi prenons-nous les décisions que nous prenons ? Le prix Nobel Daniel Kahneman a révolutionné notre compréhension du comportement humain avec « Penser, vite et lentement » . En synthétisant l\'œuvre de sa vie, Kahneman a démontré qu\'il existe deux façons de faire des choix : la pensée rapide et intuitive, et la pensée lente et rationnelle. Son livre révèle comment notre esprit est entravé par l\'erreur, les préjugés et les biais (même lorsque nous pensons être logiques) et propose des techniques pratiques qui nous permettent à tous d\'améliorer notre prise de décision. Cette exploration approfondie des merveilles et des limites de l\'esprit humain a eu un impact durable sur la façon dont nous nous percevons.\r\n\r\n« Le père des sciences du comportement… son analyse rigoureuse de l\'esprit humain et de ses nombreux défauts reste peut-être le guide le plus utile pour rester sain d\'esprit et stable. » Sunday Times', 'livre_11_mini.avif', 'non disponible', 10),
(13, 'a book full of hope', 'rupi kaur', '« Le Petit Livre de l\'Espoir » est le livre idéal pour cultiver une vision optimiste, croire que tout est possible et se rappeler que  chaque jour offre de nouvelles opportunités.  Ce livre regorge de citations inspirantes qui incitent le lecteur à croire au pouvoir de l\'espoir et à comprendre que les temps difficiles ne sont que temporaires. \r\n\r\nL\'avenir est prometteur : rêves et désirs peuvent être réalisés ! L\'espoir est une émotion forte qui peut aider à trouver un but et à rester positif. Les messages de ce livre peuvent contribuer à cette résilience.', 'livre_12_mini.png', 'disponible', 11),
(14, 'the subtle art of not giving a fuck', 'mark manson', 'Dans ce guide de développement personnel révolutionnaire, un blogueur vedette nous montre que la clé pour devenir plus fort et plus heureux est de mieux gérer l\'adversité et de cesser d\'être constamment « positif ». \r\n\r\nDepuis quelques années, Mark Manson, via son blog extrêmement populaire, s\'efforce de corriger nos attentes délirantes envers nous-mêmes et envers le monde. Il …\r\n\r\nDans ce guide de développement personnel révolutionnaire, un blogueur vedette nous montre que la clé pour devenir plus fort et plus heureux est de mieux gérer l\'adversité et de cesser d\'être constamment « positif ». Depuis quelques années, Mark Manson, via son blog très populaire, s\'efforce de corriger nos attentes illusoires envers nous-mêmes et le monde. \r\n\r\nIl apporte aujourd\'hui sa sagesse, fruit de longues années de recherche, à ce livre révolutionnaire.\r\nManson affirme que les êtres humains sont imparfaits et limités. Comme il l\'écrit, « tout le monde ne peut pas être extraordinaire ; il y a des gagnants et des perdants dans la société, et certains sont injustes ou de votre faute. » \r\n\r\nManson nous conseille d\'apprendre à connaître nos limites et de les accepter ; c\'est, selon lui, la véritable source de l\'autonomisation. En acceptant nos peurs, nos défauts et nos incertitudes, en cessant de fuir et d\'éviter les vérités douloureuses et en les affrontant, nous pouvons commencer à trouver le courage et la confiance que nous recherchons désespérément.\r\n« Dans la vie, on a un nombre limité de choses à se mettre sous la dent. Il faut donc choisir ses envies avec soin. » Manson nous offre un moment de vérité bienvenu, empreint d\'anecdotes divertissantes et d\'un humour grossier et impitoyable. Ce manifeste est une véritable claque pour chacun d\'entre nous, afin que nous puissions commencer à vivre une vie', 'livre_13_mini.jpg', 'disponible', 12),
(15, 'narnia', 'c.s lewis', 'Londres en 1900, on fait la rencontre d’un garçon appelé Digory vivant avec sa mère très malade chez son oncle Andrew et sa tante. Digory fait la rencontre de sa voisine, une petite fille du nom de Polly. Ensemble, ils se plaisent à inventer des histoires sur un prétendu trésor de pirates caché dans le bureau de l’oncle Andrew qui est interdit aux enfants.\r\n\r\n Un jour, Digory et Polly se retrouvent dans le bureau de l’oncle et celui-ci donne à Polly une de ses bagues. Il y a deux bagues jaunes et deux vertes et Andrew lui en donne une jaune. C’est alors que l’incroyable se produit, Polly disparaît. Digory va devoir enfiler la seconde et dernière bague jaune pour retrouver son amie. On suit alors ces deux jeunes enfants dans leurs péripéties. \r\n\r\nIls vont atterrir dans différents mondes magiques tous plus surprenants les uns que les autres. Il faut cependant faire attention, car on ne sait pas quels dangers on peut rencontrer à cause de la magie. Ce premier tome est introductif, on comprend comment Narnia a été crée et surtout par qui. Le style de l’auteur est très poétique. C’est un conte agréable à découvrir et l’écriture est facile à lire. J’ai bien aimé ce premier tome.', 'livre_14_mini.webp', 'non disponible', 13),
(16, 'company of one ', 'paul jarvis', 'Et si la véritable clé d\'une carrière plus riche et plus épanouissante n\'était pas de créer et de développer une start-up, mais plutôt de pouvoir travailler à son compte, de déterminer ses horaires et de devenir une entreprise individuelle (très rentable) et durable ? \r\n\r\nEt si la meilleure solution, et la plus intelligente, consistait simplement à rester à petite échelle ? Ce livre explique comment y parvenir. Company of One est une approche innovante et rafraîchissante, axée sur la petite taille et l\'évitement de la croissance, pour les entreprises de toutes tailles. Non pas pour un freelance rémunéré uniquement à la pièce, ni pour une start-up entrepreneuriale souhaitant se développer au plus vite, mais pour une petite entreprise résolument déterminée à le rester.\r\n\r\n En restant à petite échelle, on peut s\'offrir la liberté de profiter de plaisirs plus enrichissants et d\'éviter les tracas liés aux relations avec les employés, aux longues réunions ou aux préoccupations liées à l\'expansion. \r\n\r\nCompany of One présente cette stratégie commerciale unique et explique comment la mettre en œuvre, notamment pour générer des flux de trésorerie réguliers. Paul Jarvis a quitté le monde de l\'entreprise lorsqu\'il a réalisé que travailler dans un environnement sous pression et très médiatisé ne correspondait pas à sa vision du succès.\r\n\r\n Il travaille désormais à son compte depuis sa maison, sur une petite île luxuriante au large de Vancouver, et mène une vie bien plus enrichissante et productive.', 'livre_15_mini.jpeg', 'disponible', 9),
(17, 'the two towers', 'j.r.r tolkien', 'S\'appuyant sur l\'histoire commencée dans Le Hobbit, voici la deuxième partie du chef-d\'œuvre épique de Tolkien, Le Seigneur des Anneaux. Elle présente une couverture noire saisissante, inspirée du dessin de Tolkien lui-même, le texte définitif et une carte détaillée de la Terre du Milieu.\r\n\r\nFrodon et les Compagnons de l\'Anneau ont été confrontés au danger au cours de leur quête pour empêcher l\'Anneau Maître de tomber entre les mains du Seigneur des Ténèbres en le détruisant dans les Fissures du Destin. Ils ont perdu le magicien Gandalf lors d\'un combat contre un esprit maléfique dans les Mines de la Moria ; et aux Chutes de Rauros, Boromir, séduit par le pouvoir de l\'Anneau, a tenté de s\'en emparer par la force.\r\n\r\nTandis que Frodon et Sam s\'échappaient, le reste de la compagnie a été attaqué par des Orques. Ils poursuivent désormais leur voyage seuls sur le grand fleuve Anduin – seuls, bien sûr, à l\'exception de la mystérieuse silhouette rampante qui les suit partout', 'livre_16_mini.jpg', 'disponible', 14);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user1_id` int NOT NULL,
  `user2_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `last_message_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `user1_id`, `user2_id`, `created_at`, `last_message_at`) VALUES
(1, 1, 2, '2025-08-06 13:08:24', '2025-08-26 11:33:55'),
(3, 17, 2, '2025-09-05 22:43:10', '2025-09-09 14:35:10'),
(4, 2, 3, '2025-09-06 00:11:09', '2025-09-06 00:11:09'),
(5, 17, 3, '2025-09-06 11:14:57', '2025-09-06 11:14:57');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sender_id` int NOT NULL,
  `sent_date` datetime NOT NULL,
  `conversation_id` int NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `conversation_id` (`conversation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender_id`, `sent_date`, `conversation_id`, `is_read`) VALUES
(1, 'Salut, c’est un test de message !', 1, '2025-08-06 13:13:38', 1, 1),
(3, 'super ça fonctionne', 2, '2025-08-13 15:01:05', 1, 0),
(4, 'super je suis ravie', 1, '2025-08-25 14:12:24', 1, 1),
(5, 'oui top', 1, '2025-08-25 16:11:25', 1, 1),
(6, 'je fais un test de nouveau', 2, '2025-08-26 09:55:03', 1, 0),
(7, 'test concluant :)', 2, '2025-08-26 11:33:55', 1, 0),
(8, 'Bonjour votre livre est il encore disponible ?', 17, '2025-09-05 22:43:10', 3, 1),
(9, 'Salut hugo comment vas tu ?', 2, '2025-09-06 00:11:09', 4, 0),
(10, 'Salut Alex excuse moi de te déranger à nouveau mais je suis vraiment super intérréssé par ton livre :)', 17, '2025-09-06 10:44:40', 3, 1),
(11, 'Oui mon livre est dispo sans probéme', 2, '2025-09-06 11:00:39', 3, 1),
(12, 'salut hugo', 17, '2025-09-06 11:14:57', 5, 0),
(13, 'top quand est il possible de l\'avoir ?', 17, '2025-09-08 21:10:46', 3, 1),
(14, 'dans 1 semaine si tu veux ?', 2, '2025-09-08 21:11:19', 3, 1),
(15, 'n\'hesite pas à revenir vers moi', 2, '2025-09-09 14:34:17', 3, 1),
(16, 'Oui toujours intérréssé dis moi quand et où ?', 17, '2025-09-09 14:35:10', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `picture_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `created_at`, `picture_user`) VALUES
(1, 'CamilleClubLit', 'camilleclub@gmail.com', '4d0b24ccade22df6d154778cd66baf04288aae26df97a961f3ea3dd616fbe06dcebecc9bbe4ce93c8e12dca21e5935c08b0954534892c568b8c12b92f26a2448', '2025-06-25 10:01:06', 'picture1.png'),
(2, 'Alexlecture', 'alexlecture@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 10:01:06', 'picture2.png'),
(3, 'Hugo1990_12', 'hugo@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 10:03:58', 'picture3.png'),
(4, 'Juju1432', 'jujuadorelire@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 10:03:58', 'picture4.png'),
(5, 'Christiane75014', 'Christiane@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 10:04:55', 'picture5.png'),
(6, 'Hamzalecture', 'hamzalecture@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 10:04:55', 'picture6.png'),
(7, 'Lou&Ben50', 'louetben@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 10:09:31', 'picture7.png'),
(8, 'Lolobzh', 'lolo@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 10:09:31', 'picture8.png'),
(9, 'Victoirefabr912', 'victoirefabr@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 10:13:06', 'picture9.png'),
(10, 'Sas634', 'Sas@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 11:27:23', 'picture10.png'),
(11, 'ML95', 'mickael95@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 11:27:23', 'picture11.png'),
(12, 'verogo33', 'veronique@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 11:30:37', 'picture12.png'),
(13, 'AnnikaBrahms', 'annicka@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 11:30:37', 'picture13.png'),
(14, 'Lotrfanclub67', 'lotrfan@gmail.com', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', '2025-06-25 11:32:53', 'picture14.png'),
(17, 'chachou', 'charlene.mechineau@gmail.com', '9324b647e45c02d9eaace89708c365547ccc2dfb0b4d9f5d95ce4b967102f2861cc8bcdf0e5e7c59f86be9e4fcd6035914e216f00f5c4aa4dacc29359ee2f36d', '2025-07-29 08:59:23', 'user_17_68bb58bf03abe_child-sticking-out-tongue-emotional-260nw-2133498347.webp');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
