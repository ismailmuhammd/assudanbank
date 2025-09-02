const express = require('express');
const cookie = require('cookie-parser');
const db = require('./db');
const router = express.Router();
router.use(cookie());
router.post('/', (req, res) =>{
    const phone = req.cookies.phone;
    if(!phone){
        return res.json({
            status: 'nofound',
            message: 'User not logged in please login again'
        });
    }
    db.query('SELECT message_title, message_body, message_date FROM messages WHERE reciever IN (SELECT trackingid FROM account WHERE phone = ?) ORDER BY message_date DESC', [phone], (error, result) =>{
        if(error) throw error;
        db.query('UPDATE messages SET status = "read" WHERE reciever IN (SELECT trackingid FROM account WHERE phone = ?)', [phone], (error) =>{
            if(error) throw error;
        });
        res.json({
            status: 'success',
            messages: result
        });
    });
});
module.exports = router;