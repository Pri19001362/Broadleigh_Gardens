<?php 

require_once './include/functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $name = InputProcessor::processString($_POST['Name'] ?? '');
    $description = InputProcessor::processString($_POST['Description'] ?? '');
    $category = InputProcessor::processString($_POST['Category'] ?? '');
    $price = InputProcessor::processString($_POST['Price'] ?? '');
    $image = InputProcessor::processFile($_FILES['Image'] ?? []);

    $valid =  $name['valid'] && $description['valid'] && $category['valid'] && $price['valid'] && $image['valid'];

    if($valid) {

      $image['value'] = ImageProcessor::upload($_FILES['Image']);
      
      $args = ['Name' => $name['value'] , 
              'Description' => $description['value'] , 
              'Category' => $category['value'] ,
              'Price' => $price['value'] ,
              'Image' =>  $image['value'] 
              ];

      $id = $controllers->products()->create_product($args);

      if(!empty($id) && $id > 0) {
        redirect('product', ['id' => $id]);
      }
      else {
        $message = "Error adding product."; //Change
      }
    }
    else {
       $message =  "Please fix the following errors: ";
   }

} 


?>

  <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
    <section class="vh-100">
      <div class="container py-5 h-75">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
    
                <h3 class="mb-2">Add Product</h3>
                <div class="form-outline mb-4">
                  <input type="text" id="name" name="Name" class="form-control form-control-lg" placeholder="Name" required value="<?= htmlspecialchars($name['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $name['error'] ?? '' ?></span>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" id="description" name="Description" class="form-control form-control-lg" placeholder="Description" required value="<?= htmlspecialchars($description['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $description['error'] ?? '' ?></span>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" id="category" name="Category" class="form-control form-control-lg" placeholder="Category" required value="<?= htmlspecialchars($category['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $category['error'] ?? '' ?></span>
                </div>
    
    
                <div class="form-outline mb-4">
                  <input type="number" id="price" name="Price" class="form-control form-control-lg" placeholder="Price" required value="<?= htmlspecialchars($price['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $price['error'] ?? '' ?></span>
                </div>
    
                <div class="form-outline mb-4">
                  <input type="file" accept="Image/*" id="image" name="Image" class="form-control form-control-lg" placeholder="Select Image"required />
                </div>
    
                <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Add Product</button>
               
                <?= isset($_GET['errmsg']) ? $message = $_GET['errmsg'] : '' ?>

                <div class="alert alert-danger mt-4" role="alert">
                  <?= $message ?? '' ?>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
