<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link rel="stylesheet" href="./styling/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1b039bb504.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header p-1">
        <div class="logo">
            <span>
                <img id="udm-logo"
                    src="./assets/image/udm-logo-1.png"
                    class="img-fluid ms-2"
                    alt="UDM Logo" />
            </span>

            <span>
                <h5 class="mt-2 ms-3 text-white">
                    UDM HR Information System
                </h5>
            </span>
        </div>

        <div class="logout m-2 me-4">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right text-white" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                </svg>
            </a>
        </div>
    </header>

    <div class="navigation p-3">
        <div class="user-icon d-flex justify-content-center border-bottom border-black">
            <div id="icon" class="mt-2">
                <img src="./assets/image/userImg.png" alt="User Icon" class="img-fluid">
            </div>
            <div id="username" class="username mt-2 ms-2 p-1">
                <p class="lh-1 me-5">
                    jelo Flores
                </p>
                <p class="lh-1">
                    <strong>Human Resource</strong>
                </p>
            </div>
        </div>
        <div class="nav-menu mt-3">
            <div class="dashboard d-flex justify-content-center border-bottom border-black w-100 p-1">
                <span>
                    <img
                        src="./assets/image/dashboardIcon.png"
                        class="img-fluid"
                        alt="dashboard icon" />
                </span>
                <span>
                    <a href="#" class="text-decoration-none">
                        <p class="text-black">
                            Dashboard
                        </p>
                    </a>
                </span>
            </div>

            <div class="dashboard d-flex justify-content-start w-100 mt-2 p-1">
                <span>
                    <p class="h6 fw-bold">
                        MENU
                    </p>
                </span>
            </div>

            <div class="employee d-flex justify-content-center w-100 p-1 ">
                <span>
                    <img
                        src="./assets/image/employeesIcon.png"
                        class="img-fluid"
                        alt="Employee icon" />
                </span>
                <span>
                    <a href="./employee.php" class="text-decoration-none">
                        <p class=" text-black me-2">
                            Employees
                        </p>
                    </a>
                </span>
            </div>
            <div class="department d-flex justify-content-center w-100 p-1 ">
                <span>
                    <img
                        src="./assets/image/departmentIcon.png"
                        class="img-fluid"
                        alt="employee icon" />
                </span>
                <span>
                    <a href="#" class="text-decoration-none">
                        <p class=" text-black ">
                            Department
                        </p>
                    </a>
                </span>
            </div>
            <div class="department d-flex justify-content-center w-100 p-1 ms-2">
                <span>
                    <img
                        src="./assets/image/calendar.png"
                        class="img-fluid "
                        alt="Record icon" />
                </span>
                <span>
                    <a href="./index.php" class="text-decoration-none">
                        <p class=" text-black me-2 ms-2">
                            Date Record
                        </p>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <div class="banner">
            <p class="mt-1 h1 fs-3">Permanent Employee</p>
        </div>

    <div class="main-content w-75 p-1">
        <div class="field d-flex d-flex justify-content-between p-1">
            <!-- Search Bar -->
            <div class="search-bar p-2">
                <p>
                    <span class="icon is-small is-left">
                        <i id="glass" class="fas fa-magnifying-glass mt-2 ms-1 p-1 "></i>
                    </span>
                    <input id="search" class="input" type="email" placeholder="Search Faculty" />
                </p>
            </div>
            <div class="dropdown-center ml-1 p-2">
                <button class="btn border border-black rounded-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Department
                </button>
                <ul class="dropdown-menu ">
                    <li><a class="dropdown-item" href="#">Department 1</a></li>
                    <li><a class="dropdown-item" href="#">Department 1</a></li>
                    <li><a class="dropdown-item" href="#">Department 1</a></li>
                </ul>
            </div>
        </div>

        <div class="employee-table p-2">
            <table class="table">
                <thead>
                    <tr>
                        <th class="has-text-black">USERID</th>
                        <th class="has-text-black">NAME</th>
                        <th class="has-text-black">STATUS</th>
                        <th class="has-text-black">DEPARTMENT</th>
                        <th class="has-text-black">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="has-text-black">1</td>
                        <td class="has-text-black">John Doe</td>
                        <td class="has-text-black">Permanent</td>
                        <td class="has-text-black">Quad</td>
                        <td class="has-text-black">
                            <span><a href="#"><img src="./assets/image/preview.png" alt="preview"></a></span>
                            <span><a href="#"><img src="./assets/image/Edit.png" alt="edit"></a></span>
                            <span><a href="#"><img src="./assets/image/Delete.png" alt="delete"></a></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="has-text-black">2</td>
                        <td class="has-text-black">Jane Smith</td>
                        <td class="has-text-black">Permanent</td>
                        <td class="has-text-black">Quad</td>
                        <td class="has-text-black">
                            <span><a href="#"><img src="./assets/image/preview.png" alt="preview"></a></span>
                            <span><a href="#"><img src="./assets/image/Edit.png" alt="edit"></a></span>
                            <span><a href="#"><img src="./assets/image/Delete.png" alt="delete"></a></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="has-text-black">3</td>
                        <td class="has-text-black">Michael Johnson</td>
                        <td class="has-text-black">Permanent</td>
                        <td class="has-text-black">Quad</td>
                        <td class="has-text-black">
                            <span><a href="#"><img src="./assets/image/preview.png" alt="preview"></a></span>
                            <span><a href="#"><img src="./assets/image/Edit.png" alt="edit"></a></span>
                            <span><a href="#"><img src="./assets/image/Delete.png" alt="delete"></a></span>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>


</body>

</html>