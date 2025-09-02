const express = require('express');
const fs = require('fs');
const bodyParser = require('body-parser');
const path = require('path');
const app = express();
const PORT = process.env.PORT || 3000;
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended : true}));
app.use(express.static(path.join(__dirname, 'public/images')));
app.use(express.static(path.join(__dirname, '../libraries')));
app.use(express.static(path.join(__dirname, './public/script')));
//get all request
//index
app.get('/', (req, res) =>{
    const signup = fs.readFileSync('./public/signup.html','utf8');
    res.send(signup);
});
//complete signup
app.get('/complete_index', (req, res) =>{
    const csignup = fs.readFileSync('./public/complete_signup.html','utf8');
    res.send(csignup);
});
//signin
app.get('/login', (req, res) =>{
    const login1 = fs.readFileSync('./public/signin.html','utf8');
    res.send(login1);
});
//forgot password
app.get('/forgot', (req, res) =>{
    const forgot = fs.readFileSync('./public/forgot-password.html','utf8');
    res.send(forgot);
});
//verify email
app.get('/verify', (req, res) =>{
    const verifyEmail = fs.readFileSync('./public/verify-email.html','utf8');
    res.send(verifyEmail);
});
//getHome
app.get('/home', (req, res) =>{
    const home = fs.readFileSync('./public/home.html', 'utf8');
    res.send(home);
});
//Robot chat
app.get('/chat', (req, res) =>{
    const chat = fs.readFileSync('./public/chatbot.html', 'utf8');
    res.send(chat);
});
//message
app.get('/message', (req, res) =>{
    const message = fs.readFileSync('./public/message.html', 'utf8');
    res.send(message);
})
//import server routes
const  signupRoute = require('./routes/signup');
const completeSignupRoute = require('./routes/complete_signup');
const signinRoute = require('./routes/signin');
const getHomeRoute = require('./routes/gethome');
const getMessageRoute = require('./routes/getMessage');
app.use('/signup', signupRoute);
app.use('/complete_signup', completeSignupRoute);
app.use('/signin', signinRoute);
app.use('/getHome', getHomeRoute);
app.use('/getMessage', getMessageRoute);
//start server
app.listen(PORT, ()=>{
    console.log('Server started at '+PORT);
});
