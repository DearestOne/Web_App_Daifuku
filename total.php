<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <title>Total</title>
    <style>
        table{
            border: 0.75ch solid black;
            width: 50%;
        }
    </style>
</head>
<body style="background-image: url(/daismall.png);
    background-attachment: fixed;
    background-repeat: repeat-x;
    background-size: 30ch 20ch;">
    <img src="/GalaxyDai.PNG" class="center" width="650">
    <table align="center">
    <tr>
        <td colspan=3 style="font-size: 5ch; background-color: white;" align="center">
            Total
        </td>
    </tr>
        <tr id="nqp">
            <td style="font-size: 5ch;">Name</td>
            <td style="font-size: 5ch;text-align: center;">Qty.</td>
            <td style="font-size: 5ch;text-align: center;">Price</td>
        </tr>
        <tr>
            <?php
                if($_GET['submit']){
                    session_start();
                    $_SESSION['Daifuku'] = $_GET['Daifuku'];
                    $order = $_GET['Daifuku'];
                    $Dname = array("Redbean","Matcha","Chocolate");
                    $Sname = array("S","M","L","XL");
                    $Dbase = array(30,40,50,55);
                    $total_price = 0;
                    for($i=0; $i<12; $i++){
                        if($order[$i] > 0){
                            $base = $Dbase[$i%4];
                            $size = $Sname[$i%4];
                            $name = $Dname[$i/4];
                            echo "<tr>";
                            echo "<td>Daifuku Strawbery<ul><li>".$name." ".$size."</li></ul></td>";
                            echo "<td>$order[$i]</td>";
                            echo "<td>".($order[$i]*$base)."</td>";
                            echo "</tr>";
                            $total_price += ($order[$i]*$base);
                        }
                    }
                    if($total_price == 0){
                        echo "<script> alert('please order something') </script>";
                    }
                    else{
                        echo "<tr><td colspan=2 style='text-align:center;'>TOTAL</td><td>$total_price</td></tr>";
                    }
                }
            ?>
        </tr>
    </table>
    
</body>
</html>
