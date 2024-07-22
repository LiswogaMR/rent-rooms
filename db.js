const sql = require('mssql');

// Database configuration
const config = {
    user: 'DESKTOP-HEU1O1R\Achie',
    password: '/',
    server: 'DESKTOP-HEU1O1R\SQLEXPRESS', 
    database: 'LandlordLogin',
    options: {
        encrypt: true,
        enableArithAbort: true
    }
};

// Function to connect to the database
async function connectToDatabase() {
    try {
        await sql.connect(config);
        console.log('Connected to the database');
    } catch (err) {
        console.error('Database connection failed: ', err);
    }
}

module.exports = {
    sql,
    connectToDatabase
};
