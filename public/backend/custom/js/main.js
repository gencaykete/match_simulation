$(function () {
    $(".phone-mask").mask("0999 999 99 99");
    $(".tc-mask").mask("99999999999");
    $('.loader').hide();
    $('.select2').select2({
        theme: 'bootstrap4',
        //closeOnSelect: false
    });
    $('[data-bs-toggle="tooltip"]').tooltip();
    runTinymceEditor()
})

function formatPrice(price) {
    // Price'i ondalık hanelere ayrıştır
    const parts = price.toFixed(2).toString().split('.');

    // Binler basamakları için virgül ekleyin
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    // Virgülle ayrılmış binler basamakları ve iki ondalık hane ile biçimlendirilmiş fiyatı döndür
    return parts.join('.');
}

$(document).on('change', '.ajax-switch', function () {
    let model = $(this).data('model')
    let column = $(this).data('column')
    let id = $(this).val()
    let value = $(this).is(':checked') ? 1 : 0

    $.ajax({
        url: ajax_urls.updateFeaturedUrl,
        type: "POST",
        data: {
            "_token": csrf_token,
            'id': id,
            'value': value,
            'model': model,
            'column': column,
        },
        success: function (res) {
            /*Swal.fire({
                icon: res.status,
                text: res.text ? res.text : res.message,
            })*/
        }
    });
})


function areYouSure(url, text = "Bu veriyi silmek istediğinize emin misiniz?", method = '') {
    Swal.fire({
        title: 'İşlemi Onaylayın',
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet',
        cancelButtonText: 'İptal',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    "_token": csrf_token,
                    '_method': method
                },
                success: function (res) {
                    Swal.fire({
                        icon: res.status,
                        text: res.text ? res.text : res.message,
                    })
                    if (res.status === 'success') {
                        table.ajax.reload(null, false);
                    }
                }
            });
        }
    })
}

$(document).on('click', '.delete-btn', function (e) {
    e.preventDefault();
    let url = $(this).attr('href');
    let text = $(this).attr('alert-text');
    areYouSure(url, text, 'delete');
})

$('#cities').on('change', function () {
    let city_key = $(this).val();
    getDistricts('#districts', city_key);
})

$('#categories').on('change', function () {
    let category_id = $(this).val();
    getCategoryBranches('#branches', category_id);
})

function getDistricts(container, city_key, active_key = 0) {
    $.ajax({
        url: "/ajax/get-districts",
        type: "post",
        data: {
            "_token": csrf_token,
            "city_key": city_key
        },
        dataType: "json",
        success: function (res) {
            $(container).html("<option></option>");
            $.each(res, function (key, value) {
                $(container).append("<option " + (active_key == value.key ? 'selected' : '') + " value='" + value.key + "'>" + value.name + "</option>");
            })
        }
    });
}

function getCategoryBranches(container, category_id, active_key = 0) {
    $.ajax({
        url: "/ajax/get-category-branches",
        type: "post",
        data: {
            "_token": csrf_token,
            "category_id": category_id
        },
        dataType: "json",
        success: function (res) {
            $(container).html("<option></option>");
            $.each(res, function (key, value) {
                $(container).append("<option " + (active_key == value.id ? 'selected' : '') + " value='" + value.id + "'>" + value.name + "</option>");
            })
        }
    });
}

function confirmToSweetAlert(text, url) {
    Swal.fire({
        title: 'İşlemi Onaylayın',
        html: text,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet',
        cancelButtonText: 'Hayır',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url
        }
    })
}

const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

function runTinymceEditor(){
    tinymce.init({
        selector: '.tinymce',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        editimage_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ]
    });
}

let timeout = 0;

$(document).on('click', '.decrease-btn', function () {
    let el = $(this);
    if (parseInt(el.next('input').val()) - 1 >= 0) {
        el.next('input').val(parseInt(el.next('input').val()) - 1)
    }
})

$(document).on('click', '.increase-btn', function () {
    let el = $(this);
    el.prev('input').val(parseInt(el.prev('input').val()) + 1)
})

$(document).on('mousedown touchstart', '.decrease-btn', function (e) {
    let el = $(this);

    timeout = setInterval(function () {
        if (parseInt(el.next('input').val()) - 1 >= 0) {
            el.next('input').val(parseInt(el.next('input').val()) - 1)
        }
    }, 100);
}).bind('mouseup mouseleave touchend', function () {
    $(this).removeClass('active');
    clearInterval(timeout)
});

$(document).on('mousedown touchstart', '.increase-btn', function (e) {
    let el = $(this);

    timeout = setInterval(function () {
        el.prev('input').val(parseInt(el.prev('input').val()) + 1)
    }, 100);
}).bind('mouseup mouseleave touchend', function () {
    $(this).removeClass('active');
    clearInterval(timeout)
});


