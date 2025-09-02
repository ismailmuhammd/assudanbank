const mysql = require('mysql2');
const connection = mysql.createConnection({
    host : process.env.PG_HOST || 'localhost',
    user : process.env.PG_USER || 'root',
    password : process.env.PG_PASS || 'Bappa*#@(ct1)',
    database : process.env.PG_NAME || 'assudanbank'
});
connection.connect(error =>{
    if(error) throw error;
    console.log('Database connected');
});
module.exports = connection;
