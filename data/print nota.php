<html>

<head>
    <title>POS Receipt</title>
    <style>
        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }

        table {
            width: 300px;
            font-size: 15px;
            font-family: calibri;
            border-collapse: collapse;
        }

        .footer_header {
            width: 65%;
            text-align: right;
            font-family: calibri;
            font-size: 15px;
            color: black
        }

        .footer_content {
            width: 35%;
            text-align: right;
            vertical-align: center;
            font-family: calibri;
            font-size: 15px;
            color: black
        }

        .contet_numeric {
            text-align: right;
            vertical-align: center;
            font-family: calibri;
            font-size: 15px;
            color: black
        }

        .contet_text {
            vertical-align: center;
            font-family: calibri;
            font-size: 15px;
            color: black
        }
    </style>
</head>

<body>
    <center>
        <table class="tb_header" border='0'>
            <td align='CENTER' vertical-align:top>
                <span style='color:black;'><b>APOTEK GEMILANG FARMA</b></br>JL XXXXXXXXXXX XXXXXXX</span></br>
                <span style='font-size:12pt'>No . POS-xxxx, <?php
                                                            $today = date('d M Y');
                                                            echo $today;
                                                            ?></span></br>
            </td>
        </table>
        <table class="tb_content" cellspacing='0' cellpadding='0' border='0'>
            <tr align="center">
                <td width='40%' class="contet_text">Product</td>
                <td width='25%' class="contet_text">Qty</td>
                <td width='35%' class="contet_text">Total</td>
            </tr>
            <tr>
                <td colspan='3'>
                    <hr>
                </td>
            </tr>
            <tr>
                <td class="contet_text">3 WAY STOPCOCK</td>
                <td class="contet_numeric">100</td>
                <td class="contet_numeric">0,00</td>
            </tr>
            <tr>
                <td colspan='3'>
                    <hr>
                </td>
            </tr>
        </table>
        <table class="tb_foter" border='0'>
            <tr>
                <td class="footer_header">Total :</td>
                <td class="footer_content">747.500</td>
            </tr>
            <tr>
                <td class="footer_header">Cash :</td>
                <td class="footer_content">1.000.000</td>
            </tr>
            <tr>
                <td class="footer_header">Change :</td>
                <td class="footer_content">252.500</td>
            </tr></br>
            <td colspan="2" align='center'>****** THANK YOU ******</br></td>
            </tr>
        </table>
    </center>
</body>

</html>