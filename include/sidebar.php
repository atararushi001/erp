<aside>
        <nav id="sidebar"
            class="fixed top-0 left-0 h-full w-16 bg-white shadow-md z-50 overflow-y-auto text-sm transition-all duration-300 hover:w-60">
            <div class="mt-24 m-5" id="dashboard">
                <a href="#" class="flex items-center ">
                    <img src="https://aarvitechnolabs.in/aarviERP/assets/icons/new_icons/dashboard.svg"
                        class="mr-6 h-5 w-5 transition-all duration-300 nav-menu-img">
                    <span id="spantext">Dashboard</span>
                </a>
            </div>
            <div class="m-5">
                <a href="#" class="flex items-center product" onclick="toggleSubmenu('productSubmenu')">
                    <img src="https://aarvitechnolabs.in/aarviERP/assets/icons/new_icons/product.svg" class="mr-6 h-5 w-5 transition-all duration-300 nav-menu-img">
                    <span id="spantext">Product</span>
                </a>
                <ul id="productSubmenu" class="hidden">
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="/product/master_product.php">Master Product </a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="/product/category.php">Category</a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="#">Materials</a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="#">Unit</a>
                    </li>   
                </ul>
            </div>
            <div class="m-5">
                <a href="#" class="flex items-center 
                transition-transform duration-300 sales" onclick="toggleSubmenu('salesSubmenu')">
                    <img src="https://aarvitechnolabs.in/aarviERP/assets/icons/new_icons/sales.svg"
                        class="mr-6 h-5 w-5 transition-all duration-300 nav-menu-img">
                    <span id="spantext">Sales</span>
                </a>
                <ul id="salesSubmenu" class="hidden">
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="/erp/sales/customer.php">Customer</a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="/erp/sales/contact.php">Contact</a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="/erp/sales/sales_enquiry.php">Sales Enquiry</a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="/erp/sales/sales_quotation.php">Quotation</a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="#">Appointment</a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="#">Proforma Invoice</a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="#">Invoice</a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="#">Sales Order</a>
                    </li>
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="#">Industry</a>
                    </li>
                </ul>
            </div>
            <div class="m-5"> 
                <a href="#" class="flex items-center purchase">
                    <img src="https://aarvitechnolabs.in/aarviERP/assets/icons/new_icons/purchase.svg"
                        class="mr-6 h-5 w-5 transition-all duration-300 nav-menu-img">
                    <span id="spantext">Purchase</span>
                </a>
            </div>
            <div class="m-5">
                <a href="#" class="flex items-center inventory">
                    <img src="https://aarvitechnolabs.in/aarviERP/assets/icons/new_icons/inventory.svg"
                        class="mr-6 h-5 w-5 transition-all duration-300 nav-menu-img">
                    <span id="spantext">Inventory</span>
                </a>
            </div>
            <div class="m-5">
                <a href="#" class="flex items-center other_pages" onclick="toggleSubmenu('otherPagesSubmenu')">
                    <img src="https://aarvitechnolabs.in/aarviERP/assets/icons/new_icons/other_pages.svg" class="mr-6 h-5 w-5 transition-all duration-300 nav-menu-img" />
                    <span id="spantext" class="whitespace-nowrap">Settings</span>
                </a>
                <ul id="otherPagesSubmenu" class="hidden">
                    <li class="ml-14 mt-5 mb-5 mr-5">
                        <a href="/erp/other_pages.php">Other Pages</a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>