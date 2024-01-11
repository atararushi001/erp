<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Layout</title>
  <?php include '../include/script.php' ?>
</head>

<body class="bg-gray-100">
  <?php include '../include/sidebar.php' ?>
  <?php include '../include/header.php' ?>
  
  <div id="mydiv" class="max-w-7xl mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
    <div class="flex justify-between p-4">
      <h1 class="text-xl font-semibold">Master Product Category List</h1>
      <a href="add_sales_enquiry.html"><button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">
          Add Category
        </button></a>
    </div>
    <div class="flex justify-end p-4 gap-4">
      <div>
        <input type="datetime-local" class="border rounded-sm text-gray-700 outline-none p-2" />
      </div>
      <div class="flex bg-white text-gray-700 border rounded-sm p-2">
        <input type="search" placeholder="Search" class="border-none outline-none" id="search-input" />
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
            stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M21.0004 21.0004L16.6504 16.6504" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </div>
    </div>
  </div>
  <script src="../assets/js/script.js"></script>
  <script>
    $(document).ready(function() {
          
      if(window.location.href.includes("product")) {
        const product = document.querySelector(".product");
        product.classList.add("active");

        const customerLink = document.querySelector('a[href="/erp/product/category.php"]');
        if (customerLink) {
          customerLink.classList.add('font-bold', 'text-black');
        }
      }
    });

  </script>
</body>

</html>