-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cybersec
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `cybersec`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `cybersec` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `cybersec`;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_activity_user` (`user_id`),
  CONSTRAINT `fk_activity_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,1,'LOGIN','Administrador acessou o sistema.','2026-06-05 18:05:33'),(2,2,'CADASTRO','Usuário criado para testes.','2026-06-05 18:05:33'),(5,1,'LOGIN','Usuário realizou login.','2026-06-05 18:08:14'),(8,1,'LOGIN','Usuário realizou login.','2026-06-06 01:29:06'),(11,1,'LOGIN','Usuário realizou login.','2026-06-06 01:43:37'),(13,1,'LOGIN','Usuário realizou login.','2026-06-06 18:19:25'),(16,1,'LOGIN','Usuário realizou login.','2026-06-07 12:05:37'),(17,1,'DESAFIO','Resolveu: teste','2026-06-07 12:06:29'),(18,1,'DESAFIO','Resolveu: teste 2','2026-06-07 12:18:06'),(19,1,'DESAFIO','Resolveu: 3','2026-06-07 12:18:19'),(20,1,'DESAFIO','Resolveu: 4','2026-06-07 12:18:33'),(21,1,'DESAFIO','Resolveu: 1','2026-06-07 12:20:36'),(22,1,'DESAFIO','Resolveu: 2','2026-06-07 12:20:44'),(23,1,'DESAFIO','Resolveu: 3','2026-06-07 12:20:53'),(24,1,'DESAFIO','Resolveu: 4','2026-06-07 12:21:10'),(25,1,'DESAFIO','Resolveu: 5','2026-06-07 12:21:17'),(26,1,'LOGIN','Usuário realizou login.','2026-06-07 20:34:58'),(27,1,'PERFIL','Perfil atualizado.','2026-06-08 00:55:54'),(28,1,'PERFIL','Perfil atualizado.','2026-06-08 00:56:30'),(31,1,'LOGIN','Usuário realizou login.','2026-06-08 14:24:33'),(33,1,'LOGIN','Usuário realizou login.','2026-06-08 22:01:30'),(34,1,'LOGIN','Usuário realizou login.','2026-06-09 23:29:44'),(36,1,'LOGIN','Usuário realizou login.','2026-06-10 12:45:59'),(37,1,'LOGIN','Usuário realizou login.','2026-06-10 12:52:49'),(38,1,'LOGIN','Usuário realizou login.','2026-06-10 13:08:36'),(39,1,'LOGIN','Usuário realizou login.','2026-06-10 13:25:39'),(40,1,'LOGIN','Usuário realizou login.','2026-06-10 14:14:33'),(41,1,'LOGIN','Usuário realizou login.','2026-06-10 14:19:14'),(42,1,'LOGIN','Usuário realizou login.','2026-06-10 15:25:52'),(43,1,'LOGIN','Usuário realizou login.','2026-06-10 15:29:38'),(44,1,'LOGIN','Usuário realizou login.','2026-06-11 01:55:28'),(45,1,'LOGIN','Usuário realizou login.','2026-06-11 13:03:08'),(46,1,'LOGIN','Usuário realizou login.','2026-06-11 21:51:12'),(47,1,'LOGIN','Usuário realizou login.','2026-06-12 00:04:30'),(51,1,'LOGIN','Usuário realizou login.','2026-06-12 11:05:28'),(53,1,'LOGIN','Usuário realizou login.','2026-06-12 11:44:14'),(54,1,'LOGIN','Usuário realizou login.','2026-06-12 12:07:47');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `icon` varchar(100) DEFAULT '?',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badges`
--

LOCK TABLES `badges` WRITE;
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;
INSERT INTO `badges` VALUES (1,'Primeiro Login','Realizou o primeiro login.','🎉','2026-06-06 18:45:40'),(2,'Primeiro Desafio','Resolveu o primeiro desafio.','🚀','2026-06-06 18:45:40'),(3,'5 Desafios','Resolveu 5 desafios.','🔥','2026-06-06 18:45:40'),(4,'10 Desafios','Resolveu 10 desafios.','⚡','2026-06-06 18:45:40'),(5,'100 XP','Alcançou 100 XP.','🏅','2026-06-06 18:45:40'),(6,'500 XP','Alcançou 500 XP.','🥇','2026-06-06 18:45:40'),(7,'1000 XP','Alcançou 1000 XP.','👑','2026-06-06 18:45:40');
/*!40000 ALTER TABLE `badges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certificates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `certificate_code` varchar(100) DEFAULT NULL,
  `issued_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `certificate_code` (`certificate_code`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificates`
--

LOCK TABLES `certificates` WRITE;
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
INSERT INTO `certificates` VALUES (1,1,'CYBERSEC-6A25624158632','2026-06-07 12:21:21');
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `challenges`
--

DROP TABLE IF EXISTS `challenges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `difficulty` enum('Easy','Medium','Hard') NOT NULL,
  `xp_reward` int(11) NOT NULL DEFAULT 50,
  `flag` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenges`
--

LOCK TABLES `challenges` WRITE;
/*!40000 ALTER TABLE `challenges` DISABLE KEYS */;
INSERT INTO `challenges` VALUES (18,'Cabeçalho Suspeito','Um analista interceptou a seguinte requisição HTTP:\r\n\r\nGET /admin HTTP/1.1\r\nHost: cybersec.local\r\nUser-Agent: Kali-Linux\r\nX-Secret: CYBER{header_found}\r\n\r\nIdentifique a flag escondida na requisição.','Easy',100,'CYBER{header_found}','2026-06-11 22:21:23'),(19,'Log Comprometido','Analise o log abaixo:\r\n\r\n10:15 LOGIN_FAILED guest\r\n10:17 LOGIN_FAILED root\r\n10:18 LOGIN_SUCCESS admin\r\n10:20 FLAG CYBER{log_master}\r\n\r\nEncontre a flag presente nos registros.','Easy',120,'CYBER{log_master}','2026-06-11 22:22:36'),(20,'Mensagem Codificada','Um atacante deixou a seguinte mensagem:\r\n\r\nQlfh zrun!\r\n\r\nUtilize uma Cifra de César com deslocamento de 3 posições para descobrir a mensagem original.\r\n\r\nA flag é a palavra decifrada em letras maiúsculas.\r\n\r\nFormato:\r\n\r\nCYBER{PALAVRA}','Medium',180,'CYBER{NICEWORK}','2026-06-11 22:23:15'),(21,'Investigação Forense','Durante uma análise foram encontrados os seguintes dados:\r\n\r\nUsuário: admin\r\nIP: 172.16.0.10\r\nHash: 5f4dcc3b5aa765d61d8327deb882cf99\r\n\r\nA senha correspondente ao hash é a resposta.\r\n\r\nFormato:\r\n\r\nCYBER{senha}','Medium',200,'CYBER{password}','2026-06-11 22:23:48'),(22,'Reconhecimento de Rede','Configuração encontrada:\r\n\r\nIP: 192.168.1.50\r\nGateway: 192.168.1.1\r\nDNS: 8.8.8.8\r\n\r\nA flag é o endereço configurado como DNS.\r\n\r\nFormato:\r\n\r\nCYBER{endereco}','Hard',220,'CYBER{8.8.8.8}','2026-06-11 22:24:12'),(23,'Flag Fragmentada','Um invasor dividiu a flag em três partes:\r\n\r\nParte 1:\r\nCYBER\r\n\r\nParte 2:\r\n{hidden\r\n\r\nParte 3:\r\n_flag}\r\n\r\nMonte a flag completa.','Hard',300,'CYBER{hidden_flag}','2026-06-11 22:24:33');
/*!40000 ALTER TABLE `challenges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lab_progress`
--

DROP TABLE IF EXISTS `lab_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `lab_id` int(11) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `completed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_lab_progress_user_lab` (`user_id`,`lab_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab_progress`
--

LOCK TABLES `lab_progress` WRITE;
/*!40000 ALTER TABLE `lab_progress` DISABLE KEYS */;
INSERT INTO `lab_progress` VALUES (1,1,1,1,'2026-06-10 21:40:36');
/*!40000 ALTER TABLE `lab_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labs`
--

DROP TABLE IF EXISTS `labs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `labs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `difficulty` varchar(50) DEFAULT NULL,
  `xp_reward` int(11) DEFAULT NULL,
  `material` longtext DEFAULT NULL,
  `question` text DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labs`
--

LOCK TABLES `labs` WRITE;
/*!40000 ALTER TABLE `labs` DISABLE KEYS */;
INSERT INTO `labs` VALUES (1,'Análise de HTML','Encontre a flag escondida.','Web','Iniciante',50,'<!-- CYBERSEC{HTML_FOUND} -->','Qual é a flag?','CYBERSEC{HTML_FOUND}','2026-06-10 23:14:37'),(3,'Cabeçalhos HTTP','Aprenda a analisar cabeçalhos HTTP utilizados por aplicações web.','Web Security','Iniciante',50,'Quando um navegador acessa um site, ele envia uma requisição HTTP.\r\n\r\nExemplo:\r\n\r\nGET / HTTP/1.1\r\nHost: exemplo.com\r\nUser-Agent: Mozilla/5.0\r\n\r\nO campo User-Agent identifica o navegador utilizado.\r\n\r\nAnalise a requisição abaixo:\r\n\r\nGET /index.php HTTP/1.1\r\nHost: cybersec.local\r\nUser-Agent: Firefox','Qual é o valor do cabeçalho User-Agent?','Firefox','2026-06-11 21:52:58'),(4,'Analisando um Cabeçalho HTTP','Aprenda a identificar informações importantes em uma requisição HTTP.','Web','Iniciante',50,'Uma requisição HTTP pode conter vários cabeçalhos.\r\n\r\nExemplo:\r\n\r\nGET /login HTTP/1.1\r\nHost: cybersec.local\r\nUser-Agent: Firefox\r\nAccept: text/html\r\n\r\nO cabeçalho User-Agent informa qual navegador está sendo utilizado pelo cliente.','Qual é o valor do cabeçalho User-Agent?','Firefox','2026-06-11 22:04:39'),(5,'Encontrando o Diretório Atual','Aprenda a interpretar a saída de comandos Linux.','Linux','Iniciante',50,'O comando pwd exibe o diretório atual.\r\n\r\nExemplo:\r\n\r\npwd\r\n\r\nSaída:\r\n\r\n/home/cybersec/documentos\r\n\r\nAnalise a saída abaixo:\r\n\r\npwd\r\n\r\nSaída:\r\n\r\n/home/usuario/projetos','Qual é o diretório atual?','/home/usuario/projetos','2026-06-11 22:06:17'),(6,'Identificando um Endereço IP','Aprenda a identificar informações básicas de rede.','Redes','Iniciante',60,'Configuração de rede:\r\n\r\nIP: 192.168.10.15\r\nMáscara: 255.255.255.0\r\nGateway: 192.168.10.1\r\n\r\nO endereço IP identifica um dispositivo na rede.','Qual é o endereço IP configurado?','192.168.10.15','2026-06-11 22:07:10'),(7,'Investigação de Perfil Público','Introdução aos conceitos de OSINT.','OSINT','Iniciante',60,'OSINT significa Open Source Intelligence.\r\n\r\nConsidere um perfil público contendo:\r\n\r\nNome: João Silva\r\nCidade: São Luís\r\nProfissão: Analista de Sistemas\r\n\r\nTodas essas informações são públicas.','Qual cidade foi identificada?','São Luís','2026-06-11 22:07:55'),(8,'Analisando Logs de Login','Aprenda a identificar eventos em registros de sistema.','Logs','Iniciante',70,'2025-05-01 08:00 LOGIN_SUCCESS admin\r\n2025-05-01 08:05 LOGIN_FAILED guest\r\n2025-05-01 08:07 LOGIN_FAILED root\r\n\r\nO evento LOGIN_SUCCESS representa um login bem-sucedido.','Qual usuário realizou LOGIN_SUCCESS?','admin','2026-06-11 22:08:40'),(9,'Hash Conhecido','Introdução à análise forense digital.','Forense','Intermediário',80,'Hash encontrado:\r\n\r\n5f4dcc3b5aa765d61d8327deb882cf99\r\n\r\nEsse hash MD5 é amplamente conhecido em treinamentos de segurança.','Qual senha gera esse hash?','password','2026-06-11 22:09:47'),(10,'Enumerando Arquivos Linux','Identifique arquivos através da saída de comandos.','Linux','Iniciante',75,'Comando:\r\n\r\nls\r\n\r\nResultado:\r\n\r\ndocumentos\r\ndownloads\r\nsenhas.txt\r\nbackup.zip\r\n\r\nO comando ls lista arquivos e diretórios.','Qual arquivo parece conter credenciais?','senhas.txt','2026-06-11 22:10:48'),(11,'Descobrindo o Método HTTP','Analise tráfego web básico.','Web','Avançado',90,'POST /login HTTP/1.1\r\nHost: cybersec.local\r\n\r\nusuario=admin\r\nsenha=123456\r\n\r\nO método HTTP aparece na primeira linha da requisição.','Qual método HTTP foi utilizado?','POST','2026-06-11 22:11:48'),(12,'Análise de DNS','Identifique serviços de rede.','Redes','Avançado',100,'google.com → 142.250.184.14\r\n\r\nO DNS converte nomes em endereços IP.','Qual serviço converte nomes para IP?','DNS','2026-06-11 22:13:05'),(13,'Investigação de Acesso Suspeito','Analise registros de autenticação.','Logs','Avançado',110,'08:00 admin LOGIN_SUCCESS\r\n08:10 guest LOGIN_FAILED\r\n08:11 guest LOGIN_FAILED\r\n08:12 guest LOGIN_FAILED\r\n\r\nMúltiplas tentativas falhas podem indicar atividade suspeita.','Qual usuário apresentou múltiplas tentativas falhas?','guest','2026-06-11 22:13:51'),(14,'Coletando Informações Públicas','Aprenda conceitos intermediários de OSINT.','OSINT','Avançado',120,'Empresa:\r\n\r\nCyberSec LTDA\r\n\r\nSite:\r\nwww.cybersec.com\r\n\r\nContato:\r\ncontato@cybersec.com\r\n\r\nTodas essas informações estão publicamente disponíveis.','Qual é o e-mail de contato encontrado?','contato@cybersec.com','2026-06-11 22:14:38'),(15,'Análise de Evidência Digital','Laboratório avançado de análise forense.','Forense','Avançado',150,'Arquivo analisado:\r\n\r\nevidencia.txt\r\n\r\nConteúdo:\r\n\r\nUsuário: admin\r\nIP: 10.10.10.5\r\nHorário: 23:45\r\n\r\nO investigador precisa identificar a origem da atividade.','Qual endereço IP aparece na evidência?','10.10.10.5','2026-06-11 22:15:34');
/*!40000 ALTER TABLE `labs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `learning_paths`
--

DROP TABLE IF EXISTS `learning_paths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `learning_paths` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `difficulty` enum('Iniciante','Intermediário','Avançado') DEFAULT 'Iniciante',
  `xp_reward` int(11) DEFAULT 50,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learning_paths`
--

LOCK TABLES `learning_paths` WRITE;
/*!40000 ALTER TABLE `learning_paths` DISABLE KEYS */;
INSERT INTO `learning_paths` VALUES (11,'Módulo 9 – Defesa Cibernética','Nesta trilha você aprende como sistemas se protegem contra ataques reais. Você entende o funcionamento de firewalls, antivírus modernos e sistemas de monitoramento de segurança.','Iniciante',50,'2026-06-10 20:23:19'),(12,'Módulo 8 – Engenharia Social Avançada','Nesta trilha você aprende como atacantes exploram o comportamento humano para obter acesso a informações. Você entende técnicas de manipulação, phishing avançado e criação de identidades falsas.','Iniciante',50,'2026-06-10 20:23:59'),(13,'Módulo 7 – Vulnerabilidades Web','Nesta trilha você aprende as principais falhas encontradas em aplicações web. Você entende como ataques como SQL Injection, XSS e CSRF funcionam e por que eles são tão perigosos.','Iniciante',50,'2026-06-10 20:27:01'),(16,'Módulo 6 – Pentest','Nesta trilha você aprende como testes de invasão funcionam na prática. Você entende as etapas usadas para analisar sistemas, encontrar vulnerabilidades e simular ataques de forma controlada.','Iniciante',50,'2026-06-10 20:36:46'),(17,'Módulo 5 – Criptografia','Nesta trilha você aprende como dados são protegidos através de técnicas matemáticas. Você vai entender criptografia simétrica, assimétrica e hash, além de como essas tecnologias protegem senhas e comunicações na internet.','Iniciante',50,'2026-06-10 20:37:31'),(20,'Módulo 4 – Redes de Computadores','Nesta trilha você entende como a internet funciona por trás dos bastidores. Você aprende como dados trafegam entre dispositivos, o papel do DNS, IP e como protocolos como TCP e UDP influenciam na comunicação.','Iniciante',50,'2026-06-10 20:39:45'),(21,'Módulo 3 – Autenticação e Segurança de Contas','Nesta trilha você aprende como proteger suas contas digitais de forma correta. Você vai entender como criar senhas seguras, o que é autenticação em múltiplos fatores e quais erros comuns deixam contas vulneráveis a invasões.','Iniciante',50,'2026-06-10 20:40:16'),(22,'Módulo 2 – Ameaças Cibernéticas','Nesta trilha você aprende a identificar os principais tipos de ataques digitais, como malware, phishing e engenharia social. O foco é entender como cada ameaça funciona na prática e qual impacto pode causar em sistemas e usuários.','Iniciante',50,'2026-06-10 20:40:53'),(23,'Módulo 1 – Fundamentos da Segurança da Informação','Nesta trilha você aprende o que é segurança da informação, por que ela existe e como ela protege sistemas no mundo real. Você vai entender os pilares fundamentais da segurança digital e como a maioria dos ataques realmente começa, geralmente explorando erros humanos.','Iniciante',50,'2026-06-10 20:41:26');
/*!40000 ALTER TABLE `learning_paths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lesson_progress`
--

DROP TABLE IF EXISTS `lesson_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lesson_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`lesson_id`),
  KEY `lesson_id` (`lesson_id`),
  CONSTRAINT `lesson_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lesson_progress_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson_progress`
--

LOCK TABLES `lesson_progress` WRITE;
/*!40000 ALTER TABLE `lesson_progress` DISABLE KEYS */;
INSERT INTO `lesson_progress` VALUES (16,1,14,1,'2026-06-11 13:03:38'),(17,1,17,1,'2026-06-12 12:18:56');
/*!40000 ALTER TABLE `lesson_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `lesson_order` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `path_id` (`path_id`),
  CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`path_id`) REFERENCES `learning_paths` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` VALUES (13,11,'Firewall','Firewall é um sistema que controla o tráfego de rede, permitindo ou bloqueando conexões com base em regras definidas.\r\n\r\nEle funciona como uma barreira entre redes confiáveis e não confiáveis.',1),(14,23,'O que é Segurança da Informação','A segurança da informação é uma área que existe para proteger dados digitais contra qualquer tipo de acesso não autorizado, alteração indevida ou perda de informação. Isso inclui desde senhas de usuários até sistemas completos de empresas.\r\n\r\nNa prática, a segurança da informação não serve apenas para “evitar hackers”, mas também para garantir que os dados continuem corretos, disponíveis e acessíveis apenas por quem tem permissão. Um erro comum é pensar que ataques acontecem apenas por falhas técnicas, mas na maioria dos casos eles acontecem por erro humano, como clicar em links falsos ou reutilizar senhas fracas.\r\n\r\nUm exemplo simples é quando um usuário recebe um e-mail falso dizendo ser do banco e informa seus dados sem perceber que está sendo enganado. Nesse caso, o sistema não foi quebrado, mas o usuário foi induzido ao erro.',1),(15,23,'CIA Triad','A CIA Triad é o conjunto de três princípios fundamentais da segurança da informação: confidencialidade, integridade e disponibilidade. A confidencialidade garante que apenas pessoas autorizadas tenham acesso aos dados. A integridade garante que as informações não sejam alteradas de forma indevida ou sem permissão. Já a disponibilidade garante que os sistemas e dados estejam acessíveis sempre que forem necessários.\r\n\r\nEsses três conceitos trabalham juntos. Por exemplo, um sistema bancário precisa garantir que apenas o dono da conta veja seus dados, que o saldo não seja alterado de forma indevida e que o sistema esteja disponível quando o cliente precisar acessar.',2),(16,23,'Como ataques realmente acontecem','Ataques cibernéticos quase nunca acontecem de forma direta e imediata. Em geral, eles seguem uma sequência lógica que começa com a coleta de informações sobre o alvo, depois a tentativa de exploração de alguma falha e, por fim, o acesso ou roubo de dados.\r\n\r\nA parte mais importante desse processo é entender que muitas invasões não acontecem por falhas complexas no sistema, mas sim por manipulação de pessoas. Um atacante pode, por exemplo, descobrir e-mails de funcionários de uma empresa e enviar mensagens falsas para tentar roubar credenciais.',3),(17,22,'Malware e como funciona','Malware é qualquer tipo de software criado com intenção maliciosa. Ele pode ter diferentes objetivos, como roubar dados, espionar usuários, destruir arquivos ou até controlar completamente um sistema.\r\n\r\nUm vírus, por exemplo, precisa da ação do usuário para ser executado e pode se espalhar infectando arquivos. Já um worm consegue se espalhar automaticamente pela rede sem precisar de interação humana. O trojan é ainda mais perigoso porque se disfarça de programa legítimo para enganar o usuário. O ransomware é um tipo de malware que bloqueia ou criptografa os arquivos da vítima e exige pagamento para liberar o acesso.\r\n\r\nNa prática, esses ataques são perigosos porque muitas vezes o usuário nem percebe que foi infectado até que seus dados já estejam comprometidos.',1),(18,22,'Phishing e engenharia da enganação','Phishing é um tipo de ataque que tenta enganar o usuário para que ele entregue informações sensíveis, como senhas ou dados bancários. Ele funciona explorando urgência, medo ou confiança.\r\n\r\nNormalmente, o atacante envia mensagens que parecem reais, como e-mails de bancos ou empresas conhecidas, dizendo que há um problema na conta e que o usuário precisa agir rapidamente. Ao clicar no link, a vítima é levada para uma página falsa muito parecida com a original, onde insere seus dados sem perceber o risco.',2),(19,22,'Engenharia social','Engenharia social é o uso de manipulação psicológica para convencer pessoas a entregar informações ou realizar ações que comprometam a segurança. Diferente de ataques técnicos, aqui o foco não é o sistema, mas sim o comportamento humano.\r\n\r\nUm atacante pode fingir ser um funcionário de suporte técnico, um gerente ou até um colega de trabalho para ganhar confiança. Muitas vezes, ele usa pressão emocional, como urgência ou medo, para fazer a vítima agir sem pensar.',3),(20,21,'Senhas seguras','Senhas seguras são fundamentais porque são a primeira barreira contra invasões. Uma senha fraca pode ser descoberta em segundos por ataques automatizados que testam combinações comuns.\r\n\r\nUma senha forte precisa ser longa, aleatória e difícil de adivinhar. Ela deve conter letras maiúsculas e minúsculas, números e símbolos. Além disso, nunca deve ser reutilizada em vários serviços, pois se um site for comprometido, todas as outras contas também ficam em risco.',1),(21,21,'MFA (autenticação em múltiplos fatores)','A autenticação em múltiplos fatores adiciona uma camada extra de segurança além da senha. Mesmo que alguém descubra sua senha, ainda será necessário um segundo fator para acessar a conta.\r\n\r\nEsse segundo fator pode ser um código enviado por SMS, um aplicativo autenticador ou até biometria. Isso reduz drasticamente o risco de invasões, pois o atacante precisaria comprometer mais de um elemento ao mesmo tempo.',2),(22,21,'Erros comuns de usuários','Grande parte das invasões acontece por erros simples cometidos pelos próprios usuários. Entre os mais comuns estão reutilizar senhas em vários sites, salvar senhas em arquivos sem proteção, clicar em links desconhecidos e ignorar autenticação em duas etapas.\r\n\r\nEsses erros facilitam muito o trabalho de atacantes, porque reduzem a necessidade de técnicas avançadas.',3),(23,20,'Como a internet realmente funciona','Quando você acessa um site, o processo envolve várias etapas invisíveis. Primeiro, o nome do site é enviado para um sistema chamado DNS, que traduz esse nome em um endereço IP. Depois disso, seu dispositivo se conecta ao servidor correto usando esse IP.\r\n\r\nEsse processo acontece em milissegundos e é essencial para que a internet funcione como conhecemos.',1),(24,20,'TCP e UDP','TCP e UDP são protocolos responsáveis pelo envio de dados na internet. O TCP garante que todos os dados cheguem corretamente e na ordem certa, sendo usado em situações onde a precisão é importante, como downloads e navegação web.\r\n\r\nJá o UDP prioriza velocidade e não garante entrega, sendo usado em jogos online e transmissões ao vivo, onde pequenos atrasos são mais importantes que a perda de alguns dados.',2),(25,20,'Pacotes de dados','A internet não envia informações de uma vez só. Os dados são divididos em pequenos pedaços chamados pacotes. Esses pacotes podem seguir caminhos diferentes até o destino e depois são reorganizados para formar a informação original.\r\n\r\nIsso torna a comunicação mais eficiente e resistente a falhas na rede.',3),(26,17,'Criptografia simétrica','Na criptografia simétrica, a mesma chave é usada tanto para codificar quanto para decodificar os dados. Isso torna o processo rápido, mas exige que a chave seja compartilhada de forma segura entre as partes.\r\n\r\nO principal problema desse modelo é justamente o compartilhamento da chave, que pode ser interceptado.',1),(27,17,'Criptografia assimétrica','A criptografia assimétrica usa duas chaves diferentes: uma pública e uma privada. A chave pública pode ser compartilhada com qualquer pessoa, enquanto a chave privada deve ser mantida em segredo.\r\n\r\nDados criptografados com a chave pública só podem ser descriptografados com a chave privada correspondente.',2),(28,17,'Hash','Hash é um processo que transforma qualquer dado em uma sequência fixa de caracteres. Esse processo é irreversível, ou seja, não é possível voltar ao valor original a partir do hash.\r\n\r\nEle é muito usado para armazenar senhas de forma segura.',3),(29,16,'Reconhecimento','O reconhecimento é a fase inicial de um teste de invasão. Nessa etapa, o objetivo é coletar o máximo de informações possíveis sobre o alvo, como endereços IP, tecnologias utilizadas e possíveis pontos fracos.\r\n\r\nEssa fase é essencial porque define toda a estratégia do ataque ou teste.',1),(30,16,'Exploração','A exploração acontece quando o atacante utiliza uma vulnerabilidade encontrada para tentar acessar o sistema. Isso pode envolver falhas de autenticação, injeção de código ou erros de configuração.\r\n\r\nÉ a fase onde a vulnerabilidade realmente é testada na prática.',2),(31,16,'Pós-exploração','Após obter acesso ao sistema, o atacante pode tentar manter esse acesso ativo, escalar privilégios ou coletar informações sensíveis. Essa fase é chamada de pós-exploração.',3),(32,13,'SQL Injection','SQL Injection acontece quando uma entrada do usuário é usada diretamente em uma consulta ao banco de dados sem validação adequada. Isso permite que o atacante altere a lógica da consulta e acesse dados indevidos.\r\n\r\nNa prática, isso pode permitir acesso a logins, senhas e informações sensíveis armazenadas no banco.',1),(33,13,'XSS','Cross-Site Scripting (XSS) ocorre quando um atacante injeta scripts maliciosos em páginas web que serão executados no navegador de outros usuários. Isso pode ser usado para roubar cookies ou sessões.',2),(34,13,'CSRF','CSRF é um ataque onde o usuário autenticado é induzido a executar ações sem perceber, como transferências ou alterações de dados.',3),(35,12,'Manipulação psicológica avançada','Aqui o atacante utiliza técnicas mais refinadas de persuasão, como criar autoridade falsa, gerar medo ou explorar confiança excessiva da vítima.\r\n\r\nEssas técnicas são eficazes porque exploram decisões emocionais em vez de lógicas.',1),(36,12,'Phishing avançado','Phishing avançado envolve páginas extremamente bem construídas que imitam serviços reais, tornando difícil para o usuário perceber a fraude.\r\n\r\nEsses ataques podem até usar domínios parecidos com os originais.',2),(37,12,'Pretexting','Pretexting é a criação de uma identidade falsa ou história elaborada para ganhar confiança da vítima e extrair informações.',3),(38,11,'Antivírus moderno','Antivírus não apenas detecta arquivos infectados, mas também analisa comportamento suspeito de programas, bloqueando ações antes que causem dano.',2),(39,11,'Monitoramento de segurança','Monitoramento envolve observar continuamente logs e atividades do sistema para identificar padrões suspeitos, como tentativas repetidas de login ou acessos fora do padrão.',3);
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `levels`
--

DROP TABLE IF EXISTS `levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `xp_required` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels`
--

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
INSERT INTO `levels` VALUES (1,'Iniciante',0),(2,'Aprendiz',100),(3,'Analista',300),(4,'Especialista',700),(5,'Elite',1500);
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `path_progress`
--

DROP TABLE IF EXISTS `path_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `path_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `lesson_id` (`lesson_id`),
  CONSTRAINT `path_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `path_progress_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `path_progress`
--

LOCK TABLES `path_progress` WRITE;
/*!40000 ALTER TABLE `path_progress` DISABLE KEYS */;
/*!40000 ALTER TABLE `path_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson_id` (`lesson_id`),
  CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
INSERT INTO `quizzes` VALUES (11,13,'Firewall serve para:','Criar vírus','Filtrar tráfego de rede','Aumentar RAM','Criar sites','B'),(12,14,'Qual situação representa um problema de segurança da informação?','Computador lento','Usuário informando senha em site falso','Internet caindo','HD cheio','B'),(13,15,'O que significa integridade?','Dados sempre acessíveis','Dados protegidos contra alteração indevida','Dados criptografados automaticamente','Sistema mais rápido','B'),(14,16,'A maioria dos ataques acontece principalmente por:','Falhas de hardware','Engenharia social ou erro humano','Velocidade da internet','Problemas de monitor','B'),(15,17,'O que caracteriza um Trojan?','Se espalha sozinho pela rede','Só afeta hardware','Se disfarça de programa legítimo','Aumenta desempenho do sistema','C'),(16,18,'Como que o phishing funciona?','Falha no hardware','Por manipulação psicológica do usuário','Erro de internet','Por problemas no sistema operacional','B'),(17,19,'Engenharia social explora principalmente:','Hardware','CPU','Rede elétrica','Comportamento humano','D'),(18,20,'Por que senhas fracas são perigosas?','Porque podem ser descobertas por ataques automatizados','Porque deixam o computador lento','Porque podem ser descobertas por ataques automatizados','Porque ocupam espaço','A'),(19,21,'Qual é o objetivo do MFA?','Facilitar login','Trocar senha automaticamente','Aumentar segurança do acesso','Melhorar internet','C'),(20,22,'Qual prática aumenta o risco de invasão?','Usar MFA','Usar senhas fortes','Usar gerenciador de senhas','Reutilizar senha em vários sites','D'),(21,23,'Qual é a função do DNS?','Criar sites','Traduzir nomes em IP','Proteger firewall','Aumentar velocidade','B'),(22,24,'Por que o UDP é usado em jogos?','Porque é mais lento','Porque garante segurança total','Porque tem baixa latência','Porque criptografa dados','C'),(23,25,'Como os dados são enviados na internet?','Em pacotes','Em arquivos únicos','Em programas','Em blocos físicos','A'),(24,26,'Qual problema da criptografia simétrica?','Não funciona','Muito lenta','Compartilhamento da chave','Não usa chave','C'),(25,27,'Qual função da chave privada?','Ser compartilhada','Criptografar dados','Descriptografar dados recebidos','Criar firewall','C'),(26,28,'Hash é:','Reversível','Irreversível','Compartilhado','Dinâmico','B'),(27,29,'O reconhecimento serve para:','Explorar falhas','Criptografar dados','Defender sistema','Coletar informações','D'),(28,30,'Exploração significa:','Criar sistema','Atualizar software','Usar vulnerabilidade','Bloquear ataque','C'),(29,31,'Pós-exploração é:','Defender sistema','Manter acesso após invasão','Instalar antivírus','Criar firewall','B'),(30,32,'SQL Injection afeta:','Navegador','Monitor','CPU','Banco de dados','D'),(31,33,'XSS executa código em:','Servidor','Navegador','Hardware','BIOS','B'),(32,34,'CSRF ataca:','Usuário autenticado','CPU','Firewall','DNS','A'),(33,35,'Engenharia social explora:','Código','Psicologia humana','Hardware','Rede','B'),(34,36,'Phishing avançado é:','Fácil de detectar','Difícil de diferenciar do real','Hardware físico','Firewall','B'),(35,37,'Pretexting é:','Código malicioso','Criptografia','Firewall','História falsa para enganar','D'),(36,38,'Antivírus detecta:','Malware','Apenas hardware','DNS','IP','A'),(37,39,'Monitoramento serve para:','Jogar','Criar site','Detectar ataques','Aumentar CPU','C');
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `submitted_flag` varchar(255) NOT NULL,
  `is_correct` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_submission_user` (`user_id`),
  KEY `fk_submission_challenge` (`challenge_id`),
  CONSTRAINT `fk_submission_challenge` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_submission_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions`
--

LOCK TABLES `submissions` WRITE;
/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_badges`
--

DROP TABLE IF EXISTS `user_badges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL,
  `earned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`badge_id`),
  KEY `badge_id` (`badge_id`),
  CONSTRAINT `user_badges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_badges_ibfk_2` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_badges`
--

LOCK TABLES `user_badges` WRITE;
/*!40000 ALTER TABLE `user_badges` DISABLE KEYS */;
INSERT INTO `user_badges` VALUES (4,1,1,'2026-06-07 12:05:37'),(5,1,2,'2026-06-07 12:06:29'),(6,1,5,'2026-06-07 12:06:29'),(7,1,6,'2026-06-07 12:06:29'),(8,1,7,'2026-06-07 12:06:29'),(38,1,3,'2026-06-07 12:21:17');
/*!40000 ALTER TABLE `user_badges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `photo` varchar(255) DEFAULT NULL,
  `xp` int(11) DEFAULT 0,
  `level_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_user_level` (`level_id`),
  CONSTRAINT `fk_user_level` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador','admin@cybersec.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','admin',NULL,1922,5,'2026-06-05 18:00:25','2026-06-12 12:18:56'),(2,'Aluno Teste','aluno@cybersec.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','user',NULL,150,2,'2026-06-05 18:04:53','2026-06-05 18:04:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cybersec'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-16 22:39:02
