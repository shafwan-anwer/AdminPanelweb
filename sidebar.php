<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
    <div class="side-header">
        <img src="./assets/images/logo.png" width="120" height="120">
        <h5 style="margin-top:10px;">Hello, Admin</h5>
    </div>

    <hr style="border:1px solid; background-color: #000000; border-color:#000000;">
    <a href="" class="closebtn mt-5 fa fa-close" onclick="closeNav()"></a>
    <a href="./index.php"><i class="fa fa-home"></i> Dashboard</a>
    <!-- <a href="./viewUsers.php"><i class="fa fa-users"></i> Customers</a> -->

    <div class="dropdown">
        <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-users"></i>&nbsp;Users</a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item text-dark " href="./viewUsers.php">Customers</a>
            <a class="dropdown-item text-dark" href="./viewDrivers.php">Drivers</a>
            <a class="dropdown-item text-dark" href="./viewOwners.php">Owners</a>
        </div>
    </div>

    <a href="./viewCategories.php"><i class="fa fa-th-large"></i> Category</a>
    <!-- <a href="#sizes"   onclick="showSizes()" ><i class="fa fa-th"></i> Sizes</a>
            <a href="#productsizes"   onclick="showProductSizes()" ><i class="fa fa-th-list"></i> Product Quantity</a>  -->
    <a href="./viewAllProducts.php"><i class="fa fa-th"></i> Vehicles</a>
    <a href="./viewAllOrders.php"><i class="fa fa-list"></i> Bookings</a>
    <a href="./viewService.php"><i class="fa fa-wrench"></i> Service Assist</a>

    <div class="dropdown">
        <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-files-o"></i>&nbsp;Reports</a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item text-dark " href="./Reports.php">Booking Report</a>
            <a class="dropdown-item text-dark" href="./breakdownreport.php">Breakdown Report</a>
        </div>
    </div>
</div>

<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
</div>