

<style>
h1{
    
    /* font-size: 80px */
}
@media print{
    /* h1:nth-child(1){
        padding-top : 9mm
    } */
    h1{
        page-break-after: always;
    }
    /* h1:nth-child(3n){
        page-break-after: always;
    } */
}
</style>

<?php 
foreach ($Products as $Product) {
    # code...
    echo '<h1>'.DNS1D::getBarcodeSVG($Product->barcode, "C39",1,36).'</h1>';
}
?>
