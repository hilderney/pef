CREATE TABLE `tablename` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `tablename`
  ADD PRIMARY KEY (`id`);



INSERT INTO `materials` (`id`, `name`, `description`, `hardness`, `weight`, `value`, `created`, `modified`) VALUES
(1, 'Madeira', 'Madeira comum tem alta flexibilidade mas pouca dureza.', 5, 2, 1, '2019-01-25 01:00:00', NULL),
(2, 'Bronze', 'É um metal de média dureza, feito da liga entre o cobre e o estanho.', 18, 8, 3, '2019-01-25 01:08:00', NULL),
(3, 'Prata', 'É um metal com certa maleabilidade normalmente utilizado para ornamentos.', 14, 10, 7, '2019-01-25 01:09:00', NULL),
(4, 'Ouro', 'É um metal de alto valor, com certa maleabilidade, normalmente utilizado para ornamentos.', 12, 18, 9, '2019-01-25 01:11:00', NULL),
(5, 'Ferro', 'É um metal duro com boa resistência a deformidades.', 20, 7, 4, '2019-01-25 01:13:00', NULL),
(7, 'Titânio', 'É um metal leve de grande dureza, pouca meleabilidade e grande resistência a deformidade.', 30, 5, 9, '2019-01-25 01:18:00', NULL),
(8, 'Diamante', 'É um material rochoso de grande dureza e praticamente nenhuma maleabilidade.', 50, 4, 9, '2019-01-25 01:20:00', NULL);



INSERT INTO `parts` (`id`, `name`, `description`, `weight`, `created`, `modified`) VALUES
(1, 'Pomo', 'Parte do guarda-mão mais afastada da lamina. Serve tanto para contrabalancear o peso quanto, dependendo da técnica utilizada, pode ser usada como parte do punho ou ainda para golpear com o cabo.', 2, '2019-01-25 00:55:00', NULL),
(2, 'Punho', 'O punho é onde se segura a lamina, pode ser feito de vários materiais e tem serve para manusear a arma de forma firme e segura, um bom punho facilita o direcionamento do corta da lamina durante um golpe.', 1, '2019-01-25 00:55:00', NULL),
(3, 'Guarda', 'É o que separa a lamina do punho, a parte mais próxima da lamina do guarda-mão, serve para evitar que a mão não deslize para a lamina em uma estocada e serve como proteÃ§ão ao se aparar um golpe, evitando que este escorregue pela lamina até sua mão. Cada braÃ§o de uma guarda é chamado de Arriaz.', 2, '2019-01-25 00:56:00', NULL),
(4, 'Lamina', 'Maior parte da arma, usada para cortar, perfurar e se defender de golpes.', 10, '2019-01-25 00:56:00', NULL);
