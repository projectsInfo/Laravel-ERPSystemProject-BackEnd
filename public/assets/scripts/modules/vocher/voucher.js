$(document).ready(function() {
    function randomPassword(length) {
        const Array = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP";
        let pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * Array.length);
            pass += Array.charAt(i);
        }
        return pass;
    }

    const generateBarcodeBtn = $('#generateBarcode');
    generateBarcodeBtn.on('click', function() {
        
        const voucherBarcodeInput = $('.voucher-barcode-input');
        voucherBarcodeInput.val(randomPassword(6));
    });

});


