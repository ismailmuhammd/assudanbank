const express = require('express');
const cookieParser = require('cookie-parser');
const multer = require('multer');
const db = require('./db');
const bcrypt = require('bcryptjs');
const {nanoid} = require('nanoid');
const fs = require('fs');
const path = require('path');
const router = express.Router();
router.use(cookieParser());
let imageName = `assudanbak_${Date.now()}.jpg`;
const storage = multer.diskStorage({
    destination : function(req, file, cb){
        cb(null, './public/images/');
    },
    filename : function(req, file, cb){
        cb(null, imageName);
    }
});
const upload = multer({storage : storage});
function checkRefferal(refferal, fname){
    db.query('SELECT balance, trackingid, fname, accountnumber FROM account WHERE refferal = ?',[refferal],(error, result, field) =>{
        if(error) throw error;
        if(result.length > 0){
            let newBalance =  parseFloat(result[0].balance) + 500;
            let reciever = result[0].trackingid;
            let acc = result[0].accountnumber;
            let earnUser = result[0].fname;
            db.query('UPDATE account SET balance = ? WHERE refferal = ?',[newBalance, refferal], (error, result)=>{
                if(error) throw error;
                let message_title = 'Assudan Bank Refferal Earn';
                let message_body = 'Account has earned <b>&#8358;500.00</b> as refferal gift from '+ fname +', Hope you are enjoying with services.';
                sendMessage('system', reciever, message_title, message_body);
                transactionHistory(reciever, earnUser, 'Refferral earn', acc, 500, 'in');
            });
        }
    });
}
function sendMessage(sender, reciever, message_title, message){
    const messageTable = `CREATE TABLE IF NOT EXISTS messages(
            message_id INT AUTO_INCREMENT,
            sender VARCHAR(30) NOT NULL,
            reciever VARCHAR(30) NOT NULL,
            message_title VARCHAR(200) NOT NULL,
            message_body TEXT NOT NULL,
            message_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            status VARCHAR(10) NOT NULL DEFAULT 'unread',
            PRIMARY KEY(message_id)
    )`;
    db.query(messageTable, (error) =>{
        if(error) throw error;
    });
    
    db.query("INSERT INTO messages(sender, reciever, message_title, message_body) VALUES(?,?,?,?)",[sender, reciever, message_title, message],(error) =>{
        if(error) throw error;
    });
}
function transactionHistory(userid, transfname, transfrom, accountNumber, transamount, transmode){
    let filePath = path.join(__dirname, '../routes/transactions.json');
    const currentTrans = {
                user: transfname,
                userfrom: transfrom,
                account: accountNumber,
                amount: transamount,
                tmode: transmode,
                transid: Date.now(),
                transdate: new Date(),
                status: 'success'
            };
    if(!fs.existsSync(filePath)){
        const transac = {
            [userid] : [currentTrans]
        };
        fs.writeFileSync(filePath, JSON.stringify(transac, null, 2));
    }else{
        const transacs = JSON.parse(fs.readFileSync(filePath, 'utf8'));
    
        if(transacs[userid]){
            transacs[userid].push(currentTrans);
        }else{
            transacs[userid] = [currentTrans];
        }
        fs.writeFileSync(filePath, JSON.stringify(transacs, null, 2));
    }
}
function checkUnique(col, value, callback){
    db.query(`SELECT ${col} FROM account WHERE ${col} = ?`, [value], (error, result) =>{
        if(error) return callback(error, null);
        if(result.length > 0){
            return callback(null, false);
        }
        return callback(null, true);
    });
}
router.post('/', upload.single('image'), (req, res) =>{
    const {fname, username, pin, password} = req.body;
    const data = JSON.parse(req.cookies.userdata);
    var {email, phone, inviteCode} = data;
    const salt = bcrypt.genSaltSync(10);
    const hashedPass = bcrypt.hashSync(password, salt);
    const tableSql = `CREATE TABLE IF NOT EXISTS account(
            id INT AUTO_INCREMENT,
            phone VARCHAR(12) NOT NULL UNIQUE,
            email VARCHAR(50) NOT NULL UNIQUE,
            fname VARCHAR(30) NOT NULL,
            username VARCHAR(20) NOT NULL,
            surname VARCHAR(50) NOT NULL,
            refferal VARCHAR(8),
            regdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            balance DECIMAL(12,2) NOT NULL,
            trackingid VARCHAR(50) NOT NULL,
            image VARCHAR(100) NOT NULL DEFAULT 'svg/user.svg',
            password TEXT NOT NULL,
            pin TEXT NOT NULL,
            accountnumber VARCHAR(10) NOT NULL,
            status VARCHAR(20) NOT NULL DEFAULT 'active',
            PRIMARY KEY(id)
    )`;
    db.query(tableSql, error =>{
        if(error) throw error;
        console.log('Table create successful');
    });
    //Data collection
    const surname = fname.split(' ').length > 1 ? fname.split(' ')[1] : '';
    const refferal = nanoid(8);
    const balance = 1500;
    const trackingid = nanoid(20);
    const accountNumber = phone.substr(1, 11);
    const hashedPin = bcrypt.hashSync(pin, salt);
    const insertdata = [phone, email, fname, username, surname, refferal, balance, trackingid, imageName, hashedPass, hashedPin, accountNumber];
    const sql = `INSERT INTO account(phone, email, fname, username, surname, refferal, balance, trackingid, image, password, pin, accountnumber)
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)`;
    checkUnique('email', email, (error, isUnique) =>{
        if(error){
            console.log(error);
            return;
        }
        if(isUnique){
            checkUnique('phone', phone, (error, isUnique)=>{
                if(error){
                    console.log(error);
                    return;
                }
                if(isUnique){
                    db.query(sql, insertdata, (error) =>{
                        if(error) throw error;
                            let message_title = 'Welcome to Assudan Bank';
                            let message_body = 'Hello <b>' +fname+ '</b> You are highly welcome to Assudan Online Banking System, a simple project done by <b>Ismail Muhammad Ahmad</b> young web developer as sample for real Banking System, mind you Assudan Online Bank is not real a Bank is just a sample, thank you for banking us.';
                            sendMessage('system', trackingid, message_title, message_body);
                            checkRefferal(inviteCode, fname);
                            transactionHistory(trackingid, fname, 'Starting balance', accountNumber, 1000, 'in');
                            message_title = 'Assudan Bank Starting Balance';
                            message_body = 'Account starting balance is <b>&#8358;1,000.00</b>, is your first balance with Assudan Bank, Thank you for bank with us';
                            sendMessage('system', trackingid, message_title, message_body);
                            message_title = 'Assudan Bank gift';
                            message_body = 'Your account have been credited with <b>&#8358;500.00</b> gift from Assudan Bank as new customer to the bank, thank you for banking us.';
                            sendMessage('system', trackingid, message_title, message_body);
                            transactionHistory(trackingid, fname, 'Gift from Assudan Bank', accountNumber, 500, 'in');
                            res.send(JSON.stringify({
                                status : 'success',
                                message : 'Your account created successful'
                            }));
                    });
                }else{
                   res.send(JSON.stringify({
                        status : 'error',
                        message : 'Phone is already in used'
                    })); 
                }
            });
        }else{
            res.send(JSON.stringify({
                status : 'error',
                message : 'This is email address already in used'
            }))
        }
    })
        
});
module.exports = router;