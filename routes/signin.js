const express = require('express');
const bcrypt = require('bcryptjs');
const cookie = require('cookie-parser');
const db = require('./db');
const router = express.Router();
router.use(cookie());
router.post('/', (req, res) =>{
    const {phone, password} = req.body;
    db.query('SELECT phone, password FROM account WHERE phone = ?', [phone], (error, result) =>{
      
        if(result.length === 0){
            res.send(JSON.stringify({
                status : 'error',
                message : 'This phone number is not registered'
            }));
            return;
        }
        let hashedPass = result[0].password;
        let isPass = bcrypt.compareSync(password, hashedPass);
        if(isPass){
        	res.cookie('phone',phone,{
        		maxAge : 24 * 30 * 60 * 60 *1000,
        		httpOnly: true
        	})
          res.send(JSON.stringify({
                status : 'success',
                message : 'Your login details verify successful'
           }));
          
        }else{
            res.send(JSON.stringify({
                status : 'error',
                message : 'Incorrect password please check and try again'
            }));
        }
    });
});
module.exports = router;
