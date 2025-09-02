<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Ismail Muhammad Ahmad">
    <meta name="title" content="Transaction History">
    <meta name="description" content="History of Assudan Bank Transaction">
    <meta name="keywords" content="Date, Transaction">
    <title>Transaction History</title>
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
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            background: #fff;
            width: min(500px, 100%);
            position: fixed;
            top: 0;
            padding: 5px;
            height: 90px;
        }

        .header .h {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            padding: 0 10px;
        }

        .header .h a {
            text-decoration: none;
            color: #04aa6d;
            cursor: pointer;
        }

        .container .header .h button {
            padding: 10px 30px;
            border: none;
            margin: 5px 0;
            width: 49%;
            white-space: nowrap;
            border-radius: 10px;
            background: #f5f5f9;
        }

        .main {
            width: 95%;
            background: #fff;
            padding: 10px;
            margin-top: 10px;
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

        hr {
            border: 1px solid #eee;
        }

        .tcon {
            display: flex;
            width: 100%;
            padding: 4px 0;
            align-items: center;
            justify-content: center;
            transition: background 0.5s linear;
        }
        .tcon:hover{
            background: #eee;
        }
        .main .history {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 100%;
        }

        .tcon img {
            width: 40px;
            width: 40px;

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
            overflow: hidden;
            max-width: 60%;
        }

        #from {
            max-width: 100%;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        #time {
            font-size: 10px;
            color: #999;
            font-weight: normal;
        }

        .hmess div {
            font-size: 13px;
            font-weight: bold;
        }

        .hstatus {
            max-width: 39%;
            overflow: hidden;
        }

        .hstatus div:nth-child(1) {
            font-weight: bold;
            max-width: 100%;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .hstatus .status {
            color: #04aa6d;
            background: rgba(200, 200, 200, 0.2);
            padding: 2px;
            border-radius: 30px;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="h">
                <div>Transaction</div>
                <a>Download</a>
            </div>

            <div class="h">
                <button>All Categories</button>
                <button>All status</button>
            </div>
        </div>

        <div style="width: 100%;height: 80px;"></div>


    </div>
    <?php
      require('php/getTransactionDetails.php');
    ?>
    <script>
        function groupDataByDate() {
            var keys = [];
            //data = data.reverse();
            var groupData = data.reduce((acc, item) => {
                var key = getDate(item.date);
                if (!acc[key]) {
                    acc[key] = [];
                    keys.push(key);
                }
                acc[key].push(item);
                return acc;
            }, {});
            for (const key in groupData) {
                var moneyIn = 0;
                var moneyOut = 0;
                document.querySelector('.container').innerHTML += `
                <div class="main">
                  <div class="head">
                     <div class="time${key}"></div>
                     <div>
                        <div id="moneyIn${key}">In &#8358;0.00</div>
                        <div id="moneyOut${key}">Out &#8358;0.00</div>
                     </div>
                  </div>
                  <hr>
        
                  <div class="${key}">
        
               </div>
        
              </div>
             `;

                groupData[key].forEach((a) => {
                    document.querySelector("." + key).innerHTML += `
                    <div class="tcon">
                       <img src="${a.image}" alt="">
                       <div class="historyB">
                       <div class="hmess">
                           <div id="from">${a.from}</div>
                           <div id="time">${a.date}</div>
                       </div>
                       <div class="hstatus">
                           <div>${a.tmode == 'in' ? '+' : '-'}&#8358;${parseFloat(a.amount).toLocaleString('en-NG',{minimumFractionDigits:2,maximumFractionDigits:2})}</div>
                           <div class="status">Successful</div>
                      </div>
                     </div>
                   </div>
                   `;
                    a.tmode == 'in' ? moneyIn+=a.amount : moneyOut+=a.amount;
                    document.querySelector("#moneyIn"+key).innerHTML = 'In: &#8358;'+parseFloat(moneyIn).toLocaleString('en-NG',{minimumFractionDigits:2,maximumFractionDigits:2});
                    document.querySelector("#moneyOut"+key).innerHTML = 'Out: &#8358;'+parseFloat(moneyOut).toLocaleString('en-NG',{minimumFractionDigits:2,maximumFractionDigits:2});
                    document.querySelector('.time' + key).innerHTML = `<div class='time' style='margin:0;'>${setDate(a.date)}</div>`;
                });
            }
        }

        function getDate(date) {
            var d = date.replace(',', ' ');
            d = d.split(' ');

            return d[0] + d[2];
        }

        function setDate(date) {
            var d = date.replace(',', ' ');
            d = d.split(' ');

            return d[0] + " " + d[2];
        }
        //click give cookie
        function viewHistoryInfo(){
            var userHistory = document.querySelectorAll('.tcon');
            userHistory.forEach((e,i)=>{
                e.onclick = ()=>{
                    const transactionid = data[i].transactionid;
                    document.cookie = "transactionid="+transactionid+";expires="+new Date(Date.now()+100*60*60*24)+";path=/;";
                    window.location.href = "transferDetails.php";
                }
            });
        }
        //click download keep of last transaction id
        function downloadReciept(){
            var userHistory = document.querySelector('.header a');
            userHistory.onclick = function(){
                const transactionid = data[0].transactionid;
                document.cookie = "transactionid="+transactionid+";expires="+new Date(Date.now()+100*60*60*24)+";path=/;";
                window.location.href = "transferDetails.php";
            }
        }
        //Call function group By Date
        groupDataByDate();
        //call Function
        viewHistoryInfo();
        //Click and download Reciept
        downloadReciept();
    </script>

</body>

</html>