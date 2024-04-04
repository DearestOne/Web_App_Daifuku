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
    </style>
</head>
<body style="background-image: url(daismall.png);
    background-attachment: fixed;
    background-repeat: repeat-x;
    background-size: 30ch 20ch;">
    <img src="GalaxyDai.PNG" class="center" width="650">
    <form action="">
        <table align="center">
        <tr>
            <td style="font-size: 5ch; text-align: center;">Menu_ID</td>
            <td style="font-size: 5ch; text-align: center;">Menu_Name</td>
            <td style="font-size: 5ch; text-align: center;">Fill_ID</td>
            <td style="font-size: 5ch; text-align: center;">Strawbery&Flour_ID</td>
            <td style="font-size: 5ch; text-align: center;">Stock</td>
            <td style="font-size: 5ch; text-align: center;">ADD Stock</td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit" class="next"></input>
    <a href="adminOrder.php"><button class="next" align="center" style="margin-left: 45%; margin-top: 3%;border:5px solid black; color: black;">Check Order</button></a>
    </form>
    
</body>
</html>