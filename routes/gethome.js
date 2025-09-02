const express = require('express');
const cookie = require('cookie-parser');
const fs = require('fs');
const db = require('./db');
const router = express.Router();
router.use(cookie());
router.post('/', (req, res) =>{
    const phone = req.cookies.phone;
    db.query('SELECT image, username, balance, trackingid FROM account WHERE phone = ?', [phone], (error, result) =>{
    
        if(error) throw error;
        if(result.length === 0){
            res.json({
                status: 'error',
                message: 'account information is miss please login again'
            });
            return;
        }
        let id = result[0].trackingid;
        const transactions = JSON.parse(fs.readFileSync('./routes/transactions.json', 'utf8'));
        let usertransac = transactions[id];
        let unreadCount = 0;
        db.query('SELECT COUNT(status) AS unread FROM messages WHERE reciever IN (SELECT trackingid FROM account WHERE phone = ?) AND status = ?', [phone, 'unread'], (error, rst) =>{
            if(error) throw error;
            unreadCount = rst[0].unread;
        });
        result[0]['unread'] = unreadCount;
        res.send(JSON.stringify({
            user: result[0],
            transac: usertransac,
            status: 'success'
        }));
    });
});
module.exports = router;
