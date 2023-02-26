var chatImageAttachmentCounter = 0;
var messageContents = "";
var isMessagesLoaded = false;
$(".chat-btn-toggler").on("click", function (e) {
    var target = $(this).data("target");
    console.log(target)
    $(target).toggleClass("open");

})

function updateChatsStatus(){
    axios.post("update-chats-status.php")
    .then(res=>{
        console.log('res: ', res)
    })
}

async function loadChatProducts() {
    const filter = $("#product-search-input").val();
    return (
        $.ajax({
            url: "get-products.php",
            method: "get",
            data: {
                filter
            },
            dataType: 'json',
            success: res => res,
            error: err => err
        })
    )
}

function createProductItem(product) {
    var productElem = `
                                                    <li class="list-group-item chat-products-dropdown-item">
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="${product.photo}" class="img-fluid" width="30" height="30" alt="">
                                                            </div>
                                                            <div class="col">
                                                                <p class="mt-0 mb-1 col-12 text-truncate fw-bold">
                                                                    <small>${product.product_name}</small>
                                                                </p>
                                                                <p class="my-1 fw-light"><small>₱${product.price}</small></p>
                                                                <p class="my-1 text-end">
                                                                    <button class="btn btn-sm btn-orange rounded-0 send-product" type="button">
                                                                        <small>Send</small>
                                                                    </button>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
    `

    return productElem;
}

$(function () {
    $("#chat-products-list").html("")
    loadChatProducts()
        .then(res => {
            console.log("products: ", res)
            for (let product of res.products) {
                var productElem = createProductItem(product);
                $("#chat-products-list").append(productElem);
            }
        })
        .catch(err => console.log('error: ', err))
})
var image_attachments = [];
$("#add-image-btn").on("click", function (e) {
    $("#chat-image-input").trigger("click")
})

$("#chat-image-input").on("change", function (e) {
    let files = e.target.files;
    for (let file of files) {
        let imgUrl = URL.createObjectURL(file)
        let imageItem = `<div class="send-image-item p-2">
                             <button data-index="${chatImageAttachmentCounter}" class="btn shadow-sm btn-sm btn-default send-image-item-close" type="button">
                                    <i class='bx bxs-x-circle'></i>
                             </button>
                             <img data-index="${chatImageAttachmentCounter}" src="${imgUrl}" class="img-thumbnail send-image-img" alt="">
                         </div>`
        $("#send-images-row").append(imageItem);
        image_attachments.push({
            index: chatImageAttachmentCounter,
            file
        });
        chatImageAttachmentCounter++;
    }
    console.log('attachments; ', image_attachments)
    if (files.length > 0) {
        $("#send-images-container").removeClass("d-none")
        $("#send-message-btn").removeAttr("disabled");

    }
    $(".send-image-item-close").on("click", function (e) {
        console.log('close')
        let item = $(this).parent();
        let index = $(this).data('index');
        image_attachments = image_attachments.filter((val, i) => val.index != index);
        item.remove();
        console.log("attachments: ", image_attachments)
        var textArea = $("#chat-textarea");

        if (image_attachments.length == 0) {
            $("#send-images-container").addClass("d-none")
            if (textArea.val().length == 0 || textArea.val() == " " || textArea.val() == "") {
                $("#send-message-btn").attr("disabled", true);
            }
        }
    })
});


$("#chat-products-dropdown").on("show.bs.dropdown", function (e) {

})

$(".send-images-toggler").on("click", function (e) {
    $($(this).data("target")).addClass("d-none");
    image_attachments = [];
    $("#send-images-row").html("")
})

$("#chat-textarea").on("keyup", function (e) {
    var textArea = $(this);
    console.log('textarea val: ', textArea.val())
    if (textArea.val().length > 0 && textArea.val() != " " && textArea.val() != "") {
        $("#send-message-btn").removeAttr("disabled")
    } else {
        if (image_attachments.length == 0) {
            $("#send-message-btn").attr("disabled", true)
        }

    }
})

$("#chat-form").on("submit", function (e) {
    e.preventDefault();
    var textArea = $("#chat-textarea")
    if (image_attachments.length == 0) {
        if (textArea.val().length == 0 && textArea.val() == " " && textArea.val() == "") {
            return;
        }

    }

    $("#send-message-btn").attr("disabled", true)
    var photos = [];
    var formData = new FormData();

    for (let image of image_attachments) {
        formData.append("photos[]", image.file);
    }
    var textArea = $("#chat-textarea")
    if (textArea.val().length > 0 && textArea.val() != " " && textArea.val() != "") {
        formData.append("message", textArea.val());
    }
    const config = {
        headers: {
            'content-type': 'multipart/form-data'
        }
    }
    // axios send chat
    axios.post("send-chat.php", formData, config)
        .then(res => {
            textArea.val("")
            if (image_attachments.length > 0) {
                $(".send-images-toggler").trigger("click")
            }
            $("#send-message-btn").removeAttr("disabled")
            console.log('res in sending message: ', res)
        })
        .catch(err => {
            textArea.val("")
            $("#send-message-btn").removeAttr("disabled")
            console.error("error sending message: ", err)
        })
})


$(".send-product").on("click", function (e) {
    let product_id = $(this).data('id');
    axios.post("send-product.php",{product_id})
    .then(res=>{
        console.log('res: ', res)
    })
    .catch(err=>{
        console.log('error in sending product: ', err)
    })

})

function scrollChats() {
    $('#messages-box').animate({ scrollTop: $('#messages-box').prop("scrollHeight") }, 500);
}
$(function () {

    setInterval(() => {
        getChats()
            .then(res => {
                if (messageContents != res) {
                    messageContents = res;
                    $("#messages-box").html(res);
                    scrollChats();

                }
            })
    }, 1000)

})

async function getChats() {
    return $.ajax({
        url: "get-messages.php",
        method: "POST",
        success: res => res,
        error: err => err
    })
}