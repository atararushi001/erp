<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Layout</title>
    <?php include '../include/script.php' ?>
    
    <style>
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin-top: 0.5rem;
            position: relative;
            vertical-align: middle;
        }
    </style>

    <script>
        $(document).ready(function () {
            $("#select_category").select2({
                width: '100%',
                placeholder: 'Select Category',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' style='background-color: #007bff;'>Add Category</button>");
                    }
                }
            });
            $("#select_material").select2({
                width: '100%',
                placeholder: 'Add Material',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' style='background-color: #007bff;'>Add Material</button>");
                    }
                }
            });
            $("#select_unit").select2({
                width: '100%',
                placeholder: 'Add Unit',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' style='background-color: #007bff;'>Add Unit</button>");
                    }
                }
            });
        })
    </script>

</head>

<body class="bg-gray-100">
    <?php include '../include/sidebar.php' ?>
    <?php include '../include/header.php' ?>

    <div id="mydiv" class="max-w-full mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
        <div class="mb-3">
            <h1 class="text-xl font-semibold text-custom-blue">Add Master Product</h1>
        </div>
        <div>
            <div class="bg-white rounded-sm shadow-md mb-4">
                <div class="w-full border-b">
                    <h2 class="text-gray-800 font-semibold p-4 text-lg">General Information</h3>
                </div>
                <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                    <div>
                        <label for="part_number" class="text-gray-700 font-semibold">Part number</label>
                        <input type="text" id="part_number" placeholder="Part number"
                            class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="product_code" class="text-gray-700 font-semibold">Product Code</label>
                        <input type="text" id="product_code" placeholder="Product Code"
                            class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="product_description" class="text-gray-700 font-semibold">Product Description</label>
                        <input type="text" id="product_description" placeholder="Product Description"
                            class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="select_category" class="text-gray-700 font-semibold">Select Category</label>
                        <select
                            name="select_category"
                            id="select_category"
                            class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important"
                        >
                            <option value="Select Category">Select Category</option>
                            <option value="Category 2">Category 2</option>
                            <option value="Category 3">Category 3</option>
                        </select>
                    </div>
                </div>
                <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 pt-0 gap-4">
                    <div>
                        <label for="select_material" class="text-gray-700 font-semibold">Select Material</label>
                        <select
                            name="select_material"
                            id="select_material"
                            class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important"
                        >
                            <option value="Select Material">Select Material</option>
                            <option value="Category 2">Category 2</option>
                            <option value="Category 3">Category 3</option>
                        </select>
                    </div>
                    <div>
                        <label for="product_hsn_code" class="text-gray-700 font-semibold">HSN Code</label>
                        <input type="text" id="product_hsn_code" placeholder="HSN Code"
                            class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="select_unit" class="text-gray-700 font-semibold">Select Unit</label>
                        <select
                            name="select_unit"
                            id="select_unit"
                            class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important"
                        >
                            <option value="Select Unit">Select Unit</option>
                            <option value="Category 2">Category 2</option>
                            <option value="Category 3">Category 3</option>
                        </select>
                    </div>
                    <div>
                        <label for="size" class="text-gray-700 font-semibold">Size</label>
                        <input type="text" id="size" placeholder="Size"
                            class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                </div>
                <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                    <div>
                        <label for="min_stock_level" class="text-gray-700 font-semibold">Min Stock Level</label>
                        <input type="text" id="min_stock_level" placeholder="Min Stock Level"
                            class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="critical" class="text-gray-700 font-semibold">Critical ?</label>
                        <div class="flex items-center mt-4">
                            <div class="flex items-center mr-3">
                                <input type="radio" id="critical_yes" name="critical"
                                class="border rounded-sm outline-none p-3 mr-2 w-5 h-5">
                                <label for="domestic" class="text-gray-400 font-normal">Yes</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="critical_no" name="critical"
                                class="border rounded-sm outline-none p-2 mr-2 w-5 h-5">
                                <label for="export" class="text-gray-400 font-normal mr-auto">No</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="qc_required" class="text-gray-700 font-semibold">QC Required ?</label>
                        <div class="flex items-center mt-4">
                            <div class="flex items-center mr-3">
                                <input type="radio" id="qc_required_yes" name="qc_required"
                                class="border rounded-sm outline-none p-3 mr-2 w-5 h-5">
                                <label for="domestic" class="text-gray-400 font-normal">Yes</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="qc_required_no" name="qc_required"
                                class="border rounded-sm outline-none p-2 mr-2 w-5 h-5">
                                <label for="export" class="text-gray-400 font-normal mr-auto">No</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="it_self_item" class="text-gray-700 font-semibold">It self item ?</label>
                        <div class="flex items-center mt-4">
                            <div class="flex items-center mr-3">
                                <input type="radio" id="it_self_item_yes" name="it_self_item"
                                class="border rounded-sm outline-none p-3 mr-2 w-5 h-5">
                                <label for="domestic" class="text-gray-400 font-normal">Yes</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="it_self_item_no" name="it_self_item"
                                class="border rounded-sm outline-none p-2 mr-2 w-5 h-5">
                                <label for="export" class="text-gray-400 font-normal mr-auto">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="add-product">

        </div>
        <div class="flex flex-wrap gap-5">
            <button class="text-white text-sm px-4 py-2 w-28" style="background-color: #007bff;">Save</button>
            <button class="bordertext-sm px-4 py-2 w-28" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
        </div>
    </div>
    <script src="../assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
            
        if(window.location.href.includes("product")) {
            const product = document.querySelector(".product");
            product.classList.add("active");

            const customerLink = document.querySelector('a[href="/erp/product/master_product.php"]');
            if (customerLink) {
            customerLink.classList.add('font-bold', 'text-black');
            }
        }
        });

    </script>
</body>

</html>