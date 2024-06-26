<?php

@include '../include/function.php';

if (isset($_GET['customer_id'])) {

    $customerquery = mysqli_query($conn, "SELECT * FROM customer where customer_id = " . $_GET['customer_id']);
    $customerdata = mysqli_fetch_array($customerquery);
}

?>

<?php
$countryOptionsHTML = '';
$query = mysqli_query($conn, "SELECT * FROM country");
while ($row = mysqli_fetch_array($query)) {
    if (isset($_GET['customer_id'])) {
    }
    $countryOptionsHTML .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
}

echo '<script>';
echo 'var countryOptionsHTML = `' . $countryOptionsHTML . '`;';
echo '</script>';



$country_taxOptionsHTML = '';
$query = mysqli_query($conn, "SELECT * FROM country_tax");
while ($row = mysqli_fetch_array($query)) {
    $country_taxOptionsHTML .= '<option value="' . $row['country_tax_id'] . '">' . $row['country_tax_name'] . '</option>';
}

echo '<script>';
echo 'var country_taxOptionsHTML = `' . $country_taxOptionsHTML . '`;';
echo '</script>';
?>

<!DOCTYPE html>
<html lang="en">
<?php
require_once('../include/config.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>


    <?php include '../include/script.php' ?>

    <style>
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin-top: 0.5rem;
            position: relative;
            vertical-align: middle;
        }

        #customerCategoryPopup,
        #customerIndustryPopup,
        #customer_typePopup,
        #customer_sourcePopup,
        #customer_branch_warehousePopup {
            display: none;
            z-index: 99;
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#customer_category").select2({
                width: '100%',
                placeholder: 'Add',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('customerCategoryPopup','#customer_category')\" style='background-color: #007bff;'>Add Customer Category</button>");
                    }
                }
            });
            $("#industry").select2({
                width: '100%',
                placeholder: 'Add Industry',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('customerIndustryPopup','#industry')\" style='background-color: #007bff;'>Add Industry</button>");
                    }
                }
            });
            $("#customer_type").select2({
                width: '100%',
                placeholder: 'Add Customer Type',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('customer_typePopup','#customer_type')\"  style='background-color: #007bff;'>Add Customer Type</button>");
                    }
                }
            });
            $("#customer_source").select2({
                width: '100%',
                placeholder: 'Add Source / Referred by',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('customer_sourcePopup','#customer_source')\" style='background-color: #007bff;'>Add Source / Referred by</button>");
                    }
                }
            });
            $("#customer_branch_warehouse").select2({
                width: '100%',
                placeholder: 'Add Branch / Warehouse',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('customer_branch_warehousePopup','#customer_branch_warehouse')\"  style='background-color: #007bff;'>Add Branch / Warehouse</button>");
                    }
                }
            });
            // $("#country_tax").select2({
            //     width: '100%',
            //     placeholder: 'Add Branch / Warehouse',
            //     language: {
            //         noResults: function() {
            //             return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('customer_branch_warehousePopup','#customer_branch_warehouse')\"  style='background-color: #007bff;'>Add Branch / Warehouse</button>");
            //         }
            //     }
            // });
            $('.select2-init').each(function() {
                $(this).select2();
            });
        });
    </script>

</head>

<body class="bg-gray-100">
    <?php include '../include/sidebar.php' ?>
    <?php include '../include/header.php' ?>

    <form action="../include/function.php" method="post" enctype="multipart/form-data">
        <div id="mydiv" class="max-w-full mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
            <div class="mb-3">
                <h1 class="text-xl font-semibold text-custom-blue"><?php
                                                                    if (isset($_GET['new'])) {
                                                                        echo "Add Customer";
                                                                    } elseif (isset($_GET['customer_id'])) {
                                                                        echo "Edit Customer";
                                                                    } else {
                                                                        echo "Add Customer";
                                                                    } ?>
                    Information</h1>
            </div>
            <div>
                <div class="bg-white rounded-sm shadow-md mb-4">
                    <div class="w-full border-b">
                        <h2 class="text-gray-800 font-semibold p-4 text-lg">General Information</h2>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 gap-4">
                        <div>
                            <label for="customer_code" class="text-gray-700 font-semibold">Customer Code</label>
                            <input type="text" name="customer_code" id="customer_code" onchange="checkcustomercode(this)" placeholder="Customer Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" value="<?php echo isset($_GET['customer_id']) ? $customerdata['customer_code'] : '' ?>">

                        </div>
                        <div>
                            <label for="customer_category" class="text-gray-700 font-semibold">Customer Category</label>
                            <select name="customer_category" id="customer_category" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="0">Customer Category</option>
                                <?php
                                getoptionwithstatus('customer_category', 'cu_cat_id', 'cu_cat_name', 'cu_cat_status');

                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="company_name" class="text-gray-700 font-semibold">Company Name</label>

                            <input type="text" name="company_name" id="company_name" placeholder="Company Name" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" value="<?php echo isset($_GET['customer_id']) ? $customerdata['customer_company_name'] : '' ?>">
                        </div>
                        <div>
                            <label for="customer_Industry" class="text-gray-700 font-semibold">Industry</label>
                            <select name="customer_Industry" id="industry" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Industry">Industry</option>

                                <?php
                                getoptionwithstatus('industry', 'Industry_id', 'Industry_name', 'Industry_status');

                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="customer_type" class="text-gray-700 font-semibold">Customer Type</label>
                            <select name="customer_types" id="customer_type" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Category Type">Customer Type</option>

                                <?php
                                getoptionwithstatus('customer_type', 'cu_ty_id', 'cu_ty_name', 'cu_ty_status');
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="customer_sources" class="text-gray-700 font-semibold">Source / Referred by</label>
                            <select name="customer_sources" id="customer_source" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Source / Referred by">Source / Referred by</option>
                                <?php
                                getoptionwithstatus('source', 'source_id', 'source_name', 'source_status');

                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="customer_phone" class="text-gray-700 font-semibold">Phone</label>
                            <input type="text" name="customer_phone" id="customer_phone" placeholder="Phone" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" value="<?php echo isset($_GET['customer_id']) ? $customerdata['customer_phone'] : '' ?>">
                        </div>
                        <div>
                            <label for="customer_email" class="text-gray-700 font-semibold">Email</label>
                            <input type="text" name="customer_email" id="customer_email" placeholder="Email" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" value="<?php echo isset($_GET['customer_id']) ? $customerdata['customer_email'] : '' ?>">
                        </div>
                        <div>
                            <label for="custom_field1" class="text-gray-700 font-semibold">Custom Field</label>
                            <input type="text" name="custom_field1" id="custom_field1" placeholder="Custom Field" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" value="<?php echo isset($_GET['customer_id']) ? $customerdata['customer_custom_1'] : '' ?>">
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="numaddress" id="numaddress">

            <div id="customer-address">
                <?php
                $count = 0;
                if (isset($_GET['customer_id'])) {

                    $addressrquery = mysqli_query($conn, "SELECT * FROM customer_address where customer_id = " . $_GET['customer_id']);
                    while ($addressdata = mysqli_fetch_array($addressrquery)) {
                        $count++;
                ?>
                        <div class="max-w-full mb-4">
                            <div class="bg-white rounded-sm shadow-md">
                                <div class="w-full border-b flex">
                                    <h2 class="justify-start text-gray-800 font-semibold p-4 text-lg" id="customeraddress<?php echo  $count; ?>">Customer Address <?php echo  $count; ?></h3>
                                        <button class="ml-auto mr-4 flex mt-auto mb-auto" onclick="removeCustomer(this)">
                                            <svg class="mr-2 mt-1" width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M15 9L9 15" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M9 9L15 15" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p class="text-red-500 text-lg">Remove Address</p>
                                        </button>
                                </div>
                                <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                                    <div class="col-span-full">
                                        <label for="address<?php echo  $count; ?>" class="text-gray-700 font-semibold">Address</label>
                                        <input type="text" name="address<?php echo  $count; ?>" value="<?php echo $addressdata['address_address']; ?>" id="postal_code<?php echo  $count; ?>" id="address<?php echo  $count; ?>" placeholder="Address" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">

                                        <input type="hidden" name="addressid<?php echo  $count; ?>" value="<?php echo $addressdata['address_id']; ?>">
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                                    <div>
                                        <label for="country<?php echo  $count; ?>" class="text-gray-700 font-semibold">Country</label>
                                        <select name="country<?php echo  $count; ?>" id="country<?php echo  $count; ?>" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important" onchange="fetchStates(this,<?php echo $addressdata['address_state']; ?>)">
                                            <option value="Country">Country</option>
                                            <?php echo $countryOptionsHTML;    ?>

                                        </select>
                                    </div>
                                    <div>
                                        <label for="state<?php echo  $count; ?>" class="text-gray-700 font-semibold">State</label>
                                        <select name="state<?php echo  $count; ?>" id="state<?php echo  $count; ?>" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important" onchange="fetchcity(this,<?php echo $addressdata['address_city']; ?>)">
                                            <option value="State">State</option>

                                        </select>
                                    </div>
                                    <div>
                                        <label for="city<?php echo  $count; ?>" class="text-gray-700 font-semibold">City</label>
                                        <select name="city<?php echo  $count; ?>" id="city<?php echo  $count; ?>" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                            <option value="City">City</option>

                                        </select>
                                    </div>
                                    <div>
                                        <label for="postal_code<?php echo  $count; ?>" class="text-gray-700 font-semibold">Zip/Postal Code</label>
                                        <input type="text" name="postal_code<?php echo  $count; ?>" value="<?php echo $addressdata['address_zip_code']; ?>" id="postal_code<?php echo  $count; ?>" placeholder="Zip/Postal Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                                    </div>
                                    <div>
                                        <label for="country_tax<?php echo  $count; ?>" class="text-gray-700 font-semibold">Country Tax</label>
                                        <input
                                type="text"
                                    name="country_tax<?php echo  $count; ?>"
                                  placeholder="Country tax"
                                    class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2"
                                    value="<?php echo $addressdata['country_tax']; ?>"
                                    >
                                    </div>
                                    <div>
                                        <label for="tax_no<?php echo  $count; ?>" class="text-gray-700 font-semibold">Tax No</label>
                                        <input type="text" name="tax_no<?php echo  $count; ?>" value="<?php echo $addressdata['tax_no']; ?>" id="tax_no<?php echo  $count; ?>" placeholder="Tax No" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                                    </div>
                                </div>
                            </div>
                        </div>


                <?php
                    }
                }
                echo '<script>';
                echo    $count > 0 ?  'var addresscount = `' . ($count + 1) . '`;' :  'var addresscount = `' . '1' . '`;';

                echo ' document.getElementById("numaddress").value = ' . $count . ';';
                echo '</script>';
                ?>
            </div>
            <button type="button" class="flex p-4" onclick="addCustomer()">
                <svg class="ml-3 mr-3 mb-1" width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 8V16" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 12H16" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <p class="" style="color: #007bff;">Add New Address</p>
            </button>
            <div class="flex flex-wrap gap-5">
                <button type="submit" name="<?php if (isset($_GET['new'])) {
                                                echo "addctomerform";
                                            } elseif (isset($_GET['customer_id'])) {
                                                echo "editctomerform";
                                            } else {
                                                echo "addctomerform";
                                            } ?>" class="text-white text-sm px-4 py-2 w-28" value="<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : "0" ?>" style="background-color: #007bff;">Save</button>

                <?php
                if (isset($_GET['customer_id'])) {
                ?>
                    <!-- <button type="submit" name="saveandnewcustomer" class="text-white text-sm px-4 py-2 w-28" value="<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : "0" ?>" style="background-color: #007bff;">Save & New</button> -->

                    <!-- <button type="submit" name="save_and_new" class="text-white text-sm px-4 py-2 w-28" style="background-color: #007bff;" name="saveandnewcustomer" value="<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : "0" ?>"></button> -->


                <?php
                }

                ?>
                <a name="cancel" href="customer.php" class="border bg-white text-sm px-8 py-2 w-28" style="color: #007bff; border: 1px solid #007bff;">Cancel</a>
            </div>
        </div>
    </form>
    <!-- customerCategoryPopup model -->

    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="    z-index: 99;" id="customerCategoryPopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create New Customer Category</h2>
                <svg id="closeCCategory" onclick="closeModal('customerCategoryPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="categoryfrom" action="../include/function.php" id="categoryfrom">
                <div>
                    <label for="customerCategory" class="text-gray-700 font-semibold">Customer Category Name</label>
                    <input type="text" name="customerCategory" id="customerCategory" placeholder="Customer Category Name" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('categoryfrom','#customer_category','customerCategory')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('customerCategoryPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- customerIndustryPopup model -->
    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99;" id="customerIndustryPopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create New Industry</h2>
                <svg id="closeCCategory" onclick="closeModal('customerIndustryPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="industryfrom" action="../include/function.php" id="industryfrom">
                <div>
                    <label for="customerIndustry" class="text-gray-700 font-semibold">Industry Name</label>
                    <input type="text" name="customerIndustry" id="customerIndustry" placeholder="Industry Name" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('industryfrom','#industry','customerIndustry')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('customerIndustryPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- customer_typePopup model -->
    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99;" id="customer_typePopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create Customer Type</h2>
                <svg id="closeCCategory" onclick="closeModal('customer_typePopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="customer_typefrom" action="../include/function.php" id="customer_typefrom">
                <div>
                    <label for="customer_type" class="text-gray-700 font-semibold">Customer Type</label>
                    <input type="text" name="customer_type" id="customer_type" placeholder="Customer Type" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('customer_typefrom','#customer_type','customer_type')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('customer_typePopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- customer_sourcePopup model -->

    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99;" id="customer_sourcePopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create Customer Source</h2>
                <svg id="closeCCategory" onclick="closeModal('customer_sourcePopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="customer_sourceform" action="../include/function.php" id="customer_sourceform">
                <div>
                    <label for="customer_type" class="text-gray-700 font-semibold">Customer Source</label>
                    <input type="text" name="customer_source" id="customer_source" placeholder="Customer Type" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('customer_sourceform','#customer_source','customer_source')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('customer_sourcePopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- customerCategoryPopup model -->
    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99;" id="customer_branch_warehousePopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create Customer Branch</h2>
                <svg id="closeCCategory" onclick="closeModal('customer_branch_warehousePopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="customer_branch_warehouseform" action="../include/function.php" id="customer_branch_warehouseform">
                <div>
                    <label for="customer_type" class="text-gray-700 font-semibold">Customer Branch</label>
                    <input type="text" name="customer_branch_warehouse" id="customer_branch_warehouse" placeholder="Customer Type" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('customer_branch_warehouseform','#customer_branch_warehouse','customer_branch_warehouse')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('customer_branch_warehousePopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var CustomerAddressNumber = addresscount;

        // to add filds CustomerAddressNumber
        function addCustomer() {
            let newCustomerDiv = document.createElement("div");

            newCustomerDiv.innerHTML = `<div class="max-w-full mb-4">
                    <div class="bg-white rounded-sm shadow-md">
                        <div class="w-full border-b flex">
                            <h2 class="justify-start text-gray-800 font-semibold p-4 text-lg"  id="customeraddress${CustomerAddressNumber}">Customer Address ${CustomerAddressNumber}</h3>
                            <button class="ml-auto mr-4 flex mt-auto mb-auto" onclick="removeCustomer(this)">
                                <svg class="mr-2 mt-1" width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15 9L9 15" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 9L15 15" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <p class="text-red-500 text-lg">Remove Address</p>
                            </button>
                        </div>
                        <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                            <div class="col-span-full">
                                <label for="address${CustomerAddressNumber}" class="text-gray-700 font-semibold">Address</label>
                                <input type="text" name="address${CustomerAddressNumber}" id="address${CustomerAddressNumber}" placeholder="Address" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                            <div>
                                <label for="country${CustomerAddressNumber}" class="text-gray-700 font-semibold">Country</label>
                                <select
                                name="country${CustomerAddressNumber}"
                                id="country${CustomerAddressNumber}"
                                class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important"
                                onchange="fetchStates(this)"
                                >
                                    <option value="Country">Country</option>` +
                countryOptionsHTML + `
                                </select>
                            </div>
                            <div>
                                <label for="state${CustomerAddressNumber}" class="text-gray-700 font-semibold">State</label>
                                <select
                                    name="state${CustomerAddressNumber}"
                                    id="state${CustomerAddressNumber}"
                                    class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important"
                                    onchange="fetchcity(this)"
                                    >
                                    <option value="State">State</option>
                                
                                </select>
                            </div>
                            <div>
                                <label for="city${CustomerAddressNumber}" class="text-gray-700 font-semibold">City</label>
                                <select
                                    name="city${CustomerAddressNumber}"
                                    id="city${CustomerAddressNumber}"
                                    class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important"
                                >
                                    <option value="City">City</option>
                                 
                                </select>
                            </div>
                            <div>
                                <label for="postal_code${CustomerAddressNumber}" class="text-gray-700 font-semibold">Zip/Postal Code</label>
                                <input type="text" name="postal_code${CustomerAddressNumber}" id="postal_code${CustomerAddressNumber}" placeholder="Zip/Postal Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                            <div>
                                <label for="country_tax${CustomerAddressNumber}" class="text-gray-700 font-semibold">Country Tax</label>
                                <input
                                type="text"
                                    name="country_tax${CustomerAddressNumber}"
                                  placeholder="Country tax"
                                    class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2"
                                >
                                  
                                 
                                </select>
                            </div>
                            <div>
                                <label for="tax_no${CustomerAddressNumber}" class="text-gray-700 font-semibold">Tax No</label>
                                <input type="text" name="tax_no${CustomerAddressNumber}" id="tax_no${CustomerAddressNumber}" placeholder="Tax No" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                        </div>
                    </div>
                </div>`;
            $(newCustomerDiv)
                .find(`#country_tax${CustomerAddressNumber}`)
                .select2({
                    width: '100%',
                    placeholder: 'test',
                    language: {
                        noResults: function() {
                            return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('customer_branch_warehousePopup','#customer_branch_warehouse')\"  style='background-color: #007bff;'>Add Branch / Warehouse</button>");
                        }
                    }
                });
            CustomerAddressNumber++;
            document.getElementById("numaddress").value = CustomerAddressNumber;

            document.getElementById("customer-address").appendChild(newCustomerDiv);
            $(newCustomerDiv)
                .find(".select2-init")
                .each(function() {
                    $(this).select2();
                });
        }

        function fetchStates(countrySelect) {
            const selectedCountry = countrySelect.value;
            const stateSelect = countrySelect.parentElement.nextElementSibling;

            const stateSelectElement = stateSelect.querySelector('select');
            console.log(stateSelectElement.id);
            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    country: selectedCountry
                },
                success: function(response) {


                    stateSelectElement.innerHTML = response;
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }
            });
        }

        function fetchStates(countrySelect, data) {
            const selectedCountry = countrySelect.value;
            const stateSelect = countrySelect.parentElement.nextElementSibling;

            const stateSelectElement = stateSelect.querySelector('select');

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    country: selectedCountry
                },
                success: function(response) {


                    stateSelectElement.innerHTML = response;
                    $('#' + stateSelectElement.id).val(data);
                    $('#' + stateSelectElement.id).trigger('change');
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }
            });
        }

        function fetchcity(stateSelect) {



            const selectedstate = stateSelect.value;
            const citySelect = stateSelect.parentElement.nextElementSibling;
            const citySelectElement = citySelect.querySelector('select');

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    state: selectedstate
                },

                success: function(response) {
                    citySelectElement.innerHTML = response;
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }

            });
        }

        function fetchcity(stateSelect, data) {
            const selectedstate = stateSelect.value;
            const citySelect = stateSelect.parentElement.nextElementSibling;
            const citySelectElement = citySelect.querySelector('select');

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    state: selectedstate
                },

                success: function(response) {
                    citySelectElement.innerHTML = response;
                    console.log(citySelectElement)
                    $('#' + citySelectElement.id).val(data);
                    $('#' + citySelectElement.id).trigger('change');
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }

            });
        }

        // function savedata(formname, selecter, inputselecter) {
        //     var form = $("#" + formname);
        //     var url = form.attr('action');
        //     var addtext = form.find("input[name='" + inputselecter + "']");
        //     $.ajax({

        //         type: "POST",
        //         url: url,
        //         data: form.serialize(),
        //         success: function(data) {
        //             var newOption = new Option(addtext.val(), data, false, false);
        //             $(selecter).append(newOption).trigger('change');
        //             addtext.val("");
        //             alert("Form Submited Successfully");
        //         },
        //         error: function(data) {
        //             alert("some Error");
        //         }
        //     });
        // }

        function checkcustomercode(custoemrdata) {
            $.ajax({
                type: "GET",
                url: '../include/function.php',
                data: {
                    customercode: custoemrdata.value
                },

                success: function(data) {
                    if (data > 0) {
                        alert("Customer is already exist");
                    }
                },
                error: function(data) {
                    alert("some Error");
                }
            });

        }

        function changestatus(tablename) {

            $.ajax({
                type: "GET",
                url: '../include/function.php',
                data: {
                    customercode: custoemrdata.value
                },

                success: function(data) {
                    if (data > 0) {
                        alert("Customer is already exist");
                    }
                },
                error: function(data) {
                    alert("some Error");
                }
            });

        }
        $(document).ready(function() {
            if (window.location.href.includes("sales")) {
                const sales = document.querySelector(".sales");
                const salesMenu = document.getElementById("salesSubmenu");

                sales.classList.add("active");

                const customerLink = document.querySelector('a[href="/erp/sales/customer.php"]');
                if (customerLink) {
                    customerLink.classList.add('font-bold', 'text-black');
                }
            }
        });
    </script>
    <?php


    if (isset($_GET['customer_id'])) {

        getselecterdata($customerdata['customer_category'], '#customer_category');
        getselecterdata($customerdata['customer_Industry'], '#industry');
        getselecterdata($customerdata['customer_type'], '#customer_type');
        getselecterdata($customerdata['customer_source'], '#customer_source');
        getselecterdata($customerdata['customer_branch'], '#customer_branch_warehouse');
        $count = 0;
        $addressrquery = mysqli_query($conn, "SELECT * FROM customer_address where customer_id = " . $_GET['customer_id']);
        while ($addressdata = mysqli_fetch_array($addressrquery)) {
            $count++;
            getselecterdata($addressdata['address_country'], '#country' . $count);
        }
    }


    ?>
</body>
<script src="../assets/js/script.js"></script>

</html>