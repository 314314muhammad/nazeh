-- MySQL schema for housing system
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS people;
DROP TABLE IF EXISTS families;
DROP TABLE IF EXISTS floors;
DROP TABLE IF EXISTS buildings;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE IF NOT EXISTS buildings (
  id VARCHAR(64) PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  created_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS floors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  building_id VARCHAR(64) NOT NULL,
  floor_number INT NOT NULL,
  rooms_count INT NOT NULL,
  FOREIGN KEY (building_id) REFERENCES buildings(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS families (
  id VARCHAR(64) PRIMARY KEY,
  composition VARCHAR(64) NOT NULL,
  building_id VARCHAR(64) NULL,
  floor_number INT NULL,
  room_number INT NULL,
  admin_notes TEXT NULL,
  needs_json JSON NULL,
  created_at DATETIME NULL,
  FOREIGN KEY (building_id) REFERENCES buildings(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS people (
  id INT AUTO_INCREMENT PRIMARY KEY,
  family_id VARCHAR(64) NOT NULL,
  role VARCHAR(32) NOT NULL,
  role_label VARCHAR(64) NULL,
  name VARCHAR(255) NULL,
  surname VARCHAR(255) NULL,
  relationship VARCHAR(255) NULL,
  gender VARCHAR(32) NULL,
  age INT NULL,
  phone VARCHAR(64) NULL,
  health VARCHAR(64) NULL,
  age_months INT NULL,
  diaper_size VARCHAR(128) NULL,
  milk_type VARCHAR(128) NULL,
  other_needs TEXT NULL,
  FOREIGN KEY (family_id) REFERENCES families(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_families_building_room
  ON families(building_id, floor_number, room_number);

CREATE INDEX idx_people_family
  ON people(family_id);
  
  
  
  
