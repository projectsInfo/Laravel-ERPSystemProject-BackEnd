$(document).ready(function() {
    var createUserForm = $('form.general-form');
    var CounteraddAccountInfo0 = 1;
    $('.btn-Add-Account-Info0').click(function() {
        var addNewContent = $(this).parent('.col-1').parent('.row').find('.content0');
        CounteraddAccountInfo0++;
        console.log(CounteraddAccountInfo0);
        let content0 = `<div class="row">
            <div class="col-1">
                <button type="button" class="general-btn btn-Add-Account-Info0">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="col-11">
                <div class="row">
                    <div class="col-5">
                        <input type="text" name="name[]" id="name1" class="form-control" aria-describedby="name" placeholder="">
                    </div>
                    <div class="col-12">
                        <div class="add-Account-Info1">
                            <div class="row no-gutters">
                                <div class="col-1 pt-2 pb-2">
                                    <button type="button" class="general-btn btn-Add-Account-Info1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- Start Function Here -->
                                <div class="col-11 pt-2 pb-2">
                                    <div class="add-content1">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>`;
        addNewContent.append(content0);
        
    });





    var CounteraddAccountInfo1 = 0;
    createUserForm.on('click','.btn-Add-Account-Info1', function() {
        var addNewContent = $(this).parent('.col-1').parent('.row').find('.add-content1');
        CounteraddAccountInfo1++;
        console.log(CounteraddAccountInfo1);

        let content1 = `<div class="row no-gutters">
                <div class="col-6">
                    <input type="text" name="name[]" id="name2" class="form-control" aria-describedby="name" placeholder="">
                </div>
                <div class="col-1">
                    <button type="button" class="general-btn delete-input-tree1">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="col-12">
                    <div class="content2">
                        <div class="row no-gutters">
                            <div class="col-1 pt-2 pb-2">
                                <button type="button" class="general-btn btn-Add-Account-Info2">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-11 pt-2 pb-2">
                                <div class="content3" id="content3">
                                    
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>`;
            addNewContent.append(content1);
    });

    createUserForm.on('click','.delete-input-tree1', function() {
        $('#content3 *').remove();
        console.log($('#content3'));
    });




    var CounteraddAccountInfo2 = 0;
    createUserForm.on('click','.btn-Add-Account-Info2', function() {
            
            var addNewContent = $(this).parent('.col-1').parent('.row').find('.content3');


            CounteraddAccountInfo2++;
            console.log(CounteraddAccountInfo2);

            let content2 = `<div class="row no-gutters">
            <div class="col-11">
                <div class="row no-gutters">
                    <div class="col-7">
                        <input type="text" name="name[]" id="name2" class="form-control" aria-describedby="name" placeholder="">
                    </div>
                    <div class="col-1">
                        <button type="button" class="general-btn delete-input-tree2">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-1 pt-2 pb-2">
                                <button type="button" class="general-btn btn-Add-Account-Info3">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-11 pt-2 pb-2">
                                <div class="content4" id="content4">
                                    
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>`;

        addNewContent.append(content2);


    });

    createUserForm.on('click','.delete-input-tree2', function() {
        $('#content4 *').remove();
    });

    var CounteraddAccountInfo3 = 0;

    createUserForm.on('click','.btn-Add-Account-Info3', function() {
        var addNewContent = $(this).parent('.col-1').parent('.row').find('.content4');


        CounteraddAccountInfo3++;
        console.log(CounteraddAccountInfo3);

        let content3 = `<div class="row no-gutters">
        <div class="col-11">
            <div class="row no-gutters">
                <div class="col-8">
                    <input type="text" name="name[]" id="name2" class="form-control" aria-describedby="name" placeholder="">
                </div>
                <div class="col-1">
                    <button type="button" class="general-btn delete-input-tree3">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-1 pt-2 pb-2">
                            <button type="button" class="general-btn btn-Add-Account-Info5">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="col-11 pt-2 pb-2">
                            <div class="content5" id="content5">
                                
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>`;

    addNewContent.append(content3);
    });

    createUserForm.on('click','.delete-input-tree3', function() {
        $('#content5 *').remove();
    });


    var CounteraddAccountInfo4 = 0;

    createUserForm.on('click','.btn-Add-Account-Info5', function() {
        var addNewContent = $(this).parent('.col-1').parent('.row').find('.content5');


        CounteraddAccountInfo4++;
        console.log(CounteraddAccountInfo4);

        let content4 = `<div class="row no-gutters">
        <div class="col-11">
            <div class="row no-gutters">
                <div class="col-9">
                    <input type="text" name="name[]" id="name2" class="form-control" aria-describedby="name" placeholder="">
                </div>
                <div class="col-1">
                    <button type="button" class="general-btn delete-input-tree4">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-1 pt-2 pb-2">
                            <button type="button" class="general-btn btn-Add-Account-Info6">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="col-11 pt-2 pb-2">
                            <div class="content6" id="content6">
                                
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>`;

    addNewContent.append(content4);
    });

    createUserForm.on('click','.delete-input-tree4', function() {
        $('#content6 *').remove();
    });

    var CounteraddAccountInfo5 = 0;

    createUserForm.on('click','.btn-Add-Account-Info6', function() {
        var addNewContent = $(this).parent('.col-1').parent('.row').find('.content6');
        CounteraddAccountInfo5++;
        console.log(CounteraddAccountInfo5);

        let content5 = `<div class="row no-gutters">
        <div class="col-11">
            <div class="row no-gutters">
                <div class="col-10">
                    <input type="text" name="name[]" id="name2" class="form-control" aria-describedby="name" placeholder="">
                </div>
                
                
            </div>
        </div>
    </div>`;

    addNewContent.append(content5);
    });
    // validation
    createUserForm.validate({
        rules: {
            "name[]": {
                required: true,
                number: true,
            },
        },
    });
});