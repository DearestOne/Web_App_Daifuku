<?php
    // header("Refresh: 10");
    require("connection.php");
    if(isset($_POST['submit'])){
        $order_finish = $_POST['serve'];
        foreach($order_finish as $rows){
            $u_order = "update Orders set served = 1 where order_id = $rows";
            $conn->query($u_order);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShopOrder</title>
    <link rel="stylesheet" href="design.css">
    <style>
        table{
            border: 0.5ch solid black;
            width: 70%;
            font-family: sans-serif;
            border-collapse: collapse;
        }
        th,td{
            border: 2px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body style="background-image: url(daismall.png);
    background-attachment: fixed;
    background-repeat: repeat-x;
    background-size: 30ch 20ch;">
    <img src="GalaxyDai.PNG" class="center" width="650">
    <form action="<?php $_PHP_SELF ?>" method="post">
    <table align='center'>
        <tr>
            <td style="font-size: 5ch; text-align: center;">ID</td>
            <td style="font-size: 5ch; text-align: center;">Order</td>
            <td style="font-size: 5ch; text-align: center;">Quantity</td>
            <td style="font-size: 5ch; text-align: center;">Already</td>
        </tr>
        <?php
            $s_order_no_serve = "select order_id from Orders where served = 0 group by order_id;";
            $order_no_serve = $conn->query($s_order_no_serve);
            foreach($order_no_serve as $rows){
                $current_forder = $rows['order_id'];
                $s_count = "select count(order_id) as count from Order_Details where order_id = $current_forder";
                $count = $conn->query($s_count);
                $count_detail = array();
                foreach($count as $rows2){
                    $count_detail[] = $rows2['count'];
                }
                echo "<tr><td rowspan=$count_detail[0] style='font-size: 3.5ch; text-align: center;background-color: white;'>".$current_forder."</td>";
                $s_datail = "select order_id,m.menu_name,quantity,order_price
                                from Order_Details od
                                join Menu m on m.menu_id = od.menu_id
                                where order_id = $current_forder
                                order by m.menu_id asc;";
                $detail = $conn->query($s_datail);
                $alredy = false;
                foreach($detail as $rows2){
                    echo "<td style='font-size: 3.5ch; text-align: center;background-color: white;'>".$rows2['menu_name']."</td>";
                    echo "<td style='font-size: 3.5ch; text-align: center;background-color: white;'>".$rows2['quantity']."</td>";
                    if($alredy == false){
                        echo "<td rowspan=$count_detail[0] style='font-size: 3.5ch; text-align: center;background-color: white;'><input style='width: 40px;
                        height: 40px;' type='checkbox' name='serve[]' value='$current_forder'></input></td>";
                        $alredy = true;
                    }
                    echo "</tr>";
                }
            }
        ?>
    </table>
    <input type="submit" name="submit" value="submit"></input>
    </form>
</body>
</html>
