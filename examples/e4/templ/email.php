<!DOCTYPE html>
<html>
    <head>
        <title>Form Submission</title>
    </head>
    <body>
        <h2>Form Submission</h2>
        <table>
        <?php foreach($data["post"] as $name => $value) {?>
            <tr>
                <td><?php echo $name; ?></td>
                <td><?php echo $value ?></td>
            </tr>
        <?php } ?>
        </table>

    </body>
</html>