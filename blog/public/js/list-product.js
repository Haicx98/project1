var deleteId = '';
$('.btn-delete').click(function () {
    deleteId = $(this).attr("id").replace('delete-', '');
    var name = $('#name-' + deleteId).text();
    name = "Sản phẩm với tên là: '" + name + "'";
    $('#modalContent').text(name);
    $('#exampleModal').modal('show');
});
$('#btnConfirmDelete').click(function () {
    $.ajax({
        type: 'DELETE',
        url: '/products/' + deleteId,
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
        success: function () {
            $('#messageSuccess').text('Action success!');
            $('#exampleModal').modal('hide');
            $('#messageSuccess').removeClass('d-none');
            $('#' + deleteId).hide();
        },
        error: function () {
            $('#messageError').removeClass('d-none');
            $('#messageError').text('Action fails! Please try again later!');
            $('#exampleModal').modal('hide');
        }
    });
});

// Quick edit.
// var arrayBtnQuickEdit = document.getElementsByClassName('btn-quick-edit');
// for (var i = 0; i < arrayBtnQuickEdit.length; i++) {
//     arrayBtnQuickEdit[i].onclick = function () {
//         alert(1);
//     };
// }
$('.btn-quick-edit').click(function () {
    var currentId = $(this).closest('tr').attr('id');
    getCurrentInformation2(currentId);
});

$('#formUpdate').submit(function (event) {
    var id = $('#idUpdate').val();
    $.ajax({
        method: 'put',
        url: '/products/' + id,
        data: $('#formUpdate').serialize(),
        success: function (resp) {
            $('#messageSuccess').text('Action success!');
            $('#editModal').modal('hide');
            $('#messageSuccess').removeClass('d-none');
            $('#nameUpdate').val("");
            $('#idUpdate').val("");
            $('#imageUpdate').val("");
            $('#descriptionUpdate').val("");
            $('#priceUpdate').val("");

            //update infor table
            console.log('tr#' + id + ' > td.product-name');
            console.log($('tr#' + id + ' > td.product-name').text());
            $('tr#' + id + ' > td.product-name').text(resp.name);
            $('tr#' + id + ' > td.product-description').text(resp.description);
            $('tr#' + id + ' > td.product-price').text(resp.price);
            $('#editModal').modal('hide');
        },
        error: function () {
            $('#messageError').removeClass('d-none');
            $('#messageError').text('Action fails! Please try again later!');
        }
    });
    event.preventDefault();
});

function getCurrentInformation2(id) {
    $.ajax({
        method: 'get',
        url: '/products/json/' + id,
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (resp) {
            var name = resp.name;
            var description = resp.description;
            var price = resp.price;
            var imgUrl = resp.img_url;
            $('#idUpdate').val(id);
            $('#imageUpdate').val(imgUrl);
            $('#nameUpdate').val(name);
            $('#descriptionUpdate').val(description);
            $('#priceUpdate').val(price);
            $('#editModal').modal('show');
        },
        error: function () {
            $('#messageError').removeClass('d-none');
            $('#messageError').text('Action fails! Please try again later!');
        }
    });
}

$('#checkAll').click(function () {
    if ($(this).prop('checked')) {
        $('.check-item').prop('checked', true);
    } else {
        $('.check-item').prop('checked', false);
    }
});

$('.check-item').click(function () {
    if (!$(this).prop('checked')) {
        $('#checkAll').prop('checked', false);
    }
});

$('#btnApply').click(function () {
    var action = $('#actionSelectAll').val();
    switch (action) {
        case "0":
            alert('Please choose an action.');
            break;
        case "1":
            deleteCheckedItem();
            break;
        case "2":
            anotherAction();
            break;
        default:
            break;
    }
});

function deleteCheckedItem() {
    var checkedIds = [];
    $('.check-item:checked').each(function (index) {
        checkedIds.push($(this).val());
    });
    if (checkedIds.length == 0) {
        alert('Please choose atleast 1 item.');
        return;
    }
    if (confirm('Are you sure want to delete these products?')) {
        $.ajax({
            method: 'post',
            url: '/products/destroy-many',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'ids': checkedIds
            },
            success: function (resp) {
                $('#messageSuccess').text('Action success!');
                $('#messageSuccess').removeClass('d-none');
                // Mong muốn gọi lên sv 1 lần nữa để lấy danh sách mới.
                for (var i = 0; i < checkedIds.length; i++) {
                    $('#' + checkedIds[i]).remove();
                }
                // Kiểm tra lại số lượng bản ghi, hoặc reload.
                if($('.check-item').length == 0){
                    setTimeout(function(){
                        window.location.reload(1);
                    }, 3*1000);
                }
            },
            error: function () {
                $('#messageError').removeClass('d-none');
                $('#messageError').text('Action fails! Please try again later!');
            }
        });
    }


}

function anotherAction() {
    alert('Other action.');
}