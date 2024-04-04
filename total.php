<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <title>Total</title>
    <style>
        table{
            border: 0.5ch solid black;
            width: 50%;
            font-family: sans-serif;
        }
        hr.new1 {
            width: 80%;
            border-top: 5px solid black;
            margin-block: 5%;
        }
    </style>
</head>
<body style="background-image: url(daismall.png);
    background-attachment: fixed;
    background-repeat: repeat-x;
    background-size: 30ch 20ch;">
    <img src="GalaxyDai.PNG" class="center" width="650">

    <?php
        if($_GET['submit']){
            $Dname = array("Redbean","Matcha","Chocolate");
            $Sname = array("S","M","L","XL");
            $Dbase = array(30,40,50,55);
            $total_price = 0;

            require('connection.php');
            $sql_stock = "select stock from Menu order by menu_id asc;";
            $sql_selected = $conn->query($sql_stock);
            $sql_selected_array = array();
            foreach($sql_selected as $rows){
                $sql_selected_array[] = $rows['stock'];
            }

            $pass = true;
            session_start();
            $_SESSION['Daifuku'] = $_GET['Daifuku'];
            $order = $_GET['Daifuku'];
            for($i=0; $i<12; $i++){
                if($order[$i] > 0){
                    $name = $Dname[$i/4];
                    $size = $Sname[$i%4];
                    if($order[$i] > $sql_selected_array[$i]){
                        $pass = false;
                        if($sql_selected_array[$i] == 0){
                            echo "Sorry, ".$name." ".$size." is out of stock.";
                        }
                        else{
                            echo "Sorry, ".$name." ".$size." is not enough for your order. max ".$sql_selected_array[$i];
                        }
                    }
                    $base = $Dbase[$i%4];
                    $total_price += ($order[$i]*$base);
                }
            }
            
            if($total_price == 0){
                echo "<script> alert('please order something'); </script>";
                echo "<a href='order.html'><button class='go_back' style='margin-left: 46%; margin-right: 44%; display:block;'> go back </button></a>";
                session_unset();
                session_destroy();
            }
            else if($pass == false){
                echo "<br>please try again.";
                echo "<a href='order.html'><button class='go_back' style='margin-left: 46%; margin-right: 44%; display:block;'> go back </button></a>";
                session_unset();
                session_destroy();
            }
            else{
                echo "<table align='center'>
                        <tr>
                            <td colspan=3 style='font-size: 5ch; background-color: white;' align='center'>
                                Total
                            </td>
                        </tr>
                        <tr>
                            <td style='font-size: 5ch;'>Name</td>
                            <td style='font-size: 5ch;text-align: center;'>Qty.</td>
                            <td style='font-size: 5ch;text-align: center;'>Price</td>
                        </tr>";
                for($i=0; $i<12; $i++){
                    if($order[$i] > 0){
                        $base = $Dbase[$i%4];
                        $size = $Sname[$i%4];
                        $name = $Dname[$i/4];
                        echo "<tr>";
                        echo "<td style='font-size:3ch'>Daifuku Strawbery<ul><li>".$name." ".$size."</li></ul></td>";
                        echo "<td style='font-size:3ch;text-align:center;'>$order[$i]</td>";
                        echo "<td style='font-size:3ch;text-align:center;'>".($order[$i]*$base)."</td>";
                        echo "</tr>";
                    }
                }
                $_SESSION['total_price'] = $total_price;
                echo "<td colspan=3><hr class='new1'></td>";
                echo "<tr><td colspan=2 style='text-align:center;font-size:3ch'>TOTAL</td><td style='font-size:3ch'>$total_price</td></tr>";
                echo "<tr><td colspan=3><img src='/QrToPay.PNG' style='width: 40%; border: 2ch solid white; border-radius: 3ch; margin-left: auto; margin-right: auto; margin-top: 7ch; display: block;'></td></tr></table>";

                echo "<a href='firstPage.html'><button class='cancel' style='float: left; margin-top:7ch'> CANCEL ORDER </button></a>";
                echo "<a href='reciept.php'><button class='confirm' style='float: right; margin-top:7ch'> CONFIRM </button></a>";
            }
        }
    ?>
    
    
</body>
</html>
