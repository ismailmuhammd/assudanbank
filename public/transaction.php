<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Ismail Muhammad Ahmad" />
    <meta name="title" content="Transaction on Assudan Account" />
    <meta name="description" content="Online Bank owned by Assudan Family" />
    <title>Transaction on Assudan Account</title>
    <style>
        * {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background: #eee;
        }

        .container {
            max-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #eee;
            margin: auto;
        }

        .container .header {
            display: flex;
            align-items: center;
            justify-content: space-around;
            background: #fff;
            width: min(500px, 100%);
            position: fixed;
            top: 0;
            height: 50px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .header a {
            text-decoration: none;
            color: #04aa6d;
        }

        .container .main-1 {
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            width: 95%;
            margin-top: 60px;
            padding: 5px 0;
            border-radius: 10px;
            text-transform: uppercase;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container .main-1 div {
            background: #333;
            color: #fff;
            padding: 5px;
            width: 200px;
            text-align: center;
            border-radius: 10px;
            font-size: 14px;
            font-weight: bold;
            margin: 5px 0;
        }

        .container .main-2 {
            background: rgba(40, 200, 100, 0.2);
            width: 95%;
            border-radius: 10px;
            padding: 15px;
            box-sizing: border-box;
            margin: 20px 0;
            color: #04aa6d;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container .main-3 {
            background: #fff;
            width: 95%;
            height: 150px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            position: relative;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .main-3 input {
            width: 90%;
            padding: 15px 10px;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
            border-radius: 10px;
            border: none;
            background: #eef;
        }

        .main-3 div {
            width: 90%;
        }

        .main-3 .receipt {
            font-weight: bolder;
            font-size: 20px;
        }

        .main-3 .asked {
            font-size: 12px;
            color: #666;
        }

        .container .main-4 {
            background: #fff;
            width: 95%;
            height: 200px;
            margin: 40px 0;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .main-4 .head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            width: 100%;
            box-sizing: border-box;
        }

        .main-4 .head button {
            background: none;
            border: none;
            color: #333;
            font-size: 18px;
            cursor: pointer;
        }

        .main-4 .head button:hover,
        .main-4 .head .active {
            background: none;
            border: none;
            color: #04aa6d;
            font-size: 18px;
            text-decoration: underline;
        }

        .main-4 .users {
            width: 100%;
        }

        .main-4 .user:hover {
            background: #eef;
            border-radius: 10px;
        }

        .main-4 .users .user {
            width: 100%;
            display: flex;
            align-items: center;
            /*justify-content: center;*/
            padding: 5px 15px;
            box-sizing: border-box;
            gap: 15px;
            cursor: pointer;
            margin: 20px 0;
        }

        .main-4 .users .user img {
            width: 40px;
            height: 40px;
            border-radius: 100%;
            aspect-ratio: 1/1;
        }

        .main-4 .users .user div div {
            text-transform: capitalize;
            font-size: 13px;
            cursor: pointer;
        }

        .main-4 .users .user div .name {
            font-weight: bold;
            font-size: 15px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            max-width: 230px;
        }

        .user-cont {
            background: #fff;
            width: 100%;
            max-height: 300px;
            border-radius: 10px;
            display: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .user-cont {
            width: 100%;
            position: absolute;
            top: 100%;
            left: 50%;
            translate: -50%;
        }

        .user-cont .user {
            width: 100%;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 5px 15px;
            box-sizing: border-box;
            gap: 15px;
            margin: 20px 0;
            border-radius: 10px;
            cursor: pointer;
        }

        .user-cont .user:hover {
            opacity: 0.8;
            background: #eef;
        }

        .user-cont .user img {
            width: 40px;
            height: 40px;
            border-radius: 100%;
            aspect-ratio: 1/1;
        }

        .user-cont .user div div {
            text-transform: uppercase;
            font-size: 13px;
            cursor: pointer;
        }

        .user-cont .user div .name {
            font-weight: bold;
            font-size: 15px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            max-width: 230px;
            text-transform: capitalize;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div>Transfer to Assudan account</div>
            <a href="history.php">History</a>
        </div>

        <div class="main main-1">
            <div style="text-transform:uppercase;font-size:10px;">Limited Time New Customer Offer</div>
            <div>Register & Bet</div>
            <div>Get &#8358;1000 free</div>
            <div>Only with referral code</div>
        </div>

        <div class="main-2">
            <div>&#8358; Instant, Zero issue, Free</div>
        </div>

        <div class="main-3">
            <div class="receipt">Recipient Account</div>
            <input type="tel" minlength="10" maxlength="10" placeholder="Assudan Account number/Bank No.">
            <div class="asked">Don't know the recipient's Assudan Account Number? <span style="color: #04aa6d">Ask them</span></div>

            <div class="user-cont">

            </div>

        </div>
        <div class="main-4">
            <div class="head">
                <button class="active">Recents</button>
                <button>Favourites</button>
            </div>
            <hr>
            <div class="users">
            
                <!--Some History will display here-->

            </div>
        </div>
    </div>
    <?php
     require_once "php/getTransactionDetails.php";
    ?>
    <script>
        class UserTransaction {
            constructor() {
                this.timeout = null
                this.lastHistory = null;
            }
            isConnected() {
                var result = false;
                if (window.navigator.onLine) {
                    result = true;
                } else {
                    result = false;
                }
                window.addEventListener('online', () => {
                    result = true;
                });
                window.addEventListener('offline', () => {
                    result = false;
                });
                return result;
            }

            isAccountNumber(num) {
                var regxnum = /^(\9|8|7)?[01][0-9]\d{7}$/;
                num = num.replace(/\D/, '');
                return regxnum.test(num) && num.length == 10;
            }

            result(m, fgcolor = '#000', time = 5000) {
                var con = document.querySelector('.user-cont');
                con.style.display = 'block';
                con.style.padding = '10px';
                con.innerHTML = `
                  <div style='color:${fgcolor};font-weight: bold;width:100%;text-align:center;padding:5px;'>${m}</div>
               `;
                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    con.style.display = 'none';
                }, time);
            }

            getUserAccount(userId) {
                const users = document.querySelectorAll(userId);
                users.forEach((user) => {
                    user.addEventListener('click', function(e) {
                        document.querySelector('.main-3 input').value = user.querySelector('div .account').textContent;
                        document.cookie = 'accountnumber=' + document.querySelector('.main-3 input').value + '; expires=' + new Date(Date.now() + 1000 * 60 * 60 * 100*1000) + ';path=/';
                        window.location.href = 'send.html';
                    });
                });
            }
            createHistory() {

                if (data == 'login') {
                    alert("Something is wrong login again");
                    window.location.href = "login.html";
                } else {
                    const history = data;
                    var len = history.length;
                    this.lastHistory = [history[len - 1], history[len - 2]];

                    this.lastHistory.forEach((user, i) => {
                        var historycont = document.getElementsByClassName("users")[0];
                        var namearr = user.from.split(' ');
                        var name = '';
                        for(var j = 2; j < namearr.length; j++){
                            name += ' '+namearr[j];
                        }

                        historycont.innerHTML += `
                        <div class="user">
                            <img src="${user.image}" alt="user">
                            <div>
                                <div class="name">${name}</div>
                                <div class="account">${user.accountNumber}</div>
                            </div>
                        </div>   
                       `;
                   });
                }
            }
        }
        const user = new UserTransaction();
        user.createHistory();
        //user.result('','red');

        user.getUserAccount('.user');

        document.addEventListener('click', (e) => {
            if (!document.querySelector('.user-cont').contains(e.target)) {
                document.querySelector('.user-cont').style.display = 'none';
            }
        });

        window.addEventListener('online', () => {
            user.result('Back online', 'green');
        });

        window.addEventListener('offline', () => {
            user.result('Not internet connection', 'red');
        });

        document.querySelector('.main-3 input').addEventListener('input', (e) => {
            if (user.isConnected()) {
                if (user.isAccountNumber(e.target.value)) {
                    user.result('Processing...', 'green', 500000);
                    var xhr;
                    if (window.XMLHttpRequest) {
                        xhr = new XMLHttpRequest();
                    } else {
                        xhr = new ActiveXObject('microsoft.XMLHTTP');
                    }
                    xhr.open('GET', 'php/searchAccountNumber.php?account='+document.querySelector('.main-3 input').value, true);
                    xhr.onload = (i) => {
                        if (xhr.status == 200 && xhr.readyState == 4) {
                            
                            const data = JSON.parse(i.target.response);
                            if (data[0] == 'save') {
                                document.querySelector('.user-cont').innerHTML = `
                            <div class="user">
                              <img src="${data[3]}" alt="user">
                              <div>
                                <div class="name">${data[1]}</div>
                                <div class='account'>${data[2]}</div>
                              </div>
                            </div>
                            `;
                                user.getUserAccount('.user-cont .user');
                            } else if (data == 'accountnumber') {
                                user.result('Invalid Account,This account number is not register yet', "red");
                            } else if (data =='cookie'){
                                alert('Cookie has expires login again');
                                window.location.href = 'signin.html';
                            } else if (data == 'self'){
                                user.result("You cannot make transaction to your self", '#ff9900');
                            }else{
                                user.result("Something is wrong, try again", 'red');
                            }
                        } else {
                            user.result('Something is wrong, try again', 'red');
                        }
                    }
                    xhr.send();
                } else {
                    user.result('Please enter a valid number', 'red');
                }
            } else {
                user.result('No internet connection', 'red');
            }
        });
    </script>
</body>

</html>