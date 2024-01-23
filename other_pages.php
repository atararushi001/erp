<!DOCTYPE html>
<html lang="en">
  <?php
    require_once('include/config.php');
  ?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Layout</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

</head>

<body class="bg-gray-100">
<?php include 'include/sidebar.php' ?>
<?php include 'include/header.php' ?>

  <div id="mydiv" class="max-w-full mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
    <div class="p-4 bg-white">
        <div class="max-w-3xl flex justify-between flex-wrap gap-4">
            <div class="flex flex-col gap-6">
                <h2 class="text-2xl font-semibold text-[#031a61]">Sales</h2>
                <ul class="flex flex-col gap-4 text-[#666]">
                    <li>
                        <a href="/erp/other_pages/customer_category.php">Customer Category</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/industry.php">Industry</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/customer_type.php">Customer Type</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/source_referred_by.php">Source / Referred By</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/sales_enquiry_stage.php">Sales Enquiry Stage</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/terms_and_condition.php">Terms and Condition</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/branch_warehouse.php">Branch/Warehouse</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/mode_of_delivery.php">Mode of Delivery</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/product_category.php">Product Category</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/product_unit.php">Product List</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/material_list.php">Material</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/job_title.php">Job Title</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/department.php">Department</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/communication_preference.php">Communication Preference</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/company_category.php">Company Category</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/sales_stage.php">Sales Stage</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/sales_product_category.php">Sales Product Category</a>
                    </li>
                    <li>
                        <a href="/erp/other_pages/sales_product_group.php">Sales Product Group</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col gap-6">
                <h2 class="text-2xl font-semibold text-[#031a61]">Inventory</h2>
                <ul class="flex flex-col gap-4 text-[#666]">
                    <li>
                        <a>Product Category</a>
                    </li>
                    <li>
                        <a>Product Unit</a>
                    </li>
                    <li>
                        <a>Material</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col gap-6">
                <h2 class="text-2xl font-semibold text-[#031a61]">Purchase</h2>
            </div>
        </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/js/script.js"></script>
  

  
</body>

</html>