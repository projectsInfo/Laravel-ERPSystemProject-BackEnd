$(document).ready(function(){


        var hexDigits = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];

        function hex(x) {
            return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
        }

        //Function to convert rgb color to hex format
        function rgb2hex(rgb) {
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
        }

        

    const colors = [
        {
            name: 'black',
            color: '#000',
        },
        {
            name: 'Dark Grey1',
            color: '#484848',
        },
        {
            name: 'Dark Grey2',
            color: '#646464'
        },
        {
            name: 'Light Grey 1',
            color: '#CCCCCC'
        },
        {
            name: 'Light Grey 2',
            color: '#DDDDDD'
        },
        {
            name: 'Light Grey 3',
            color: '#E4E4E4'
        },
        {
            name: 'Light Grey 4',
            color: '#F9F5F5'
        },
        {
            name: 'Red',
            color: '#F15757'
        },
        {
            name: 'Orange',
            color: '#F18C2F'
        },
        {
            name: 'Yellow',
            color: '#FFD64A'
        },
        {
            name: 'Dark Brown 1',
            color: '#4D3311'
        },
        {
            name: 'Dark Brown 2',
            color: '#815316'
        },
        {
            name: 'Light Brown 1',
            color: '#BF863A'
        },
        {
            name: 'Light Brown 2',
            color: '#EAB268'
        }
    ];

    const colorMenu = $('.color-menu .colors');
    const colorCircle = $('#colorDropdown .color-circle');
    const colorName = $('.color-name');
    const colorTagsDiv = document.querySelector('.color-tags');
    const addColor = $('color-menu .add-color');
    const selectColor = $('.select-color');
    let colorBoxName;
    let colorBoxColor;

    colors.forEach(function(color){


        const colorItem = `<div class="w-100"><div class="color-item" style="background: ${color.color}" data-color-name="${color.name}"></div><span>${color.name}</span></div>`;
        const colorModelBody = $('.color-model-body');
        const colorBox = document.createElement('span');
        colorMenu.append(colorItem);

        colorModelBody.append(colorBox);
        colorBox.classList.add('color-box');
        colorBox.style.background = color.color;
        colorBox.setAttribute('data-color-name', color.name);

        colorBox.addEventListener('click',function(){
            const colorBoxes = $('.color-box');
            colorBoxColor = this.style.backgroundColor;
            colorBoxName = this.getAttribute('data-color-name');

            this.classList.add('selected');
            colorBoxes.not(this).removeClass('selected');

            selectColor.removeAttr('disabled');
        })
    });

    selectColor.click(function(){


        //colorBoxColor
        //colorBoxName

        const colorItem = `<span class="color-item" style="background: ${colorBoxColor}" data-color-name="${colorBoxName}"></span>`;
        colorMenu.append(colorItem);
        
        $('#allColors').modal('hide');

        // Add Color To input
        colorCircle.css('background-color', colorBoxColor);
        colorName.text(colorBoxName);

        //Add color To color Menu

        const colorTagDiv = document.createElement('div');
        const colorCircleSpan = document.createElement('span');
        const colorNameSpan = document.createElement('span');
        const deleteBtn = document.createElement('span');
        const inputHexHidden = document.createElement('input');
        const inputNameHidden = document.createElement("input");

        colorTagsDiv.append(colorTagDiv);
        colorTagDiv.classList.add('tag','color-tag');

        colorTagDiv.append(colorCircleSpan);
        colorCircleSpan.classList.add('color-circle');
        colorCircleSpan.style.background = colorBoxColor;

        colorTagDiv.append(colorNameSpan);
        colorNameSpan.classList.add('color-name');
        colorNameSpan.textContent = colorBoxName;

        colorTagDiv.append(deleteBtn);
        deleteBtn.classList.add('delete-tag');

        colorTagDiv.append(inputHexHidden);
        inputHexHidden.name = "colorHex[]";
        inputHexHidden.type = "hidden";
        inputHexHidden.value = colorBoxColor;

        colorTagDiv.append(inputNameHidden);
        inputNameHidden.name = "colorName[]";
        inputNameHidden.type = "hidden";
        inputNameHidden.value = colorBoxName;

        deleteBtn.addEventListener('click', function(){
            colorTagsDiv.removeChild(colorTagDiv);
            colorTagsDiv.removeChild(inputHexHidden);
            colorTagsDiv.removeChild(inputNameHidden);
        })
    })

    $('.color-item').click(function(){
        const colorNameItem = $(this).attr('data-color-name');
        const colorCodeItem = rgb2hex($(this).css('backgroundColor'));
        const colorTagDiv = document.createElement('div');
        const colorCircleSpan = document.createElement('span');
        const colorNameSpan = document.createElement('span');
        const deleteBtn = document.createElement('span');
        const inputHexHidden = document.createElement('input');
        const inputNameHidden = document.createElement('input');

        colorTagsDiv.append(colorTagDiv);
        colorTagDiv.classList.add('tag','color-tag');

        colorTagDiv.append(colorCircleSpan);
        colorCircleSpan.classList.add('color-circle');
        colorCircleSpan.style.background = colorCodeItem;

        colorTagDiv.append(colorNameSpan);
        colorNameSpan.classList.add('color-name');
        colorNameSpan.textContent = colorNameItem;

        colorTagDiv.append(deleteBtn);
        deleteBtn.classList.add('delete-tag');

        colorTagDiv.append(inputHexHidden);
        inputHexHidden.name = "colorHex[]";
        inputHexHidden.type = "hidden";
        inputHexHidden.value = colorCodeItem;

        colorTagDiv.append(inputNameHidden);
        inputNameHidden.name = "colorName[]";
        inputNameHidden.type = "hidden";
        inputNameHidden.value = colorNameItem;

        // Events

        deleteBtn.addEventListener('click', function(){
            colorTagsDiv.removeChild(colorTagDiv);
            colorTagsDiv.removeChild(inputHexHidden);
            colorTagsDiv.removeChild(colorNameItem);
        })
        colorCircle.css('background', colorCodeItem);
        colorName.text(colorNameItem);
    })   
})
