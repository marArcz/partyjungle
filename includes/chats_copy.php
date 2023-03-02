<?php
if (Session::getUser() != null) {
?>
    <div class="chat-container" id="chat-container">
        <button data-target="#chat-container" class="chat-button btn btn-orange chat-btn-toggler">
            <i class='bx bxs-conversation'></i>
            <span>Chat</span>
        </button>
        <div class="chat-content-container shadow border rounded-1 card">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col-md">
                        <p class="my-1 text-orange">Chat</p>
                    </div>
                    <div class="col-md text-end">
                        <button data-target="#chat-container" type="button" class="btn btn-default btn-sm chat-btn-toggler">
                            <i class='bx bx-chevron-down-square'></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body messages-box" id="messages-box">
               
            </div>
            <div class="card-footer bg-light">
                <form id="chat-form">
                    <div id="file-inputs-container">
                        <input type="file" accept="image/png, image/gif, image/jpeg" multiple class="d-none" name="photo" id="chat-image-input">
                    </div>
                    <div class="send-images-container position-relative d-none" id="send-images-container">
                        <button class="position-absolute send-images-toggler" data-target="#send-images-container" type="button">
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
<?php
}
?>