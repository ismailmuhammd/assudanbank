<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Ismail Muhammad Ahmad">
    <meta name="title" content="Assudan Bank Transaction Verification">
    <meta name="description" content="Assudan Bank Transaction Verification">
    <meta name="keywords" content="Assudan, Transaction, remarks">
    <title>Assudan Bank Transaction Verification</title>
    <style>
        * {
            font-family: sans-serif;
            box-sizing: border-box;
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
            padding: 0 10px;
            z-index: 1;
        }

        .main-1 {
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

        .main-1 #user {
            font-size: 14px;
            font-weight: bold;
            max-width: 95%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .main-1 #amount {
            font-size: 30px;
            font-weight: bolder;
        }

        .main-1 #status {
            color: #04aa6d;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .main-1 #statusImg {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            zoom: 1.5;
            aspect-ratio: 1/1;
        }

        .main-1 .img {
            width: 40px;
            height: auto;
            position: absolute;
            top: 5%;
            left: 50%;
            translate: -50% -50%;
            border-radius: 50%;
            aspect-ratio: 1/1;
            z-index: 0;
        }

        .main-2 {
            background: #fff;
            width: 95%;
            border-radius: 10px;
            margin: 20px 0;
            padding: 10px;
        }

        .main-2 div {
            width: 100%;
            font-weight: bold;
            font-size: 17px;
            margin: 10px 0;
        }

        .main-2 table {
            width: 100%;
            border-spacing: 0 15px;
        }

        .main-2 table tr th {
            font-size: 14px;
            text-align: right;
        }

        .main-2 table tr td {
            font-size: 15px;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <?php
require("php/verifyTransaction.php");
if (isset($_GET["password"]) && isset($_GET["accountnumber"]) && isset($_GET["transID"]))
{
    $password = trim($_GET["password"]);
    $accountnumber = $_GET["accountnumber"];
    $transID = $_GET["transID"];
    if (password_verify($transaction_password,$password))
    {
        //$db = new mysqli($servername, $serverusername, $serverpassword, $serverdatabase);
        if ($db->connect_error)
        {
            die($db->connect_error);
        }
        else
        {
            $sql = $db->prepare("SELECT folder FROM account WHERE accountnumber = ?;");
            $sql->bind_param("s",$accountnumber);
            $sql->execute();
            $result = $sql->get_result();
if (!$sql){
   echo($db->error);
}
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc()["folder"];
                $file = file($row);
                foreach ($file as $data)
                {
                    $data = json_decode($data);
                    if ($data->transactionid === $transID)
                    {
                        ?>
    <div class="container">
        <div class="header">
            <div>Assudan Transaction Verification</div>
        </div>
        <div class="main-1">
            <div id="user"><?php echo $data->from; ?></div>
            <div id="amount">&#8358;<?php echo number_format($data->amount, 2); ?> </div>
            <div id="status">
                <img src="svg/good.svg" alt="Status Logo" id="statusImg">
                <span>Verified Successful</span>
            </div>
            <img src="assudan.jpg" alt="Assudan Logo" class="img">
        </div>
        <div class="main-2" id="main-2">
            <div>Transaction Details</div>
            <table border="0">
                <tr>
                    <td rowspan="2">Sender Details</td>
                    <th id="tuser"><?php echo $data->user;
                        ?></th>
                </tr>
                <tr>
                    <th id="tnumber">Assudan | <?php echo $data->accountNumber;
                        ?> </th>
                </tr>
                <tr>
                    <td>Transaction Type</td>
                    <th id="tfrom"><?php echo $data->from;
                        ?></th>
                </tr>
                <tr>
                    <td>Transaction No.</td>
                    <th id="tid"><?php echo $data->transactionid;
                        ?></th>
                </tr>
                <tr>
                    <td>Credited to</td>
                    <th>Wallet</th>
                </tr>
                <tr>
                    <td>Transaction Date</td>
                    <th id="tdate"><?php echo $data->date;
                        ?></th>
                </tr>
            </table>
        </div>
    </div>
    <?php
                        break;
                    }
                    else
                    {
                        continue;
                    }
                }
            }else{
    echo "Hi";
}
        }
    }
    else
    {
        echo "Invalid Barcode scanned!";
    }
}
else
{
    echo "Please the code again";
}
?>
</body>

</html>