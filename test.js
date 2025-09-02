const nodemailer = require('nodemailer');
const transporter = nodemailer.createTransport({
    host : 'smtp.gmail.com',
    port : 587,
    secure : false,
    auth : {
        user : 'ismailmahmad3757@gmail.com',
        pass : 'wcfs plbp ahkd ssnk'
    }
});
async function sendMail(mto, msubject, mhtml){
    try{
        let info = await transporter.sendMail({
            from : 'Assudan Bank',
            to : mto,
            subject : msubject,
            html : mhtml
        });
        console.log(info.messageId);
    }catch(err){
        console.log(err);
    }
}
sendMail('ismailmuhammadahmad0@gmail.com','Assudan Testing','<h1>Mail testing using node js</h1><a href = "https://assudan.free.nf/voting">click here!</a>"');