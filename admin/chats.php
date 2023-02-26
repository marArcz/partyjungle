<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<?php include './includes/MessageTypes.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "messages";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <a href="messages.php" class="link-light text-decoration-none">
                            <span class="card-icon card-icon-sm me-2 shadow-sm">
                                <i class="bx bx-arrow-back bx-sm"></i>
                            </span>
                        </a>
                        <p class="fs-4 fw-bold my-0"> Chat</p>
                    </div>
                    <div class="card rounded-2 border-0 shadow-sm chat-content-container">
                        <div class="card-body ">
                            <?php
                            // get information
                            $conversation_id = $_GET['conversation_id'];
                            $conversation = mysqli_query($con, "SELECT conversations.*, users.firstname,users.lastname,users.photo FROM conversations INNER JOIN users ON conversations.user_id = users.id WHERE conversations.id = $conversation_id")->fetch_assoc();
                            $user_id = $conversation['user_id'];
                            ?>

                            <div class="d-flex align-items-center ">
                                <div class="me-3">
                                    <?php
                                    if (empty($conversation['photo'])) {
                                    ?>
                                        <div class="conversation-text-photo">
                                            <span><?php echo $conversation['firstname'][0] . $conversation['lastname'][0] ?></span>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="conversation-photo" data-img="../<?php echo $conversation['photo'] ?>">
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <p class="card-text my-1 fw-bold">
                                    <?php
                                    echo $conversation['firstname'] . ' ' . $conversation['lastname']
                                    ?>
                                </p>
                            </div>
                            <hr>



                            <div class="container-fluid ">
                                <div class="chat-container">
                                    <div id="messages-box" class="messages-box">
                                     

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <form id="chat-form">
                                <div id="file-inputs-container">
                                    <input type="file" accept="image/png, image/gif, image/jpeg" multiple class="d-none" name="photo" id="chat-image-input">
                                </div>
                                <div class="send-images-container position-relative d-none" id="send-images-container">
                                    <button class="position-absolute send-images-toggler btn btn-secondary btn-sm" data-target="#send-images-container" type="button">
                                        <i class="bx bx-x"></i>
                                    </button>
                                    <div class="d-flex send-images-row mb-1 p-2 bg-light border" id="send-images-row">

                                    </div>
                                </div>
                                <textarea name="" placeholder="Type a message here" id="chat-textarea" class="form-control" rows="4"></textarea>
                                <!-- toolbar -->
                                <div class="bottom-toolbar mt-2">

                                    <div class="row">
                                        <div class="col">
                                            <!-- tools -->
                                            <ul class="nav nav-toolbar">
                                                <li class="nav-item nav-toolbar-item">
                                                    <div class="btn-group dropup">
                                                        <button type="button" class="btn btn-default btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class='bx bxs-shopping-bag-alt'></i>
                                                        </button>
                                                        <div id="chat-products-dropdown" class="dropdown-menu rounded-0 products-dropdown border-0 shadow border-top border-orange">
                                                            <!-- Dropdown menu links -->
                                                            <div class="container-fluid">
                                                                <p class="my-0"><small>Party Jungle</small></p>
                                                                <hr class="my-1">
                                                                <input type="text" id="product-search-input" class="form-control form-control-sm rounded-0 mb-2" placeholder="Search">
                                                                <div class="">
                                                                    <div id="products-dropdown-loader" class="loader d-none">
                                                                        <p class="text-orange">
                                                                            <small>Loading...</small>
                                                                        </p>
                                                                    </div>
                                                                    <ul class="list-group list-group-flush chat-products-list" id="chat-products-list">
                                                                        <li class="list-group-item chat-products-dropdown-item">
                                                                            <div class="row">
                                                                                <div class="col-auto">
                                                                                    <img src="./assets/images/ballons.png" class="img-fluid" width="30" height="30" alt="">
                                                                                </div>
                                                                                <div class="col">
                                                                                    <p class="mt-0 mb-1 col-12 text-truncate fw-bold">
                                                                                        <small>Product Name</small>
                                                                                    </p>
                                                                                    <p class="my-1 fw-light"><small>₱120</small></p>
                                                                                    <p class="my-1 text-end">
                                                                                        <button class="btn btn-sm btn-orange rounded-0 send-product" type="button">
                                                                                            <small>Send</small>
                                                                                        </button>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="list-group-item chat-products-dropdown-item">
                                                                            <div class="row">
                                                                                <div class="col-auto">
                                                                                    <img src="./assets/images/ballons.png" class="img-fluid" width="30" height="30" alt="">
                                                                                </div>
                                                                                <div class="col">
                                                                                    <p class="mt-0 mb-1 col-12 text-truncate fw-bold">
                                                                                        <small>Product Name</small>
                                                                                    </p>
                                                                                    <p class="my-1 fw-light"><small>₱120</small></p>
                                                                                    <p class="my-1 text-end">
                                                                                        <button class="btn btn-sm btn-orange rounded-0 send-product" type="button">
                                                                                            <small>Send</small>
                                                                                        </button>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="list-group-item chat-products-dropdown-item">
                                                                            <div class="row">
                                                                                <div class="col-auto">
                                                                                    <img src="./assets/images/ballons.png" class="img-fluid" width="30" height="30" alt="">
                                                                                </div>
                                                                                <div class="col">
                                                                                    <p class="mt-0 mb-1 col-12 text-truncate fw-bold">
                                                                                        <small>Product Name</small>
                                                                                    </p>
                                                                                    <p class="my-1 fw-light"><small>₱120</small></p>
                                                                                    <p class="my-1 text-end">
                                                                                        <button class="btn btn-sm btn-orange rounded-0 send-product" type="button">
                                                                                            <small>Send</small>
                                                                                        </button>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class=" list-group-item"></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="nav-item nav-toolbar-item">
                                                    <button class="btn btn-sm btn-default choose-image-toggler" id="add-image-btn" type="button">
                                                        <i class="bx bx-image"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-auto text-end">
                                            <!-- send button -->
                                            <button class="btn btn-sm btn-default " id="send-message-btn" disabled type="submit">
                                                <i class='bx bx-send fs-5 text-primary'></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php include './includes/modals/photo-modal.php' ?>
    <?php include './includes/scripts.php' ?>
    <script>
        $(function() {
            $(".conversation-photo").each((index, elem) => {
                let img = $(elem).data('img')
                $(elem).css("background-image", `url(${img})`)
            })
        })
    </script>

    <script>
        var chatImageAttachmentCounter = 0;
        var messageContents = "";
        var isMessagesLoaded = false;
        $(".chat-btn-toggler").on("click", function(e) {
            var target = $(this).data("target");
            console.log(target)
            $(target).toggleClass("open");

        })

        function updateChatsStatus() {
            axios.post("update-chats-status.php")
                .then(res => {
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

        $(function() {
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
        $("#add-image-btn").on("click", function(e) {
            $("#chat-image-input").trigger("click")
        })

        $("#chat-image-input").on("change", function(e) {
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
            $(".send-image-item-close").on("click", function(e) {
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


        $("#chat-products-dropdown").on("show.bs.dropdown", function(e) {

        })

        $(".send-images-toggler").on("click", function(e) {
            $($(this).data("target")).addClass("d-none");
            image_attachments = [];
            $("#send-images-row").html("")
        })

        $("#chat-textarea").on("keyup", function(e) {
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

        $("#chat-form").on("submit", function(e) {
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

            formData.append("user_id", "<?php echo $user_id ?>")
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


        $(".send-product").on("click", function(e) {
            let product_id = $(this).data('id');
            axios.post("send-product.php", {
                    product_id
                })
                .then(res => {
                    console.log('res: ', res)
                })
                .catch(err => {
                    console.log('error in sending product: ', err)
                })

        })

        function scrollChats() {
            $('#messages-box').animate({
                scrollTop: $('#messages-box').prop("scrollHeight")
            }, 500);
        }
        $(function() {

            setInterval(() => {
                getChats()
                    .then(res => {
                        if (messageContents != res) {
                            messageContents = res;
                            $("#messages-box").html(res);
                            scrollChats();
                            $(".conversation-photo").each((index, elem) => {
                                let img = $(elem).data('img')
                                $(elem).css("background-image", `url(${img})`)
                            })
                            $("img.view-photo").on("click", function(e) {

                                let img = $(this).attr("src");
                                $("#view-photo-modal").find("img").attr("src", img);
                                $("#view-photo-modal").modal("show");
                            })
                        }
                    })
            }, 1000)

        })

        async function getChats() {
            return $.ajax({
                url: "get-messages.php",
                method: "POST",
                data: {
                    conversation_id: "<?php echo $_GET['conversation_id'] ?>"
                },
                success: res => res,
                error: err => err
            })
        }
    </script>
</body>

</html>