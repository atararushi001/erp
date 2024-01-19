<?php
    @include '../include/config.php';
    @include '../include/function.php';
    if(isset($_GET['cu_cat_id'])){
// echo $_GET['cu_cat_id'];
$customer_categoryquery = mysqli_query($conn, "SELECT * FROM `customer_category`  where cu_cat_id  = " .$_GET['cu_cat_id']);
  $customer_categorydata = mysqli_fetch_assoc($customer_categoryquery);
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
        #customerCategoryPopup {
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
                <h1 class="text-xl font-semibold">Customer Category</h1>
                <button class="text-white text-sm px-4 py-2" id="openCCategory" style="background-color: #007bff;" onclick="openModalhere('customerCategoryPopup')">
                    Add Customer Category
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
                  Customer Category
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

              <?php getcustomercategory();  ?>
              
                <!-- <tr>
                  <td class="px-6 py-4 whitespace-no-wrap">2</td>
                  <td class="px-6 py-4 whitespace-no-wrap">uae company</td>
                  <td class="px-6 py-4 whitespace-no-wrap">vishal trivedi</td>
                  <td class="px-6 py-4 whitespace-no-wrap">Qatar</td>
                  <td class="px-6 py-4 whitespace-no-wrap">krunal piroda</td>
                  <td class="px-6 py-4 whitespace-no-wrap">11/10/2023</td>
                  <td class="px-6 py-4 whitespace-no-wrap">
                    <button class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
                      Inactive
                    </button>
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
                    <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path
                        d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
                        stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="function.php?deletecustomer=">
                    <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path
                        d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
                        stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>
                    </a>
                  </td>
                </tr> -->
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="z-index: 99;" id="customerCategoryPopup" style="display: BLOCK;">
        <div id="cuc_popup" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create New Customer Category</h2>
                <svg id="closeCCategory" onclick="closeModal('customerCategoryPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="categoryfrom" action="../include/function.php" id="categoryfrom">
                <div>
                    <label for="customer_category_name" class="text-gray-700 font-semibold">Customer Category
                        Name</label>
                    <input type="text" name="<?php echo  isset($_GET['cu_cat_id']) ?  'customer_category_name_update' : 'customerCategory' ?>" value="<?php echo  isset($_GET['cu_cat_id']) ? $customer_categorydata['cu_cat_name'] : "" ?>" id="customer_category_name" placeholder="Customer Category Name" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    <input type="hidden" name="customer_category_name_update_id" value="<?php echo  isset($_GET['cu_cat_id']) ? $_GET['cu_cat_id'] : "" ?>" id="customer_category_name" placeholder="Customer Category Name" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                
                  </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedatanow('categoryfrom',<?php echo  isset($_GET['cu_cat_id']) ?  'customer_category_name_update' : 'customerCategory' ?>)" type="button" id="openButton" style="background-color: #007bff;"><?php echo  isset($_GET['cu_cat_id']) ?  'Edit' : 'Save' ?></button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('customerCategoryPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
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

              const Link = document.querySelector('a[href="/erp/other_pages/customer_category.php"]');
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
                    window.location.href = "customer_category.php";
                },
                error: function(data) {
                    alert("some Error");
                }
            });
        }
      
    </script>
    <?php 
    if(isset($_GET['cu_cat_id'])){
   
        echo "<script> openModalhere('customerCategoryPopup') </script>";
          }
    ?>
</body>

</html>