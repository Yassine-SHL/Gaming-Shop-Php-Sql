<?php
if(isset($_SESSION['connexion'])){
?>
<div id="paypal-button-container" style="width:100%;"></div>
<?php
}
$mttc=$_SESSION['mttc'];
?>
<script src="https://www.paypal.com/sdk/js?client-id=AXY8w_CBmdgfeM76Yhj6j3USfUOcCnfXYlpRQCNZRgcvDMVCp9kmysc9_Nt_TeINBC12rpjk-PJxEOBL&components=buttons"></script>





<script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?= $mttc; ?>.toFixed(2) // Montant à payer
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Paiement effectué avec succès par ' + details.payer.info.email);
                });
            }
        }).render('#paypal-button-container');
</script>