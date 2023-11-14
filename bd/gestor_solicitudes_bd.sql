-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2023 a las 02:32:27
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestor_solicitudes_bd`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateAccount` (IN `in_account_id` VARCHAR(5), IN `in_account_name` VARCHAR(50), IN `in_account_email` VARCHAR(100), IN `in_account_password` TEXT, IN `in_role_id` VARCHAR(5), IN `in_account_status` VARCHAR(25))   BEGIN
    INSERT INTO Accounts (account_id, account_name, account_email, account_password, role_id, account_status)
    VALUES (in_account_id ,in_account_name, in_account_email, in_account_password, in_role_id, in_account_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateCompany` (IN `in_company_id` VARCHAR(5), IN `in_company_name` VARCHAR(100), IN `in_company_status` VARCHAR(25))   BEGIN
    INSERT INTO Companies (company_id,company_name, company_status)
    VALUES (in_company_id, in_company_name, in_company_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateMessage` (IN `in_message_id` VARCHAR(12), IN `in_user_id` VARCHAR(7), IN `in_conversation_id` VARCHAR(10), IN `in_message_content` TEXT, IN `in_message_status` VARCHAR(25))   BEGIN
    INSERT INTO Messages (message_id ,user_id, conversation_id, message_content, message_status)
    VALUES (in_message_id, in_user_id, in_conversation_id, in_message_content, in_message_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateRequest` (IN `in_request_id` VARCHAR(10), IN `in_user_id_customer` VARCHAR(7), IN `in_request_art` VARCHAR(100), IN `in_request_support` VARCHAR(100), IN `in_request_production_date` DATE, IN `in_request_production_time` TIME, IN `in_request_final_production_date` DATE, IN `in_request_details` TEXT, IN `in_request_purpose` TEXT, IN `in_request_reference` VARCHAR(100), IN `in_request_additional_comments` TEXT, IN `in_request_assessment` TEXT, IN `in_user_id_employee` VARCHAR(7), IN `in_request_status` VARCHAR(25))   BEGIN
    INSERT INTO Request (request_id, 
                         user_id_customer, 
                         request_art, 
                         request_support, 
                         request_production_date, 
                         request_production_time, 
                         request_final_production_date, 
                         request_details, 
                         request_purpose, 
                         request_reference, 
                         request_additional_comments, 
                         request_assessment, 
                         user_id_employee, 
                         request_status)
    VALUES (in_request_id,
            in_user_id_customer, 
            in_request_art, 
            in_request_support, 
            in_request_production_date, 
            in_request_production_time, 
            in_request_final_production_date, 
            in_request_details, in_request_purpose, 
            in_request_reference, 
            in_request_additional_comments, 
            in_request_assessment, 
            in_user_id_employee, 
            in_request_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateRole` (IN `in_role_name` VARCHAR(25), IN `in_role_status` VARCHAR(25))   BEGIN
    INSERT INTO Roles (role_name, role_status)
    VALUES (in_role_name, in_role_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateRolePermission` (IN `in_role_id` VARCHAR(5), IN `in_permission_id` VARCHAR(5))   BEGIN
    INSERT INTO Roles_Permissions (role_id, permission_id)
    VALUES (in_role_id, in_permission_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateUser` (IN `in_account_names` VARCHAR(100), IN `in_user_surnames` VARCHAR(100), IN `in_user_address` TEXT, IN `in_user_phone` VARCHAR(25), IN `in_company_id` VARCHAR(5), IN `in_user_position` VARCHAR(50), IN `in_user_area` VARCHAR(50), IN `in_user_status` VARCHAR(25))   BEGIN
    INSERT INTO Users (account_names, user_surnames, user_address, user_phone, company_id, user_position, user_area, user_status)
    VALUES (in_account_names, in_user_surnames, in_user_address, in_user_phone, in_company_id, in_user_position, in_user_area, in_user_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteRolePermission` (IN `in_role_id` VARCHAR(5), IN `in_permission_id` VARCHAR(5))   BEGIN
    DELETE FROM Roles_Permissions
    WHERE role_id = in_role_id AND permission_id = in_permission_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectAccountByID` (IN `in_account_id` VARCHAR(5))   BEGIN
    SELECT * FROM Accounts WHERE account_id = in_account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectAccountsByRoleID` (IN `in_role_id` VARCHAR(5))   BEGIN
    SELECT * FROM Accounts WHERE role_id = in_role_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectAccountsByStatus` (IN `in_account_status` VARCHAR(25))   BEGIN
    SELECT * FROM Accounts WHERE account_status = in_account_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectAllCompanies` ()   BEGIN
    SELECT * FROM Companies;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectAllRolePermissions` ()   BEGIN
    SELECT * FROM Roles_Permissions;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectAllRoles` ()   BEGIN
    SELECT * FROM Roles;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectAllUsers` ()   BEGIN
    SELECT * FROM Users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectCompaniesByStatus` (IN `in_company_status` VARCHAR(25))   BEGIN
    SELECT * FROM Companies WHERE company_status = in_company_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectCompanyByID` (IN `in_company_id` VARCHAR(5))   BEGIN
    SELECT * FROM Companies WHERE company_id = in_company_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectMessagesByConversationID` (IN `in_conversation_id` VARCHAR(10))   BEGIN
    SELECT * FROM Messages WHERE conversation_id = in_conversation_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectRequestByID` (IN `in_request_id` VARCHAR(10))   BEGIN
    SELECT * FROM Request WHERE requests_id = in_request_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectRequestsByStatus` (IN `in_request_status` VARCHAR(25))   BEGIN
    SELECT * FROM Request WHERE request_status = in_request_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectRequestsByUserIDCustomer` (IN `in_user_id_customer` VARCHAR(7))   BEGIN
    SELECT * FROM Request WHERE user_id_customer = in_user_id_customer;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectRequestsByUserIDCustomerAndStatus` (IN `in_user_id_customer` VARCHAR(7), IN `in_request_status` VARCHAR(25))   BEGIN
    SELECT * FROM Request WHERE user_id_customer = in_user_id_customer AND request_status = in_request_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectRequestsByUserIDEmployee` (IN `in_user_id_employee` VARCHAR(7))   BEGIN
    SELECT * FROM Request WHERE user_id_employee = in_user_id_employee;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectRequestsByUserIDEmployeeAndStatus` (IN `in_user_id_employee` VARCHAR(7), IN `in_request_status` VARCHAR(25))   BEGIN
    SELECT * FROM Request WHERE user_id_employee = in_user_id_employee AND request_status = in_request_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectRolePermissionsByPermissionID` (IN `in_permission_id` VARCHAR(5))   BEGIN
    SELECT * FROM Roles_Permissions WHERE permission_id = in_permission_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectRolePermissionsByRoleID` (IN `in_role_id` VARCHAR(5))   BEGIN
    SELECT * FROM Roles_Permissions WHERE role_id = in_role_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectRolesByRoleID` (IN `in_role_id` VARCHAR(5))   BEGIN
    SELECT * FROM Roles WHERE role_id = in_role_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectRolesByStatus` (IN `in_role_status` VARCHAR(25))   BEGIN
    SELECT * FROM Roles WHERE role_status = in_role_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectUserByAccount` (IN `in_account_id` VARCHAR(5))   BEGIN
    SELECT * FROM Users WHERE account_id = in_account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectUserById` (IN `in_user_id` VARCHAR(7))   BEGIN
    SELECT * FROM Users WHERE user_id = in_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectUsersByCompany` (IN `in_company_id` VARCHAR(5))   BEGIN
    SELECT * FROM Users WHERE company_id = in_company_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectUsersByStatus` (IN `in_user_status` VARCHAR(25))   BEGIN
    SELECT * FROM Users WHERE user_status = in_user_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateAccountByID` (IN `in_account_id` VARCHAR(5), IN `in_account_name` VARCHAR(50), IN `in_account_email` VARCHAR(100), IN `in_role_id` VARCHAR(5))   BEGIN
    UPDATE Accounts
    SET account_name = in_account_name, account_email = in_account_email, role_id = in_role_id
    WHERE account_id = in_account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateAccountPassword` (IN `in_account_id` VARCHAR(5), IN `in_account_password` TEXT)   BEGIN
    UPDATE Accounts
    SET account_password = in_account_password
    WHERE account_id = in_account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateAccountStatus` (IN `in_account_id` VARCHAR(5), IN `in_account_status` VARCHAR(25))   BEGIN
    UPDATE Accounts
    SET account_status = in_account_status
    WHERE account_id = in_account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCompanyStatus` (IN `in_company_id` VARCHAR(5), IN `in_company_status` VARCHAR(25))   BEGIN
    UPDATE Companies
    SET company_status = in_company_status
    WHERE company_id = in_company_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateRequestByID` (IN `in_request_id` VARCHAR(10), IN `in_user_id_customer` VARCHAR(7), IN `in_request_art` VARCHAR(100), IN `in_request_support` VARCHAR(100), IN `in_request_production_date` DATE, IN `in_request_production_time` TIME, IN `in_request_final_production_date` DATE, IN `in_request_details` TEXT, IN `in_request_purpose` TEXT, IN `in_request_reference` VARCHAR(100), IN `in_request_additional_comments` TEXT, IN `in_request_assessment` TEXT, IN `in_user_id_employee` VARCHAR(7), IN `in_request_status` VARCHAR(25))   BEGIN
    UPDATE Request
    SET user_id_customer = in_user_id_customer, request_art = in_request_art, request_support = in_request_support, request_production_date = in_request_production_date, request_production_time = in_request_production_time, request_final_production_date = in_request_final_production_date, request_details = in_request_details, request_purpose = in_request_purpose, request_reference = in_request_reference, request_additional_comments = in_request_additional_comments, request_assessment = in_request_assessment, user_id_employee = in_user_id_employee, request_status = in_request_status
    WHERE requests_id = in_request_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateRequestStatus` (IN `in_request_id` VARCHAR(10), IN `in_request_status` VARCHAR(25))   BEGIN
    UPDATE Request
    SET request_status = in_request_status
    WHERE requests_id = in_request_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateRole` (IN `in_role_id` VARCHAR(5), IN `in_role_name` VARCHAR(25))   BEGIN
    UPDATE Roles
    SET role_name = in_role_name
    WHERE role_id = in_role_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateRoleStatus` (IN `in_role_id` VARCHAR(5), IN `in_role_status` VARCHAR(25))   BEGIN
    UPDATE Roles
    SET role_status = in_role_status
    WHERE role_id = in_role_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUser` (IN `in_user_id` VARCHAR(7), IN `in_account_names` VARCHAR(100), IN `in_user_surnames` VARCHAR(100), IN `in_user_address` TEXT, IN `in_user_phone` VARCHAR(25), IN `in_company_id` VARCHAR(5), IN `in_user_position` VARCHAR(50), IN `in_user_area` VARCHAR(50), IN `in_user_status` VARCHAR(25))   BEGIN
    UPDATE Users
    SET account_names = in_account_names, user_surnames = in_user_surnames, user_address = in_user_address, user_phone = in_user_phone, company_id = in_company_id, user_position = in_user_position, user_area = in_user_area, user_status = in_user_status
    WHERE user_id = in_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUserStatus` (IN `in_user_id` VARCHAR(7), IN `in_user_status` VARCHAR(25))   BEGIN
    UPDATE Users
    SET user_status = in_user_status
    WHERE user_id = in_user_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

CREATE TABLE `accounts` (
  `account_id` varchar(5) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `account_email` varchar(100) NOT NULL,
  `account_password` text NOT NULL,
  `role_id` varchar(5) NOT NULL,
  `account_status` varchar(25) NOT NULL,
  `account_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `account_modification` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `accounts`
--
DELIMITER $$
CREATE TRIGGER `after_update_account_status` AFTER UPDATE ON `accounts` FOR EACH ROW BEGIN
    IF NEW.account_status = 'Inactive' THEN
        UPDATE Users SET user_status = 'Inactive' WHERE account_id = NEW.account_id;
    ELSEIF NEW.account_status = 'Active' THEN
        UPDATE Users SET user_status = 'Active' WHERE account_id = NEW.account_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `company_id` varchar(5) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_status` varchar(25) NOT NULL,
  `company_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `company_modification` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `companies`
--
DELIMITER $$
CREATE TRIGGER `after_update_company_status` AFTER UPDATE ON `companies` FOR EACH ROW BEGIN
    IF NEW.company_status = 'Active' OR NEW.company_status = 'Inactive' THEN
        UPDATE Users SET user_status = NEW.company_status WHERE company_id = NEW.company_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `message_id` varchar(12) NOT NULL,
  `user_id` varchar(7) NOT NULL,
  `conversation_id` varchar(10) NOT NULL,
  `message_content` text NOT NULL,
  `message_status` varchar(25) NOT NULL,
  `message_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `message_modification` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` varchar(5) NOT NULL,
  `permission_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request`
--

CREATE TABLE `request` (
  `request_id` varchar(10) NOT NULL,
  `user_id_customer` varchar(7) NOT NULL,
  `request_art` varchar(100) NOT NULL,
  `request_support` varchar(100) NOT NULL,
  `request_production_date` date DEFAULT NULL,
  `request_production_time` time DEFAULT NULL,
  `request_final_production_date` date NOT NULL,
  `request_details` text NOT NULL,
  `request_purpose` text NOT NULL,
  `request_reference` varchar(100) DEFAULT NULL,
  `request_additional_comments` text DEFAULT NULL,
  `request_assessment` text DEFAULT NULL,
  `user_id_employee` varchar(7) DEFAULT NULL,
  `request_status` varchar(25) NOT NULL,
  `request_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `request_modification` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `role_id` varchar(5) NOT NULL,
  `role_name` varchar(25) NOT NULL,
  `role_status` varchar(25) NOT NULL,
  `role_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_modification` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_status`, `role_creation`, `role_modification`) VALUES
('AD001', 'Administrador', 'Activo', '2023-11-13 20:28:45', NULL),
('CL003', 'Cliente', 'Activo', '2023-11-13 20:28:45', NULL),
('EP002', 'Empleado', 'Activo', '2023-11-13 20:28:45', NULL);

--
-- Disparadores `roles`
--
DELIMITER $$
CREATE TRIGGER `after_update_role_status` AFTER UPDATE ON `roles` FOR EACH ROW BEGIN
    IF NEW.role_status = 'Active' OR NEW.role_status = 'Inactive' THEN
        UPDATE Accounts SET account_status = NEW.role_status WHERE role_id = NEW.role_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` varchar(5) NOT NULL,
  `permission_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` varchar(7) NOT NULL,
  `account_id` varchar(5) NOT NULL,
  `account_names` varchar(100) NOT NULL,
  `user_surnames` varchar(100) NOT NULL,
  `user_address` text NOT NULL,
  `user_phone` varchar(25) NOT NULL,
  `company_id` varchar(5) NOT NULL,
  `user_position` varchar(50) NOT NULL,
  `user_area` varchar(50) NOT NULL,
  `user_status` varchar(25) NOT NULL,
  `user_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_modification` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `users`
--
DELIMITER $$
CREATE TRIGGER `after_update_user_status` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
    IF NEW.user_status = 'Inactive' THEN
        UPDATE Accounts SET account_status = 'Inactive' WHERE account_id = NEW.account_id;
    ELSEIF NEW.user_status = 'Active' THEN
        UPDATE Accounts SET account_status = 'Active' WHERE account_id = NEW.account_id;
    END IF;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `account_name` (`account_name`),
  ADD UNIQUE KEY `account_email` (`account_email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indices de la tabla `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_name` (`company_name`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `conversation_id` (`conversation_id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`);

--
-- Indices de la tabla `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id_customer` (`user_id_customer`),
  ADD KEY `user_id_employee` (`user_id_employee`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indices de la tabla `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `account_id` (`account_id`),
  ADD UNIQUE KEY `user_phone` (`user_phone`),
  ADD KEY `company_id` (`company_id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Filtros para la tabla `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`conversation_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`user_id_customer`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`user_id_employee`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
