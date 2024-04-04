<?php
    require("connection.php");
    if(isset($_POST['submit'])){
        $insert_array = $_POST['insert'];
        for($i=0;$i<12;$i++){
            $u_stock = "update Menu set stock = stock + $insert_array[$i] where menu_id = $i;";
            $conn->query($u_stock);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddStock</title>
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
        input[type=number] {
            height: 3ch;
            font-size: 1.5ch;
        }
    </style>
</head>
<body style="background-image: url(daismall.png);
    background-attachment: fixed;
    background-repeat: repeat-x;
    background-size: 30ch 20ch;">
    <img src="GalaxyDai.PNG" class="center" width="650">
    <form action="<?php $_PHP_SELF ?>" method="post">
        <table align="center">
        <tr>
            <td style="font-size: 5ch; text-align: center;">Menu_ID</td>
            <td style="font-size: 5ch; text-align: center;">Menu_Name</td>
            <td style="font-size: 5ch; text-align: center;">Fill_ID</td>
            <td style="font-size: 5ch; text-align: center;">Strawbery&Flour_ID</td>
            <td style="font-size: 5ch; text-align: center;">Stock</td>
            <td style="font-size: 5ch; text-align: center;">ADD Stock</td>
        </tr>
        <?php
            $s_all_stock = "select * from Menu order by menu_id;";
            $all_stock = $conn->query($s_all_stock);
            foreach($all_stock as $rows){
                $curr = $rows['menu_id'];
                echo "<tr>";
                echo "<td style='font-size: 5ch; text-align: center; background-color: white;'>".$curr."</td>";
                echo "<td style='font-size: 5ch; text-align: center; background-color: white;'>".$rows['menu_name']."</td>";
                echo "<td style='font-size: 5ch; text-align: center; background-color: white;'>".$rows['fill_id']."</td>";
                echo "<td style='font-size: 5ch; text-align: center; background-color: white;'>".$rows['sf_id']."</td>";
                echo "<td style='font-size: 5ch; text-align: center; background-color: white;'>".$rows['stock']."</td>";
                echo "<td style='font-size: 5ch; text-align: center; background-color: white;'><input type='number' name='insert[]' min=0 value=30 max=100></input></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <input type="submit" name="submit" value="submit" class="next"></input>
    <a href="adminOrder.php"><button class="next" align="center" style="margin-left: 45%; margin-top: 3%;border:5px solid black; color: black;">Check Order</button></a>
    </form>
    
</body>
</html>
