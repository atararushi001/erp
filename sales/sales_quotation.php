
<?php
 
    @include '../include/function.php';
    ?>  
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
  <div id="mydiv" class="max-w-full mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
    <div class="bg-white shadow-sm p-4">
      <div class="flex justify-between">
        <h1 class="text-xl font-semibold">Sales Quotation</h1>
        <a href="add_sales_quotation.php"><button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">
            Add Quotation
          </button></a>
      </div>
      <div class="flex flex-wrap justify-end p-4 gap-4">
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
      <div class="overflow-x-auto">
        <table id="salesQuotationTable" class="min-w-full table-auto">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                #
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Quotation Number
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
              Company name
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
              Contact Name
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Creator
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Created Date
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Valid Till
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Version
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Status
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
              
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Action
              </th>
            </tr>
          </thead>

          <tbody>
       
          <?php
          getsales_quotation()
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
  <script src="../assets/js/script.js"></script>
  <script>
    $(document).ready(function() {
        $('#salesQuotationTable').DataTable();

        if(window.location.href.includes("sales")) {
          const sales = document.querySelector(".sales");
          sales.classList.add("active");

          const customerLink = document.querySelector('a[href="/erp/sales/sales_quotation.php"]');
          if (customerLink) {
            customerLink.classList.add('font-bold', 'text-black');
          }
        }
    });
  </script>
</body>

</html>