const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const bcrypt = require('bcrypt');
const cors = require('cors'); // To handle cross-origin requests
const app = express();

app.use(bodyParser.json());
app.use(cors());

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'vpmsdb'
});

db.connect(err => {
    if (err) throw err;
    console.log('Connected to MySQL Database!');
});

app.post('/login', (req, res) => {
    const { username, password } = req.body;

    const query = 'SELECT * FROM users WHERE username = ?';
    db.query(query, [username], (err, result) => {
        if (err) throw err;

        if (result.length > 0) {
            const user = result[0];
            bcrypt.compare(password, user.password, (err, isMatch) => {
                if (err) throw err;

                if (isMatch) {
                    res.json({ success: true, message: 'Login successful', user: user });
                } else {
                    res.json({ success: false, message: 'Invalid credentials' });
                }
            });
        } else {
            res.json({ success: false, message: 'User not found' });
        }
    });
});

app.listen(3000, () => {
    console.log('Server running on port 3000');
});
