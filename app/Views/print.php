<html>
<head>
    <title>Document</title>
    <style type="text/css">
        table, tr, td {
            border: 1px solid;
            padding: 5px;
        }

        table
        {
            table-layout: fixed;
            width: 100px;
            word-wrap:break-word;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .text-small {
            font-size: 8pt;
        }

        .table-header {
            background-color: grey;
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }

        #footer {
            position: fixed;
            right: 0px;
            bottom: 10px;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid black;
        }

        #footer .page:after {
            content: counter(page, decimal);
        }

        @page {
            margin: 20px 30px 40px 50px;
        }
    </style>
</head>
<body>
    <table>
        <tr class="table-header text-small">
            <?php for($i = 0; $i < $col_length; $i++): ?>
            <?php if ($data[0][$i] === null) continue; ?>
            <td class="text-small"><?php echo $data[0][$i]; ?></td>
            <?php endfor ?>
        </tr>
        <?php for($x = 1; $x < $row_length; $x++): ?>
        <tr class="text-small">
            <?php for($y = 0; $y < $col_length; $y++): ?>
            <?php if ($data[0][$y] === null) continue; ?>
            <td class="text-small;"><?php echo $data[$x][$y]; ?></td>
            <?php endfor ?>
        </tr>
        <?php endfor ?>
    </table>

    <div id="footer page-break">
        <p class="page">Page </p>
    </div>
</body>
</html>