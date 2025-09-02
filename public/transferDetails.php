<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Ismail Muhammad Ahmad">
    <meta name="title" content="Assudan Bank Transaction History">
    <meta name="description" content="Assudan sent | received History">
    <meta name="keywords" content="Assudan, Transaction, remarks">
<link rel="icon" href="images/assudan.jpg">
    <title>Assudan Bank Transaction History</title>
    <style>
        *{
            font-family: sans-serif;
            box-sizing: border-box;
        }
        body {
            background: #eee;
        }
        .container{
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
            justify-content: space-between;
            background: #fff;
            width: min(500px, 100%);
            position: fixed;
            top: 0;
            height: 50px;
            padding:0 10px;
            z-index:1;
        }
        .header img{
            width: 40px;
            height: auto;
            border-radius: 50%;
        }
        .main-1{
            width: 95%;
            background: #fff;
            margin-top: 60px;
            border-radius: 10px;
            position: relative;
            padding: 40px 10px 10px 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            height: 150px;
        }
        .main-1 #user{
            font-size: 14px;
            font-weight: bold;
            max-width: 95%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
        .main-1 #amount{
            font-size: 30px;
            font-weight: bolder;
        }
        .main-1 #status{
            color: #04aa6d;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .main-1 #statusImg{
            width: 10px;
            height: 10px;
            border-radius: 50%;
            zoom: 1.5;
            aspect-ratio: 1/1;
        } 
        .main-1 .img{
            width: 40px;
            height: auto;
            position: absolute;
            top:5%;
            left:50%;
            translate: -50% -50%;
            border-radius: 50%;
            aspect-ratio: 1/1;
            z-index: 0;
        }
        .main-2{
            background: #fff;
            width: 95%;
            border-radius: 10px;
            margin: 20px 0;
            padding: 10px;
        }
        .main-2 div{
            width: 100%;
            font-weight: bold;
            font-size: 17px;
            margin: 10px 0;
        }
        .main-2 table{
            width: 100%;
            border-spacing: 0 15px;
        }
        .main-2 table tr th{
            font-size:14px;
            text-align: right;
        }
        .main-2 table tr td{
            font-size:15px;
            white-space: nowrap;
        }
        .main-3{
            background: #fff;
            width: 95%;
            border-radius: 10px;
            padding: 20px 10px;
            margin-bottom: 80px;
        }
        
        .main-3  .head{
            width: 100%;
            margin: 10px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2px;
        }
        
        .main-3 .foot{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px 2px;
        }
        .main-3 .foot a{
            text-decoration: none;
            color: #04aa6d;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }
        .footer{
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eee;
            width: min(500px, 100%);
            position: fixed;
            bottom: 0;
            height: 70px;
            z-index:1;
            padding-bottom: 5px;
        }
        .footer button{
            background: #04aa6d;
            border: none;
            color: #fff;
            font-size: 18px;
            width: 70%;
            border-radius: 20px;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header">
           <div>Transaction Details</div> 
           <img src="svg/ai.svg" alt="Help" onclick="window.location.href='chatbot.html'">
        </div>
        
        <div class="main-1">
            <div id="user">Transfer</div>
            <div id="amount">&#8358;0.00</div>
            <div id="status">
                <img src="svg/good.svg" alt="Status Logo" id="statusImg">
                 <span>Successful</span>
            </div>
            <img src="assudan.jpg" alt="Assudan Logo" class="img">
        </div>
           
        <div class="main-2" id="main-2">
            <div>Transaction Details</div>
            <table border="0">
                <tr>
                    <td rowspan="2">Sender Details</td>
                    <th id="tuser"></th>
                </tr>
                <tr>
                    <th id="tnumber">Assudan | </th>
                </tr>
                
                <tr>
                    <td>Transaction Type</td>
                    <th id="tfrom">Transfer from Assudan Account</th>
                </tr>
                
                <tr>
                    <td>Transaction No.</td>
                    <th id="tid"></th>
                </tr>
                
                <tr>
                    <td>Credited to</td>
                    <th>Wallet</th>
                </tr>
                
                <tr>
                    <td>Transaction Date</td>
                    <th id="tdate"></th>
                </tr>
            </table>
        </div>
        
        <div class="main-3">
            <div>More Actions</div>
            <div class="head">
                <div>Category</div>
                <div>Transfer</div>
            </div>
            <hr>
            <div class="foot">
                <a href="send.html">Transfer Back</a>
                <a href="record.php">View Records</a>
            </div>
        </div>
        
        <div class="footer">
            <button onclick="window.location.href='php/downloadReciept.php'" target="_blank">Share Receipt</button>
        </div>
        
    </div>
    <?php
     require_once "php/getTransactionDetails.php";
    ?>
    <script>
    
    function getCookie(){
        var cookies = document.cookie.split('; ');
        var transactioncookie = cookies.find(cookie => cookie.startsWith('transactionid='));
        var transactionid = transactioncookie ? transactioncookie.split('=')[1] : null;
        return transactionid;
    }
    
    function setData(){
        const transactionid = getCookie();
        data.forEach((a,i)=>{
            if(a.transactionid == transactionid){
                document.querySelector('#user').textContent = a.from;
                document.querySelector('#amount').textContent = '₦'+parseFloat(a.amount).toLocaleString('en-NG',{minimumFractionDigits:2,maximumFractionDigits:2});
                document.querySelector("#tuser").textContent = a.user.toUpperCase();
                document.querySelector("#tnumber").innerHTML =`Assudan | ${a.accountNumber}`;
                document.querySelector("#tfrom").textContent = a.from;
                document.querySelector("#tid").textContent = a.transactionid;
                document.querySelector("#tdate").textContent = a.date;
                document.cookie = "accountNumber="+a.accountNumber+";expires="+new Date(Date.now()+100*60*60*24)+";";
            }
        });
    }
    setData();
    </script>
</body>
</html>