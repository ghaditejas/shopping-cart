<?php
$x = 1;
?>
<html>
    <head>
        <style>
            @-webkit-keyframes up {
    0%, 100% {
        transform: rotate(0);
    }
    50% {
        transform: rotate(-30deg);
    }
}
@-moz-keyframes up {
    0%, 100% {
        transform: rotate(0);
    }
    50% {
        transform: rotate(-30deg);
    }
}
@-o-keyframes up {
    0%, 100% {
        transform: rotate(0);
    }
    50% {
        transform: rotate(-30deg);
    }
}
@keyframes up {
    0%, 100% {
        transform: rotate(0);
    }
    50% {
        transform: rotate(-30deg);
    }
}
@-webkit-keyframes down {
    0%, 100% {
        transform: rotate(0);
    }
    50% {
        transform: rotate(30deg);
    }
}
@-moz-keyframes down {
    0%, 100% {
        transform: rotate(0);
    }
    50% {
        transform: rotate(30deg);
    }
}
@-o-keyframes down {
    0%, 100% {
        transform: rotate(0);
    }
    50% {
        transform: rotate(30deg);
    }
}
@keyframes down {
    0%, 100% {
        transform: rotate(0);
    }
    50% {
        transform: rotate(30deg);
    }
}
@-webkit-keyframes r-to-l {
    100% {
        margin-left: -1px;
    }
}
@-moz-keyframes r-to-l {
    100% {
        margin-left: -1px;
    }
}
@-o-keyframes r-to-l {
    100% {
        margin-left: -1px;
    }
}
@keyframes r-to-l {
    100% {
        margin-left: -1px;
    }
}
body {
    background: #000;
    overflow: hidden;
    margin: 0;
}
body .pacman:before, body .pacman:after {
    content: '';
    position: absolute;
    background: #FFC107;
    width: 100px;
    height: 50px;
    left: 50%;
    top: 50%;
    margin-left: -50px;
    margin-top: -50px;
    border-radius: 50px 50px 0 0;
    -webkit-animation: up 0.4s infinite;
    -moz-animation: up 0.4s infinite;
    -o-animation: up 0.4s infinite;
    animation: up 0.4s infinite;
}
body .pacman:after {
    margin-top: -1px;
    border-radius: 0 0 50px 50px;
    -webkit-animation: down 0.4s infinite;
    -moz-animation: down 0.4s infinite;
    -o-animation: down 0.4s infinite;
    animation: down 0.4s infinite;
}
body .dot {
    position: absolute;
    left: 50%;
    top: 50%;
    width: 10px;
    height: 10px;
    margin-top: -5px;
    margin-left: 30px;
    border-radius: 50%;
    background: #ccc;
    z-index: -1;
    box-shadow: 30px 0 0 #ccc, 60px 0 0 #ccc, 90px 0 0 #ccc, 120px 0 0 #ccc, 150px 0 0 #ccc;
    -webkit-animation: r-to-l 0.4s infinite;
    -moz-animation: r-to-l 0.4s infinite;
    -o-animation: r-to-l 0.4s infinite;
    animation: r-to-l 0.4s infinite;
}

        </style>
        <script src="<?php echo base_url(); ?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
    </head>
    <body>
        <div class="pacman"></div>
        <div class="dot"></div>
        <form  id="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="business" value="admin@merchant.com">
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="upload" value="1" />
            <input type="hidden" name="rm" value="2" />
            <input type="hidden" name="custom" value="<?php echo $order_id; ?>" />
            <?php foreach ($products as $row) { ?>
                <input type="hidden" name="<?php echo 'item_number_' . $x; ?>" value="<?php echo $x; ?>">
                <br>
                <input type="hidden" name="<?php echo 'item_name_' . $x; ?>" value="<?php echo $row['name'] ?>">
                <br>
                <input type="hidden" name="<?php echo 'qunatity_' . $x; ?>" value="<?php echo $row['quantity'] ?>">            
                <br>
                <input type="hidden" name="<?php echo 'amount_' . $x; ?>" value="<?php echo $row['amount'] ?>">
                <br>
                <?php
                $x++;
            }
            ?>
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="discount_amount" value="<?php echo $discount; ?>">
            <input type='hidden' name='notify_url' value='http://10.0.100.199/shopping-cart/home/checkout/paypal_trans'>
            <input type='hidden' name='return' value='<?php echo base_url(); ?>home/checkout/paypal_trans/<?php echo $order_id ?>'>
            <br>
            <!--<input type="submit" value="submit" />-->
        </form>
    </body>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('#paypal').submit()
            }, 10000);
        });
    </script>
</html>
