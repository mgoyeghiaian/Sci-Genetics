<!DOCTYPE html>
<html>
<head>
    <title>Refunds</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Client</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Test Name</th>
                <th>Amount</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include_once 'service.php';
                $service = new Service();
                $fetch = $service->getinfos();

                foreach ($fetch as $f) {
                    echo '<tr>';
                    echo '<td>' . $f['client'] . '</td>';
                    echo '<td>' . $f['email'] . '</td>';
                    echo '<td>' . $f['mobile'] . '</td>';
                    echo '<td>' . $f['test'] . '</td>';
                    echo '<td>' . $f['amountaed'] . '</td>';
                    echo '<td>' . $f['password'] . '</td>';
                    echo '<td><a href="refundAction.php?id='.$f['infoid'].'">Refund</a></td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</body>
</html>
