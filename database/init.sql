-- Create leads table
CREATE TABLE IF NOT EXISTS `leads` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `whatsapp` VARCHAR(20) NOT NULL,
  `instagram` VARCHAR(100) NOT NULL,
  `faturamento` INT NOT NULL,
  `ticket` INT NOT NULL,
  `sessoes` INT NOT NULL,
  `horas_admin` INT NOT NULL,
  `valor_hora` INT NOT NULL,
  `prejuizo_mensal` INT NOT NULL,
  `potencial_lucro` INT NOT NULL,
  `horas_secretario` INT NOT NULL,
  `synced` TINYINT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_created_at` (`created_at`),
  INDEX `idx_synced` (`synced`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
