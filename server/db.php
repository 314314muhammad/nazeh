
const mysql = require("mysql2/promise");

const config = {
  host: process.env.DB_HOST || "localhost",
  user: process.env.DB_USER || "root",
  password: process.env.DB_PASSWORD || "",
  database: process.env.DB_NAME || "nazeh",
  port: process.env.DB_PORT ? Number(process.env.DB_PORT) : 3306,
  waitForConnections: true,
  connectionLimit: process.env.DB_POOL_SIZE
    ? Number(process.env.DB_POOL_SIZE)
    : 10,
  queueLimit: 0,
};

let pool;

function getPool() {
  if (!pool) {
    pool = mysql.createPool(config);
  }
  return pool;
}

module.exports = {
  getPool,
  config,
};
