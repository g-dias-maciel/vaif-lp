CREATE TABLE `leads` (
	`id` int AUTO_INCREMENT NOT NULL,
	`nome` varchar(255) NOT NULL,
	`whatsapp` varchar(20) NOT NULL,
	`instagram` varchar(100) NOT NULL,
	`faturamento` int NOT NULL,
	`ticket` int NOT NULL,
	`sessoes` int NOT NULL,
	`horas_admin` int NOT NULL,
	`valor_hora` int NOT NULL,
	`prejuizo_mensal` int NOT NULL,
	`potencial_lucro` int NOT NULL,
	`horas_secretario` int NOT NULL,
	`notionPageId` varchar(64),
	`synced` int NOT NULL DEFAULT 0,
	`createdAt` timestamp NOT NULL DEFAULT (now()),
	`updatedAt` timestamp NOT NULL DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT `leads_id` PRIMARY KEY(`id`)
);
