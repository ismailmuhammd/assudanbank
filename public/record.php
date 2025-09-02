<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Ismail Muhammad Ahmad">
    <meta name="title" content="User Records">
    <meta name="description" content="User Record Assudan Account">
    <title>User Records</title>
    <style>
        body {
            background: #eee;
        }

        * {
            font-family: sans-serif;
            box-sizing: border-box;
        }

        .container {
            background: #eee;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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
        }

        .container .header div {
            width: 100%;
            padding: 0 20px;
        }

        .main {
            width: 95%;
            background: #fff;
            padding: 10px;
            margin-top: 70px;
            border-radius: 10px;
        }

        .head div {
            padding: 2px;
            margin: 3px;
        }

        .head .time {
            font-size: 22px;
            font-weight: bold;
        }

        .tcon {
            display: flex;
            width: 100%;
            padding: 5px 0;
            align-items: center;
            justify-content: space-around;
            transition: background 1s ease;
        }
        
        .tcon:hover{
            background: rgba(0,200,100,0.2);
        }

        hr {
            border: solid 1px #eee;
        }

        .history {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .tcon img {
            width: 40px;
            width: 40px;
            border-radius: 50%;
        }

        .historyB {
            display: flex;
            width: 80%;
            align-items: center;
            justify-content: space-between;
            height: 50px;
        }

        .hmess {
            margin-left: 2px;
            max-width:60%;
        }

        .hmess div {
            font-size: 13px;
            font-weight: bold;
            max-width:100%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow:hidden;
        }
        
        .hstatus{
            max-width: 35%;
            overflow: hidden;
        }

        .hstatus div{
            font-weight: bold;
            max-width: 100%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow:hidden;
        }

        .hstatus .status {
            color: #04aa6d;
            background: rgba(200, 200, 200, 0.2);
            padding: 2px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: normal;
            display: grid;
            place-items: center;
        }

        .footer {
            font-size: 13px;
            padding: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div>Records</div>
        </div>

        <div class="main">
            <div class="head">
                <div class="time">2025</div>
                <div>
                    <div id="moneyin">In &#8358;0.00</div>
                    <div id="moneyout">Out &#8358;300.00</div>
                </div>
            </div>
            <hr>

            <div id="record">
               <div style="color:#aaa;text-align: center; padding:20px;" id='notfound'>
                 No Record Found
               </div>
            </div>

            <hr>
            <div class="footer">
                Only transactions made within the past 1 year are displayed
            </div>
        </div>
        
    </div>
    <!------Require PHP File------->
    <?php
     require_once "php/getTransactionDetails.php";
    ?>
    <script>
    ////Get the stored cookie
    function getCookie(){
        var cookies = document.cookie.split('; ');
        var numbercookie = cookies.find(cookie => cookie.startsWith('accountNumber='));
        var accountNumber = numbercookie ? numbercookie.split('=')[1] : null;
        return accountNumber;
    }
    ////Set History
    var currentHistory = [];
    function setHistory(){
        const accountNumber = getCookie();
        var moneyIn = 0.00;
        var moneyOut = 0.00;
        var recentDate = [];
        //data = data.reverse();
        data.forEach((a,i)=>{
            if(a.accountNumber == accountNumber){
                document.getElementById('notfound').style.display = 'none';
                document.getElementById('record').innerHTML+=`
                <div class="tcon">
                    <img src="${a.image}" alt="Transaction Record">
                    <div class="historyB">
                        <div class="hmess">
                            <div>${a.from}</div>
                            <div>${a.date}</div>
                        </div>
                        <div class="hstatus">
                            <div class="amount">${a.tmode == 'in'? '+':'-'}&#8358;${a.amount}</div>
                            <div class="status">Successful</div>
                        </div>
                    </div>
                </div>`;
                if(a.tmode == 'in'){
                    moneyIn+=a.amount;
                }else{
                    moneyOut+=a.amount;
                }
                currentHistory.push(data[i]);
            }
        
        });
        document.getElementById('moneyin').innerHTML = "In: &#8358;"+parseFloat(moneyIn).toLocaleString('en-NG',{
            minimumFractionDigits:2,
            maximumFractionDigits:2
        });
        document.getElementById('moneyout').innerHTML = "Out: &#8358;"+parseFloat(moneyOut).toLocaleString('en-NG',{
            minimumFractionDigits:2,
            maximumFractionDigits:2
        });
    }
    //Click and view more information
    function viewHistoryInfo(){
        var userHistory = document.querySelectorAll('#record .tcon');
        userHistory.forEach((e,i)=>{
            e.onclick = ()=>{
                const transactionid = currentHistory[i].transactionid;
                document.cookie = "transactionid="+transactionid+";expires="+new Date(Date.now()+100*60*60*24)+";path=/;";
                window.location.href = "transferDetails.php";
            }
        });
    }
    setHistory();
    viewHistoryInfo();
    </script>
</body>

</html>