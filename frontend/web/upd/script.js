"use strict"

var wishlist = [];

$(function () {
    $('.tooltip').tooltip();
    //modals
    modals('dialog-download')

    //wishlist
    loadWishlist();
    if ($('#wishlist').length) {
        displayWishlist();
    }
    if ($('#countWishlist').length) {
        setCountWishlist();
    }
});

function modals(type) {
    let modalWidth = $(window).width() > 767 ? 500 : $(window).width() - 26;

    switch (type) {
        case 'share':
            $("#dialog-share").dialog({
                modal: true,
                buttons: {
                    "Закрыть": function () {
                        $(this).dialog("close");
                    }
                }
            });
            break;
        case 'cost':
            $("#dialog-cost").dialog({
                modal: true,
                width: modalWidth,
                buttons: {
                    "Отправить запрос": function () {
                        sendMail()
                    },
                    "Отмена": function () {
                        $(this).dialog("close");
                    }
                }
            });
            break;
        case 'wishlist':
            $("#dialog-wishlist").dialog({
                modal: true,
                buttons: {
                    // "Перейти в Избранное": function () {
                    //     window.location = '/whishlist/';
                    // },
                    "Закрыть": function () {
                        $(this).dialog("close");
                    }
                }
            });
            break;
        case 'dialog-download':
            $("#dialog-download").dialog({
                autoOpen: false,
                modal: true,
                buttons: {
                    // "Закрыть": function () {
                    //     $(this).dialog("close");
                    // }
                }
            });
            break;
    }
}

function sendMail() {
    let data = {
        name: $('#name').val(),
        phone: $('#phone').val(),
        email: $('#email').val(),
        adult: $('#adult').val(),
        child_1: $('#child_1').val(),
        child_2: $('#child_2').val(),
        child_3: $('#child_3').val(),
        comment: $('#comment').val()
    }
    if (checkForm(data)) {
        $.post(
            '/order/send/',
            data
        ).done((data) => {
            console.log(data)
            $('.desc_before').hide()
            $('.ui-dialog-buttonset button').eq(0).hide()
            $('.ui-dialog-buttonset button').eq(1).html('Закрыть')
            $('#sendCost .wrap_form').hide()
            $('#sendCost .success').show()
        });
    }
}

function checkForm(data) {
    let check = true;

    if (data.name.length == 0) {
        $('#name__err').show();
        check = false;
    } else {
        $('#name__err').hide();
        check = true;
    }

    if (data.email.length == 0 && data.phone.length == 0) {
        $('#email_phone__err').show();
        check = false;
    } else {
        $('#email_phone__err').hide();
        check = true;
    }

    if (data.adult.length == 0) {
        $('#adult__err').show();
        check = false;
    } else {
        $('#adult__err').hide();
        check = true;
    }

    return check;
}

function loadWishlist() {
    if (getCookie('wishlist')) {
        wishlist = JSON.parse(getCookie('wishlist'))
    }
}

function displayWishlist() {
    let wishlistEl = $('#wishlist');

    if (!wishlist.length) {
        wishlistEl.html(`
            <div>
                У вас нет избранных круизов
            </div>
        `);
    } else {
        let listWishlist = [];
        for (let wish of wishlist) {
            listWishlist.push(`<tr>
            <td>
                <a href="/cruise/${wish.id}/">${wish.title}</a>
                <div>${wish.itinerary}</div>
            </td>
            <td>
                <div>${wish.min_price}</div>
            </td>
            <td>
                <div>${wish.company}</div>
            </td>
            <td>
                <div>${wish.ship}</div>
            </td>
            <td>
                <div class="btn" onclick="rmWishlist(${wish.id})">Удалить</div><br/>                
            </td>
            </tr>`)
        }

        let strListWishlist = listWishlist.join("");

        wishlistEl.html(`
        <table class='wishlist'>
            <tr>
                <th>Название</th>
                <th>Цена от</th>
                <th>Круизная<br/> компания</th>
                <th>Лайнер</th>
                <th></th>
            </tr>
        ${strListWishlist}
        </table>
        <br/>
        <div href="#" class="btn" style="margin-bottom: 20px;" onclick="javascript:clearWishlist()">Очистить список</div>
        `);
    }
}

function setCountWishlist() {
    if (Array.isArray(wishlist)) {
        $('#countWishlist').html(wishlist.length)
    } else {
        $('#countWishlist').html("0")
    }
}

function addWishlist(cruise) {
    if (!wishlist.find(item => item.id === cruise.id)) {
        wishlist.push(cruise)
        updateWishlist()
    }
    modals('wishlist')
}

function updateWishlist() {
    setCookie('wishlist', JSON.stringify(wishlist), { 'max-age': 31104000 })
    setCountWishlist()
}

function clearWishlist() {
    wishlist = []
    updateWishlist()
    displayWishlist()
}

function rmWishlist(id) {
    let index = wishlist.findIndex(item => item.id === id)
    if (index !== undefined) {
        wishlist.splice(index, 1)
        updateWishlist()
    }
    displayWishlist()
}

function setCookie(name, value, options = {}) {
    options = {
        path: '/',
        ...options
    };

    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}

function deleteCookie(name) {
    setCookie(name, "", {
        'max-age': -1
    })
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function downloadAsPdf() {
    $('#dialog-download').dialog("open");

    var doc = new jsPDF();
    var pdf = document.querySelector('#pdf');

    Promise.all(
        [
            new Promise(function (resolve) {
                html2canvas(pdf, {
                    scale: 1
                }).then((canvas) => {
                    resolve(canvas.toDataURL('image/png'));
                });
            })
        ]).then(function (ru_text) {
            doc.addImage(ru_text[0], 'JPEG', 0, 0);

            doc.save('Круиз №' + cruise.id + '.pdf');

            setTimeout(() => {
                $("#dialog-download").dialog('close')
            }, 2000)
        });
}