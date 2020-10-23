$(document).ready(function() {
        // const variables of btns
        const addClientAddressBtn = $('.add-client-address-btn');
        const addClientPhoneBtn = $('.add-client-phone-btn');
        const addClientPhoneInfo = $('.add-client-phone-info');
        const addClientAddressInfo = $('.add-client-address-info');
        let form = $('.general-form');
        var array_ids_deleted_when_update = {
            address: [],
            mobile: []
        };
        // event add Client address input field
        var AddClientAddressCounter = 0;
        function AddClientAddress() {
            AddClientAddressCounter++;
            if (AddClientAddressCounter >= 5) {
                AddClientAddressCounter--;
            } else  {
                let input = `
                    <div class='row'>
                        <div class='col-9'>
                            <input type='hidden' name='addressId[]' value='0'>
                            <textarea name='address[]' id="address${AddClientAddressCounter}" class='form-control mt-2 textAreaHeight' placeholder='Client Address'></textarea>
                        </div>
                        <div class='col-3'>
                            <span id_delete='0' class='general-btn danger d-inline-block mt-2'><i class='fas fa-times'></i></span>
                        </div>
                    </div>
                `;
    
                addClientAddressInfo.append(input).find('textarea').focus();
            }
        }
        
        addClientAddressBtn.on('click', AddClientAddress);
    
        form.on('click', '.add-client-address-info span', function () {
            $(this).parent().parent().remove();
            AddClientAddressCounter--;
            var address = $(this).attr('id_delete');
            if (address != 0) {
                array_ids_deleted_when_update.address.push(address);
                console.log(array_ids_deleted_when_update.address);
            }
        });
    
    
        // event add Client phone input field
    
        var AddClientPhoneCounter = 0;
        
        function AddClientPhone() {
            AddClientPhoneCounter++;
            if (AddClientPhoneCounter >= 5) {
                AddClientPhoneCounter--;
            } else if (AddClientPhoneCounter < 5) {
                let input = `
                    <div class='row'>
                        <div class='col-9'>
                            <input type='hidden' name='mobileId[]' value='0'>
                            <input type='text' name='mobile[]' id=phone${AddClientPhoneCounter} class='form-control mt-2' placeholder='Client Phone'>
                        </div>
                        <div class='col-3'>
                            <span id_delete='0' class='mt-2 danger d-inline-block general-btn'><i class='fas fa-times'></i></span>
                        </div>
                    </div>
                `;
                addClientPhoneInfo.append(input).find('input[type="text"]').focus();
            }
        }
    
    
        
        addClientPhoneBtn.on('click', AddClientPhone);
    
        form.on('click', '.add-client-phone-info span', function () {
            $(this).parent().parent().remove();
            AddClientPhoneCounter--;
            var mobile = $(this).attr('id_delete');
            if (mobile != 0) {
                array_ids_deleted_when_update.mobile.push(mobile);
                console.log(array_ids_deleted_when_update.mobile);
            }
        });
});