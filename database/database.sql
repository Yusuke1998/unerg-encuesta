-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: mariadb
-- Tiempo de generación: 02-07-2022 a las 15:21:15
-- Versión del servidor: 10.3.34-MariaDB-1:10.3.34+maria~focal
-- Versión de PHP: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `unerg-encuesta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `codigo` int(11) NOT NULL,
  `carrera` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`codigo`, `carrera`) VALUES
(101, 'AGRONOMIA PRODUCCION ANIMAL'),
(102, 'AGRONOMIA PRODUCCION VEGETAL'),
(601, 'INFORMATICA'),
(602, 'INGENIERIA CIVIL'),
(603, 'TSU HIDROCARBUROS MENCION GAS'),
(604, 'TSU HIDROCARBUROS MENCION PETROLEO'),
(607, 'INGENIERIA EN HIDROCARBUROS MENCION PETROLEO'),
(608, 'INGENIERIA EN HIDROCARBUROS MENCION GAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `carrera` int(11) NOT NULL,
  `sede` int(11) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id`, `periodo`, `carrera`, `sede`, `desde`, `hasta`) VALUES
(1, 2014, 601, 1, '2022-07-01', '2022-07-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_encuesta`
--

CREATE TABLE `materias_encuesta` (
  `id` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `materia` varchar(200) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id` int(11) NOT NULL,
  `participacion_id` int(11) NOT NULL,
  `materia` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `turno` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacion`
--

CREATE TABLE `participacion` (
  `id` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombres` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `carrera` int(11) NOT NULL,
  `sede` int(11) NOT NULL,
  `encuesta` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pensum`
--

CREATE TABLE `pensum` (
  `id` int(11) NOT NULL,
  `carrera` int(11) NOT NULL,
  `sede` int(11) NOT NULL,
  `pensum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pensum`
--

INSERT INTO `pensum` (`id`, `carrera`, `sede`, `pensum`) VALUES
(2, 601, 1, 5),
(3, 601, 4, 24),
(4, 601, 3, 23),
(5, 601, 2, 5),
(6, 602, 1, 25),
(7, 602, 2, 25),
(8, 602, 8, 25),
(9, 102, 1, 21),
(10, 102, 2, 21),
(11, 102, 6, 21),
(12, 102, 5, 21),
(13, 102, 7, 21),
(14, 102, 3, 17),
(15, 102, 4, 12),
(16, 101, 1, 27),
(17, 101, 2, 27),
(18, 101, 6, 27),
(19, 101, 7, 27),
(20, 101, 3, 7),
(21, 101, 4, 13),
(22, 603, 1, 46),
(23, 604, 1, 47),
(24, 608, 1, 142),
(25, 607, 1, 141);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission`
--

CREATE TABLE `permission` (
  `id` int(122) UNSIGNED NOT NULL,
  `user_type` varchar(250) DEFAULT NULL,
  `data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permission`
--

INSERT INTO `permission` (`id`, `user_type`, `data`) VALUES
(1, 'Member', '{\"users\":{\"own_create\":\"1\",\"own_read\":\"1\",\"own_update\":\"1\",\"own_delete\":\"1\"}}'),
(2, 'admin', '{\"users\":{\"own_create\":\"1\",\"own_read\":\"1\",\"own_update\":\"1\",\"own_delete\":\"1\",\"all_create\":\"1\",\"all_read\":\"1\",\"all_update\":\"1\",\"all_delete\":\"1\"}}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `codigo` int(11) NOT NULL,
  `sede` varchar(200) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`codigo`, `sede`) VALUES
(1, 'SAN JUAN'),
(2, 'CALABOZO'),
(3, 'EL SOMBRERO'),
(4, 'ORTIZ'),
(5, 'ALTAGRACIA'),
(6, 'ZARAZA'),
(7, 'MAPIRE'),
(8, 'CHAGUARAMAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `setting`
--

CREATE TABLE `setting` (
  `id` int(122) UNSIGNED NOT NULL,
  `keys` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `setting`
--

INSERT INTO `setting` (`id`, `keys`, `value`) VALUES
(1, 'website', 'Encuesta UNERG'),
(2, 'logo', 'logo.png'),
(3, 'favicon', 'favicon.ico'),
(4, 'SMTP_EMAIL', ''),
(5, 'HOST', ''),
(6, 'PORT', ''),
(7, 'SMTP_SECURE', ''),
(8, 'SMTP_PASSWORD', ''),
(9, 'mail_setting', 'simple_mail'),
(10, 'company_name', 'Company Name'),
(11, 'crud_list', 'users,User'),
(12, 'EMAIL', ''),
(13, 'UserModules', 'yes'),
(14, 'register_allowed', '0'),
(15, 'email_invitation', '1'),
(16, 'admin_approval', '0'),
(17, 'user_type', '[\"Member\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `templates`
--

CREATE TABLE `templates` (
  `id` int(121) UNSIGNED NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `html` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `templates`
--

INSERT INTO `templates` (`id`, `module`, `code`, `template_name`, `html`) VALUES
(1, 'forgot_pass', 'forgot_password', 'Forgot password', '<html xmlns=\"http://www.w3.org/1999/xhtml\"><head>\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\r\n  <style type=\"text/css\" rel=\"stylesheet\" media=\"all\">\r\n    /* Base ------------------------------ */\r\n    *:not(br):not(tr):not(html) {\r\n      font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;\r\n      -webkit-box-sizing: border-box;\r\n      box-sizing: border-box;\r\n    }\r\n    body {\r\n      \r\n    }\r\n    a {\r\n      color: #3869D4;\r\n    }\r\n\r\n\r\n    /* Masthead ----------------------- */\r\n    .email-masthead {\r\n      padding: 25px 0;\r\n      text-align: center;\r\n    }\r\n    .email-masthead_logo {\r\n      max-width: 400px;\r\n      border: 0;\r\n    }\r\n    .email-footer {\r\n      width: 570px;\r\n      margin: 0 auto;\r\n      padding: 0;\r\n      text-align: center;\r\n    }\r\n    .email-footer p {\r\n      color: #AEAEAE;\r\n    }\r\n  \r\n    .content-cell {\r\n      padding: 35px;\r\n    }\r\n    .align-right {\r\n      text-align: right;\r\n    }\r\n\r\n    /* Type ------------------------------ */\r\n    h1 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 19px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    h2 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 16px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    h3 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 14px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    p {\r\n      margin-top: 0;\r\n      color: #74787E;\r\n      font-size: 16px;\r\n      line-height: 1.5em;\r\n      text-align: left;\r\n    }\r\n    p.sub {\r\n      font-size: 12px;\r\n    }\r\n    p.center {\r\n      text-align: center;\r\n    }\r\n\r\n    /* Buttons ------------------------------ */\r\n    .button {\r\n      display: inline-block;\r\n      width: 200px;\r\n      background-color: #3869D4;\r\n      border-radius: 3px;\r\n      color: #ffffff;\r\n      font-size: 15px;\r\n      line-height: 45px;\r\n      text-align: center;\r\n      text-decoration: none;\r\n      -webkit-text-size-adjust: none;\r\n      mso-hide: all;\r\n    }\r\n    .button--green {\r\n      background-color: #22BC66;\r\n    }\r\n    .button--red {\r\n      background-color: #dc4d2f;\r\n    }\r\n    .button--blue {\r\n      background-color: #3869D4;\r\n    }\r\n  </style>\r\n</head>\r\n<body style=\"width: 100% !important;\r\n      height: 100%;\r\n      margin: 0;\r\n      line-height: 1.4;\r\n      background-color: #F2F4F6;\r\n      color: #74787E;\r\n      -webkit-text-size-adjust: none;\">\r\n  <table class=\"email-wrapper\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"\r\n    width: 100%;\r\n    margin: 0;\r\n    padding: 0;\">\r\n    <tbody><tr>\r\n      <td align=\"center\">\r\n        <table class=\"email-content\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\r\n      margin: 0;\r\n      padding: 0;\">\r\n          <!-- Logo -->\r\n\r\n          <tbody>\r\n          <!-- Email Body -->\r\n          <tr>\r\n            <td class=\"email-body\" width=\"100%\" style=\"width: 100%;\r\n    margin: 0;\r\n    padding: 0;\r\n    border-top: 1px solid #edeef2;\r\n    border-bottom: 1px solid #edeef2;\r\n    background-color: #edeef2;\">\r\n              <table class=\"email-body_inner\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" style=\" width: 570px;\r\n    margin:  14px auto;\r\n    background: #fff;\r\n    padding: 0;\r\n    border: 1px outset rgba(136, 131, 131, 0.26);\r\n    box-shadow: 0px 6px 38px rgb(0, 0, 0);\r\n       \">\r\n                <!-- Body content -->\r\n                <thead style=\"background: #3869d4;\"><tr><th><div align=\"center\" style=\"padding: 15px; color: #000;\"><a href=\"{var_action_url}\" class=\"email-masthead_name\" style=\"font-size: 16px;\r\n      font-weight: bold;\r\n      color: #bbbfc3;\r\n      text-decoration: none;\r\n      text-shadow: 0 1px 0 white;\">{var_sender_name}</a></div></th></tr>\r\n                </thead>\r\n                <tbody><tr>\r\n                  <td class=\"content-cell\" style=\"padding: 35px;\">\r\n                    <h1>Hi {var_user_name},</h1>\r\n                    <p>You recently requested to reset your password for your {var_website_name} account. Click the button below to reset it.</p>\r\n                    <!-- Action -->\r\n                    <table class=\"body-action\" align=\"center\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"\r\n      width: 100%;\r\n      margin: 30px auto;\r\n      padding: 0;\r\n      text-align: center;\">\r\n                      <tbody><tr>\r\n                        <td align=\"center\">\r\n                          <div>\r\n                            <!--[if mso]><v:roundrect xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" href=\"{{var_action_url}}\" style=\"height:45px;v-text-anchor:middle;width:200px;\" arcsize=\"7%\" stroke=\"f\" fill=\"t\">\r\n                              <v:fill type=\"tile\" color=\"#dc4d2f\" />\r\n                              <w:anchorlock/>\r\n                              <center style=\"color:#ffffff;font-family:sans-serif;font-size:15px;\">Reset your password</center>\r\n                            </v:roundrect><![endif]-->\r\n                            <a href=\"{var_varification_link}\" class=\"button button--red\" style=\"background-color: #dc4d2f;display: inline-block;\r\n      width: 200px;\r\n      background-color: #3869D4;\r\n      border-radius: 3px;\r\n      color: #ffffff;\r\n      font-size: 15px;\r\n      line-height: 45px;\r\n      text-align: center;\r\n      text-decoration: none;\r\n      -webkit-text-size-adjust: none;\r\n      mso-hide: all;\">Reset your password</a>\r\n                          </div>\r\n                        </td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                    <p>If you did not request a password reset, please ignore this email or reply to let us know.</p>\r\n                    <p>Thanks,<br>{var_sender_name} and the {var_website_name} Team</p>\r\n                   <!-- Sub copy -->\r\n                    <table class=\"body-sub\" style=\"margin-top: 25px;\r\n      padding-top: 25px;\r\n      border-top: 1px solid #EDEFF2;\">\r\n                      <tbody><tr>\r\n                        <td> \r\n                          <p class=\"sub\" style=\"font-size:12px;\">If you are having trouble clicking the password reset button, copy and paste the URL below into your web browser.</p>\r\n                          <p class=\"sub\"  style=\"font-size:12px;\"><a href=\"{var_varification_link}\">{var_varification_link}</a></p>\r\n                        </td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n  </tbody></table>\r\n\r\n\r\n</body></html>'),
(3, 'users', 'invitation', 'Invitation', '<p>Hello <strong>{var_user_email}</strong></p>\r\n\r\n<p>Click below link to register&nbsp;<br />\r\n{var_inviation_link}</p>\r\n\r\n<p>Thanks&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `users_id` int(121) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `var_key` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`users_id`, `user_id`, `var_key`, `status`, `is_deleted`, `name`, `password`, `email`, `profile_pic`, `user_type`) VALUES
(1, '1', '', 'active', '0', 'admin', '$2y$10$eEXsbN2XNGJNbZHT0Nl.VuT2kV4HCm.dGjMT21eEq3hxnzmRTD7ZK', 'admin@admin.com', 'demo_pic.png', 'admin'),
(2, '1', NULL, 'active', '0', 'JHONNY PRZ', '$2y$10$KK4TgR8ljd.2dPahEJqqBOnhimYUiVLhC28CVK9TeM5GvuFS/R0uC', 'jhonny@jhonny.com', 'yo_1656745750.jpg', 'Member'),
(3, '1', NULL, 'active', '0', 'Karla Villegas', '$2y$10$QvFAAvXO.a9JJnmXFcJMCO4diWxHeGvxWO2gfZmvcgBNQvEYWP6Qy', 'karla@karla.com', 'ella2_1656745927.jpg', 'Member');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrera` (`carrera`),
  ADD KEY `periodo` (`periodo`),
  ADD KEY `sede` (`sede`) USING BTREE;

--
-- Indices de la tabla `materias_encuesta`
--
ALTER TABLE `materias_encuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_encuesta` (`id_encuesta`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participacion_id` (`participacion_id`);

--
-- Indices de la tabla `participacion`
--
ALTER TABLE `participacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrera` (`carrera`),
  ADD KEY `sede` (`sede`),
  ADD KEY `encuesta` (`encuesta`);

--
-- Indices de la tabla `pensum`
--
ALTER TABLE `pensum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrera` (`carrera`),
  ADD KEY `sede` (`sede`);

--
-- Indices de la tabla `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `materias_encuesta`
--
ALTER TABLE `materias_encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participacion`
--
ALTER TABLE `participacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pensum`
--
ALTER TABLE `pensum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(122) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(122) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(121) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(121) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD CONSTRAINT `encuesta_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`codigo`),
  ADD CONSTRAINT `encuesta_ibfk_2` FOREIGN KEY (`sede`) REFERENCES `sedes` (`codigo`);

--
-- Filtros para la tabla `materias_encuesta`
--
ALTER TABLE `materias_encuesta`
  ADD CONSTRAINT `materias_encuesta_ibfk_1` FOREIGN KEY (`id_encuesta`) REFERENCES `encuesta` (`id`);

--
-- Filtros para la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD CONSTRAINT `opciones_ibfk_1` FOREIGN KEY (`participacion_id`) REFERENCES `participacion` (`id`);

--
-- Filtros para la tabla `participacion`
--
ALTER TABLE `participacion`
  ADD CONSTRAINT `participacion_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`codigo`),
  ADD CONSTRAINT `participacion_ibfk_2` FOREIGN KEY (`sede`) REFERENCES `sedes` (`codigo`),
  ADD CONSTRAINT `participacion_ibfk_3` FOREIGN KEY (`encuesta`) REFERENCES `encuesta` (`id`);

--
-- Filtros para la tabla `pensum`
--
ALTER TABLE `pensum`
  ADD CONSTRAINT `pensum_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`codigo`),
  ADD CONSTRAINT `pensum_ibfk_2` FOREIGN KEY (`sede`) REFERENCES `sedes` (`codigo`);
COMMIT;