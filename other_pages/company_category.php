<?php
    @include '../include/config.php';
    @include '../include/function.php';
    if(isset($_GET['company_category_id'])){
        // echo $_GET['cu_cat_id'];
        $company_categoryquery = mysqli_query($conn, "SELECT * FROM `sales_company_category`  where company_category_id = " .$_GET['company_category_id']);
          $company_categorydata = mysqli_fetch_assoc($company_categoryquery);
          // echo "<script> openModalhere('customerCategoryPopup') </script>";
            }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Layout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/other_pages.css" />
    
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        #company_categoryPopup {
            display: none;
            z-index: 99;
        }
    </style>
</head>

<body class="bg-gray-100" id="body">
<?php include '../include/sidebar.php' ?>
    <?php include '../include/header.php' ?>
    <div id="mydiv" class="max-w-full mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
        <div class="bg-white shadow-sm p-4">
            <div class="flex justify-between">
                <h1 class="text-xl font-semibold">Company Category</h1>
                <button class="text-white text-sm px-4 py-2" style="background-color: #007bff;" onclick="openModalhere('company_categoryPopup')">
                    Add Company Category
                </button>
            </div>
            <div class="flex flex-wrap justify-end p-4 gap-4">
                <div class="flex bg-white text-gray-700 border rounded-sm p-2">
                    <input type="search" placeholder="Search" class="border-none outline-none" id="search-input" />
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                            stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M21.0004 21.0004L16.6504 16.6504" stroke="#8A8A8A" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <div class="overflow-x-auto">
            <table id="customerTable" class="min-w-full table-auto">
              <thead class="bg-gray-200">
                <tr>
                  <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                    #
                  </th>
                  <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                  Company Category
                  </th> 
                  <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                    Action
                  </th>
                </tr>
              </thead>

              <tbody>
                <?php  getcompany_category(); ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99;" id="company_categoryPopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create product ategory</h2>
                <svg id="closeCCategory" onclick="closeModal('company_categoryPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="product_categoryform" action="../include/function.php" id="company_categoryform">
                <div>
                    <label for="customer_type" class="text-gray-700 font-semibold">company_category</label>
                    <input type="text"  name="<?php echo  isset($_GET['company_category_id']) ?  'company_category_update' : 'company_category' ?>" id="company_category" value="<?php echo  isset($_GET['company_category_id']) ? $company_categorydata['company_category_name'] : "" ?>" placeholder="Product Category" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    <input type="hidden" name="company_category_update_id" value="<?php echo  isset($_GET['company_category_id']) ? $_GET['company_category_id'] : "" ?>" id="getcompany_category_name"  class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" 
                    onclick="savedatanow('company_categoryform','<?php echo isset($_GET['company_category_id']) ? 'company_category_update' : 'company_category' ?>')"
                   type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('company_categoryPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>


    <script src="../assets/js/script.js"></script>
    <script>
        
        $(document).ready(function() {
            if(window.location.href.includes("other_pages")) {
                const otherPages = document.querySelector(".other_pages");
                otherPages.classList.add("active");

                const Link = document.querySelector('a[href="/erp/other_pages/company_category.php"]');
                if (Link) {
                    Link.classList.add('font-bold', 'text-black');
                }
            }
        });

        function openModalhere(elementname){
            document.getElementById(elementname).style.display = 'block';
        }
        function savedatanow(formname,inputselecter) {
            var form = $("#" + formname);
            var url = form.attr('action');
            var addtext = form.find("input[name='" + inputselecter + "']");
            $.ajax({

                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
 
                    alert("Added  Successfully");
                     window.location.href = "company_category.php";
                },
                error: function(data) {
                    alert("some Error");
                }
            });
        }
    </script>
    <?php 
    if(isset($_GET['company_category_id'])){
   
        echo "<script> openModalhere('company_categoryPopup') </script>";
          }
    ?>
</body>

</html>
