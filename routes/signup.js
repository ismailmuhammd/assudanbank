const express = require('express');
const cookieParser = require('cookie-parser');
const router = express.Router();
router.use(cookieParser());
router.post('/', (req, res) =>{
    const {phone, email, invite} = req.body;
  
    if(phone.length < 11 || email == ''){
        res.send(JSON.stringify({
            status : 'error',
            message : 'Phone number and email address are required'
        }));
        return;
    }else{
        const userdata = JSON.stringify({
            'phone' : phone,
            'email' : email,
            'inviteCode' : invite
        });
        res.cookie('userdata', userdata, {
            maxAge : 24 * 60 * 60 * 1000,
            httpOnly : true
        });
        
        res.send(JSON.stringify({
            status : 'success',
            message : 'continue to complete the signup'
        }));
    }
});
module.exports = router;
