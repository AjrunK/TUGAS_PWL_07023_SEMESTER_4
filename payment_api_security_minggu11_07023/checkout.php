<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-xxxxxxxxxxxxxxxxxxxx"></script>
</head>
<body>
    <button id="pay-button">Bayar!</button>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            fetch('charge.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                window.snap.pay(data.snapToken);
            });
        };
    </script>
</body>
</html>
