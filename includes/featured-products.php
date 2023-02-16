 <!-- featured -->
 <?php
    // get featured products
    $query = mysqli_query($con, "SELECT * FROM products WHERE is_featured = 1");
    if ($query->num_rows > 0) {
    ?>
     <section class="featured-products mb-4">
         <div class="container py-3">
             <div class="card rounded-0 border-0 shadow-sm">
                 <div class="card-body">
                     <p class="fs-3 mt-3 border-bottom border-orange border-2 pb-3">Featured Products</p>
                     <div class="row gx-1 gy-3">
                         <?php
                            while ($row = $query->fetch_assoc()) {
                            ?>
                             <div class="col-6 col-lg-2">
                                 <a href="product-details.php?id=<?php echo $row['id'] ?>" class="">
                                     <div class="card product-card rounded-0 position-relative">
                                         <img src="<?php echo $row['photo'] ?>" class="card-img-top rounded-0 img-thumbnail" alt="...">
                                         <div class="card-body py-1">
                                             <div class="row">
                                                 <div class="col-12 text-truncate product-name">
                                                     <?php echo $row['product_name'] ?>
                                                 </div>
                                             </div>
                                             <!-- <p class="product-name my-0"><?php echo $row['product_name'] ?></p> -->
                                             <div class="d-flex">
                                                 <p class="my-1 product-price">
                                                     P.<?php echo $row['price'] ?>
                                                 </p>
                                             </div>
                                         </div>

                                         <div class="position-absolute product-footer start-0 w-100 text-center p-1">
                                             <p class="my-1">
                                                 <small>View Product</small>
                                             </p>
                                         </div>
                                     </div>
                                 </a>
                             </div>
                         <?php
                            }
                            ?>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 <?php
    }
    ?>