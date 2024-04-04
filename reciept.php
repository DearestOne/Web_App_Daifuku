<?php
    session_start();
    $order = $_SESSION['Daifuku'];
    $total = $_SESSION['total_price'];
    require('connection.php');

    $c_order = "insert into orders(sum_price) value ($total);";
    $conn->query($c_order);
    $s_order = "select order_id from orders order by order_id desc limit 1";
    $curr_order = $conn->query($s_order);
    $current_order = array();
    foreach($curr_order as $row){
        $current_order[] = $row['order_id'];
    }
    for($i=0;$i<12;$i++){
        if($order[$i] > 0){
            $c_order_detail = "insert into order_details(order_id,menu_id,quantity,order_price)
                                value ($current_order[0],
                                $i,
                                $order[$i],
                                $order[$i]*(select price from straw_flour where sf_id = $i%4));";
            $c_del_ingre = "update menu
                            set stock = stock - $order[$i]
                            where menu_id = $i;";
            $conn->query($c_order_detail);
            $conn->query($c_del_ingre);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <title>reciept</title>
    <style>
        td,th{
            color: black;
            border: 1px solid black;
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
    <table align="center" style="width: 30%; font-family: sans-serif;">
        <tr>
            <td colspan="3" style="font-size: 5ch;" align="center">
                DAIFUKU 🍓<br>
                <p style="font-size: 1.3ch;margin: 0%;">Tel. 064-07xxxxx</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-size: 3ch;">Order ID:</td>
            <?php
                echo "<td style='font-size: 3ch;text-align: right;'>$current_order[0]</td>";
            ?>
            
        </tr>
        <tr>
            <td colspan="2" style="font-size: 3ch;">Date/Time:</td>
            <?php
                $s_datetime = "select order_date from orders where order_id = $current_order[0];";
                $datetime = $conn->query($s_datetime);
                $datetime_array = array();
                foreach($datetime as $rows){
                    $datetime_array[] = $rows['order_date'];
                }
                echo "<td style='font-size: 3ch;text-align: right;'>".$datetime_array[0]."</td>";
            ?>
        </tr>
        <tr>
            <td colspan="3">
                <hr class="new1">
            </td>
        </tr>
        <tr>
            <td style="font-size: 3ch;text-align: left;">Name</td>
            <td style="font-size: 3ch;text-align: right;">Qty.</td>
            <td style="font-size: 3ch;text-align: right;">Price</td>
        </tr>
        <?php
            $s_all = "select order_id,m.menu_name,quantity,order_price
                        from order_details od
                        join menu m on m.menu_id = od.menu_id
                        where order_id = $current_order[0]
                        order by m.menu_id asc;";
            $result = $conn->query($s_all);
            foreach($result as $rows){
                echo "<tr>";
                echo "<td style='font-size: 3ch;text-align: left;'>".$rows['menu_name']."</td>";
                echo "<td style='font-size: 3ch;text-align: right;'>".$rows['quantity']."</td>";
                echo "<td style='font-size: 3ch;text-align: right;'>".$rows['order_price']."</td>";
                echo "</tr>";
            }
        ?>
        <tr>
            <td colspan="3">
                <hr class="new1">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-size: 3ch;text-align: left;">Total</td>
            <?php
            echo "<td style='font-size: 3ch;text-align: right;'>".$total."฿</td>";
            
            ?>
        </tr>
        <tr>
            <td colspan="3">
                <hr class="new1">
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-size: 5ch;" align="center">
                🙏🏻THANK YOU🙏🏻<br>
                <p style="font-size: 1.3ch;margin: 0%;">Glad To See You Again!</p>
            </td>
        </tr>
    </table>
</body>
</html>