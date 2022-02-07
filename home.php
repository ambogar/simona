<?php

session_start();

// koneksi database
require 'functions.php';
// query buka lemari
$dokumen = query("SELECT * FROM apm  ORDER BY nomor,area,kriteria ASC" );

// Tombol Area
if(isset ($POST["all"])){
    $dokumen = query("SELECT * FROM apm ORDER BY nomor,area,kriteria ASC");
}
if(isset($_POST["subject"])){
    $dokumen = filter($_POST["subject"]);
}
if(isset($_POST["sudah"])){
    $dokumen = dah_lom($_POST["sudah"]);
}
if(isset($_POST["belum"])){
    $dokumen = dah_lom($_POST["belum"]);
}
if(isset($_POST["belumacc"])){
    $dokumen = dah_lom_acc($_POST["belumacc"]);
}
if(isset($_POST["sudahacc"])){
    $dokumen = dah_lom_acc($_POST["sudahacc"]);
}

//Tombol Download
if(isset($_POST["download"])){
    downloadall();
}

//Tombol Delete
if(isset($_POST["delete"])){
    deleteall();
}

//Tombol Reset
if(isset($_POST["reset"])){
    resetall();
}




if (isset($_SESSION['username']) && isset($_SESSION['id'])) {


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="./dist/styles.css">
    <link rel="stylesheet" href="./dist/all.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>SI-MONA</title>
</head>

<body>

<!--==================================================================== FOR ADMINISTRATOS ==========================================================================================================-->
<?php if ($_SESSION['role'] == 'admin') {?>
    
    <!--Container -->
    <div class="mx-auto bg-grey-400">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <header class="bg-nav">
                <div class="flex justify-between">
                    <div class="p-1 mx-3 inline-flex items-center">
                        <div style="width:100px height:100px background-color:blue"></div>
                        <h1 class="text-white p-2">SI-MONA</h1><br>
                        <p class="text-white p-2"> (Sistem Informasi Monitoring APM Pengadilan Agama Larantuka)</p>
                    </div>
                    <div class="p-1 flex flex-row items-center">
    
                        <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="logopa.png" alt="">
                        <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">admin</a>
                        <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                            <ul class="list-reset">
                              
                              <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!--/Header-->
    
    
            <div class="flex flex-1">
                <!--Sidebar-->
                <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
    
                    <ul class="list-reset flex flex-col">
                        <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                            <a href="index.php"
                               class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-tachometer-alt float-left mx-2"></i>
                                Dashboard
                                <span><i class="fas fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-300-border">
                        <a href="logout.php" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fas fa-square-full float-left mx-2"></i>
                            Logout
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                        </li>
                    </ul>
    
                </aside>
                <!--/Sidebar-->
    
                <!--Main-->
                <main class="bg-white-300 flex-1 p-3 overflow-hidden">
    
                    <div class="flex flex-col">
                        <!-- Stats Row Starts Here -->
                        <form action="" method="post" class="head">
                        <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                            <button class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2" name="belum" type="submit" value="Belum Upload">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php counting_belum();?></div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        BELUM UPLOAD
                                    </a>
                                </div>
                            </button>
    
    
                            <button class="shadow bg-info border-l-8 hover:bg-info-dark border-info-dark mb-2 p-2 md:w-1/4 mx-2" name="sudah" type="submit" value="Sudah Upload">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php counting_sudah();?></div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        SUDAH UPLOAD
                                    </a>
                                </div>
                            </button>
    
                            <button class="shadow bg-warning border-l-8 hover:bg-warning-dark border-warning-dark mb-2 p-2 md:w-1/4 mx-2" name="all" type="submit">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php counting_total();?></div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        TOTAL BERKAS
                                    </a>
                                </div>
                            </button>
                            <button class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2" name="all" type="submit">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php prosentase();?> %</div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        PROGRESS
                                    </a>
                                </div>
                            </button>
                            
                            </form>
                        </div>
    
                        <!-- /Stats Row Ends Here -->

                        <!-- Stats ACC Starts Here -->
                        <form action="" method="post" class="head">
                        <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                            <button class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2" name="belumacc" type="submit" value="Belum ACC">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php counting_belum_acc();?></div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        BELUM ACC
                                    </a>
                                </div>
                            </button>
                            <button class="shadow bg-primary border-l-8 hover:bg-primary-dark border-primary-dark mb-2 p-2 md:w-1/4 mx-2" name="sudahacc" type="submit" value="Sudah ACC">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php counting_sudah_acc();?></div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        SUDAH ACC
                                    </a>
                                </div>
                            </button>
                            <button class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2" name="all" type="submit">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php prosentase_acc();?> %</div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        PROGRESS ACC
                                    </a>
                                </div>
                            </button>
                            
                            </form>
                        </div>
    
                        <!-- Download all data -->
                        <div class="mb-2 mx-2 border-solid border-gray-300 rounded border shadow-sm w-full ">
                            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b">
                                Download ALL DATA
                            </div>
                            <div class="px-2 py-3">
                                Mendownload semua data yang sudah terupload
                            </div>
                            <form action="" method="post">
                            <div class="p-6">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="download" type="submit" value="All"  >
                                        Download
                                </button>    
                                
                                
                            </div>
                            </form>
                        </div>
                        <!-- /Download all data Ends Here -->

                        <!-- Delete all data -->
                        <div class="mb-2 mx-2 border-solid border-gray-300 rounded border shadow-sm w-full ">
                            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b">
                                Delete ALL DATA
                            </div>
                            <div class="px-2 py-3">
                                PERINGATAN !! SEMUA DATA YANG DI UPLOAD AKAN TERHAPUS, PASTIKAN SEMUA DATA SUDAH DI DOWNLOAD TERLEBIH DAHULU
                            </div>
                            <form action="" method="post">
                            <div class="p-6">
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" name="delete" type="submit" value="All" onclick="return confirm('Anda Yakin ?');">
                                        Delete
                                </button>    
                                
                                
                            </div>
                            </form>
                        </div>
                        <!-- /Delete all data Ends Here -->

                        <!-- Delete all data -->
                        <div class="mb-2 mx-2 border-solid border-gray-300 rounded border shadow-sm w-full ">
                            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b">
                                Reset ACC
                            </div>
                            <div class="px-2 py-3">
                                PERINGATAN !! SEMUA DATA YANG DI ACC AKAN DIUBAH MENJADI TIDAK ACC
                            </div>
                            <form action="" method="post">
                            <div class="p-6">
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" name="reset" type="submit" value="All" onclick="return confirm('Anda Yakin ?');">
                                        Reset
                                </button>    
                                
                                
                            </div>
                            </form>
                        </div>
                        <!-- /Delete all data Ends Here -->
    
                        <!--Footer-->
                        <footer class="bg-grey-darkest text-white p-2">
                            <div class="flex flex-1 mx-auto">&copy; Copyright</div>
                            <div class="">Distributed by:   <a href="https://www.facebook.com/ambogarr/" target=" _blank"> Muhammad Naufal,S.T </a> & <a href="https://www.facebook.com/caketz/" target=" _blank"> Subhan,S.H </a></div>
                        </footer>
                        <!--/footer-->
        </div>
    </div>
    
    <?php }?>
    <!--==================================================================== END FOR ADMINISTRATOS ==========================================================================================================-->
    

<!--==================================================================== FOR USERS ==========================================================================================================-->
<?php if ($_SESSION['role'] == 'user') {?>
    
<!--Container -->
<div class="mx-auto bg-grey-400">
    <!--Screen-->
    <div class="min-h-screen flex flex-col">
        <!--Header Section Starts Here-->
        <header class="bg-nav">
            <div class="flex justify-between">
                <div class="p-1 mx-3 inline-flex items-center">
                    <div style="width:100px height:100px background-color:blue"></div>
                    <h1 class="text-white p-2">SI-MONA</h1><br>
                    <p class="text-white p-2"> (Sistem Informasi Monitoring APM Pengadilan Agama Larantuka)</p>
                </div>
                <div class="p-1 flex flex-row items-center">

                    <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="logopa.png" alt="">
                    <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">user</a>
                    <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                        <ul class="list-reset">
                          
                          <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!--/Header-->


        <div class="flex flex-1">
            <!--Sidebar-->
            <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

                <ul class="list-reset flex flex-col">
                    <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                        <a href="index.php"
                           class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fas fa-tachometer-alt float-left mx-2"></i>
                            Dashboard
                            <span><i class="fas fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <li class="w-full h-full py-3 px-2 border-b border-300-border">
                        <a href="logout.php" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fas fa-square-full float-left mx-2"></i>
                            Logout
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                </ul>

            </aside>
            <!--/Sidebar-->

            <!--Main-->
            <main class="bg-white-300 flex-1 p-3 overflow-hidden">

                <div class="flex flex-col">
                    <!-- Stats Row Starts Here -->
                    <form action="" method="post" class="head">
                    <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                        <button class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2" name="belum" type="submit" value="Belum Upload">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    <div class="angka"><?php counting_belum();?></div>
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    BELUM UPLOAD
                                </a>
                            </div>
                        </button>


                        <button class="shadow bg-info border-l-8 hover:bg-info-dark border-info-dark mb-2 p-2 md:w-1/4 mx-2" name="sudah" type="submit" value="Sudah Upload">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    <div class="angka"><?php counting_sudah();?></div>
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    SUDAH UPLOAD
                                </a>
                            </div>
                        </button>

                        <button class="shadow bg-warning border-l-8 hover:bg-warning-dark border-warning-dark mb-2 p-2 md:w-1/4 mx-2" name="all" type="submit">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    <div class="angka"><?php counting_total();?></div>
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    TOTAL BERKAS
                                </a>
                            </div>
                        </button>
                        <button class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2" name="all" type="submit">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    <div class="angka"><?php prosentase();?> %</div>
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    PROGRESS
                                </a>
                            </div>
                        </button>
                        
                        </form>
                    </div>

                    <!-- /Stats Row Ends Here -->

                    <!--Solid Buttons-->
                    <div class="mb-2 mx-2 border-solid border-gray-300 rounded border shadow-sm w-full ">
                            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b">
                                Area
                            </div>
                            <form action="" method="post">
                            <div class="p-6">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="all" type="submit" value="All">
                                        All
                                </button>    
                                <button class="bg-pink-500 hover:bg-violet-700 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="PIMPINAN">
                                    Pimpinan
                                </button>
                                <button class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="HAKIM PENGAWAS BIDANG">
                                    Hakim Pengawas Bidang
                                </button>
                                <button class="bg-orange-500 hover:bg-orange-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="HAKIM">
                                    Hakim
                                </button>
                                <button class="bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="INTERNAL ASESOR">
                                    Internal Asesor
                                </button>
                                <button class="bg-gray-500 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="SURVEY KEPUASAN MASYARAKAT">
                                    Survey Kepuasan Masyarakat
                                </button>
                                <button class="bg-indigo-500 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="PANMUD HUKUM">
                                    Panmud Hukum
                                </button>
                                <button class="bg-teal-500 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="DOCUMENT CONTROL">
                                    Document Control
                                </button>
                                <button class="bg-purple-500 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="PANMUD PERMOHONAN">
                                    Panmud Permohonan
                                </button>
                                <button class="bg-pink-500 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="PANMUD GUGATAN">
                                    Panmud Gugatan
                                </button>
                                <button class="bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="JURUSITA">
                                    Jurusita
                                </button>
                                <button class="bg-orange-500 hover:bg-orange-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="KEPEGAWAIAN DAN ORGANISASI TATA LAKSANA">
                                    Kepegawaian dan Ortala
                                </button>
                                <button class="bg-gray-500 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="UMUM DAN KEUANGAN">
                                    Umum dan Keuangan
                                </button>
                                <button class="bg-yellow-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="PERENCANAAN, TI DAN PELAPORAN">
                                    Perencanaan TI dan Pelaporan
                                </button>
                                
                            </div>
                            </form>
                        </div>
                        <!--/Solid Buttons-->

                    <!--Grid Form-->

                    <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
                            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                            <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                                TABEL BERKAS
                            </div>
                            <div class="p-3">
                                <table class="">
                                    <thead>
                                      <tr>
                                        <th class="border px-4 py-2" style="width:3%">No.</th>
                                        <th class="border px-4 py-2" style="width:10%">Area</th>
                                        <th class="border px-4 py-2" style="width:50%">Nama Dokumen</th>
                                        <th class="border px-4 py-2" style="width:7%">Kriteria</th>
                                        <th class="border px-4 py-2" style="width:5%">Status</th>
                                        <th class="border px-4 py-2" style="width:5%">ACC</th>
                                        <th class="border px-4 py-2" style="width:20%">Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sudah_belum = "";?>
                                    <?php $i=1;?>
                                    <?php foreach ($dokumen as $dok):?>
                                        <tr>
                                            <td class="border px-4 py-2" style="width:3%"><?php echo $dok["nomor"]; ?></td>
                                            <td class="border px-4 py-2" style="width:10%"><?php echo $dok ["area"]; ?></td>
                                            <td class="border px-4 py-2" style="width:50%"><?php echo $dok ["dokumen"]; ?></td>
                                            <td class="border px-4 py-2" style="width:7%"><?php echo $dok ["kriteria"]; ?></td>
                                                <?php 
                                                $sudah_belum = sudah_belum($dok["status"]);
                                                ?>
                                            <td class="border px-4 py-2" style="width:5%">
                                            <?php if ($dok["status"] == "Sudah Upload") {?>
                                                <i class="fas fa-check text-green-500 mx-2">
                                            <?php }
                                                else { ?>
                                                <i class="fas fa-times text-red-500 mx-2"></i>
                                                    <?php }?>
                                                </i>
                                            </td>
                                            <td class="border px-4 py-2" style="width:5%">
                                            <?php if ($dok["acc"] == "Sudah ACC") {?>
                                                <i class="fas fa-check text-green-500 mx-2">
                                            <?php }
                                                else { ?>
                                                <i class="fas fa-times text-red-500 mx-2"></i>
                                                    <?php }?>
                                                </i>
                                            </td>
                                            <td class="border px-4 py-2" style="width:20%">
                                            <?php if ($dok["status"] == "Sudah Upload") {?>
                                            <a href="uploads/<?php echo $dok["filename"]; ?>" class="bg-green-300 hover:bg-green-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" download="<?php echo $dok["filename"]; ?>">Download</a>
                                            <a href="view.php?view=<?php echo $dok["filename"]; ?>" target = '_blank' class="bg-pink-300 hover:bg-pink-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" >View</a>
                                            <a href="delete.php?name=<?php echo $dok["filename"]?>" class = "bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Anda Yakin ?');">Hapus</a></td>
                                            <?php }
                                            else { ?><a href="upload.php?id=<?= $dok["id"];?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php $i++?>
                                        <?php endforeach?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/Grid Form-->

                    <!--Footer-->
                    <footer class="bg-grey-darkest text-white p-2">
                        <div class="flex flex-1 mx-auto">&copy; Copyright</div>
                        <div class="">Distributed by:   <a href="https://www.facebook.com/ambogarr/" target=" _blank"> Muhammad Naufal,S.T </a> & <a href="https://www.facebook.com/caketz/" target=" _blank"> Subhan,S.H </a></div>
                    </footer>
                    <!--/footer-->
    </div>
</div>

<?php }?>
<!--==================================================================== END FOR USERS ==========================================================================================================-->

<!--==================================================================== FOR AUDITORS ==========================================================================================================-->
<?php if ($_SESSION['role'] == 'audit') {?>
    
    <!--Container -->
    <div class="mx-auto bg-grey-400">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <header class="bg-nav">
                <div class="flex justify-between">
                    <div class="p-1 mx-3 inline-flex items-center">
                        <div style="width:100px height:100px background-color:blue"></div>
                        <h1 class="text-white p-2">SI-MONA</h1><br>
                        <p class="text-white p-2"> (Sistem Informasi Monitoring APM Pengadilan Agama Larantuka)</p>
                    </div>
                    <div class="p-1 flex flex-row items-center">
    
                        <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="logopa.png" alt="">
                        <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">audit</a>
                        <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                            <ul class="list-reset">
                              
                              <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!--/Header-->
    
    
            <div class="flex flex-1">
                <!--Sidebar-->
                <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
    
                    <ul class="list-reset flex flex-col">
                        <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                            <a href="index.php"
                               class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-tachometer-alt float-left mx-2"></i>
                                Dashboard
                                <span><i class="fas fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-300-border">
                        <a href="logout.php" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fas fa-square-full float-left mx-2"></i>
                            Logout
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                        </li>
                    </ul>
    
                </aside>
                <!--/Sidebar-->
    
                <!--Main-->
                <main class="bg-white-300 flex-1 p-3 overflow-hidden">
    
                    <div class="flex flex-col">
                        <!-- Stats Row Starts Here -->
                        <form action="" method="post" class="head">
                        <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                            <button class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2" name="belum" type="submit" value="Belum Upload">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php counting_belum();?></div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        BELUM UPLOAD
                                    </a>
                                </div>
                            </button>
    
    
                            <button class="shadow bg-info border-l-8 hover:bg-info-dark border-info-dark mb-2 p-2 md:w-1/4 mx-2" name="sudah" type="submit" value="Sudah Upload">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php counting_sudah();?></div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        SUDAH UPLOAD
                                    </a>
                                </div>
                            </button>
    
                            <button class="shadow bg-warning border-l-8 hover:bg-warning-dark border-warning-dark mb-2 p-2 md:w-1/4 mx-2" name="all" type="submit">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php counting_total();?></div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        TOTAL BERKAS
                                    </a>
                                </div>
                            </button>
                            <button class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2" name="all" type="submit">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php prosentase();?> %</div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        PROGRESS
                                    </a>
                                </div>
                            </button>
                            
                            </form>
                        </div>
    
                        <!-- /Stats Row Ends Here -->

                        <!-- Stats ACC Starts Here -->
                        <form action="" method="post" class="head">
                        <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                            <button class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2" name="belumacc" type="submit" value="Belum ACC">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php counting_belum_acc();?></div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        BELUM ACC
                                    </a>
                                </div>
                            </button>
                            <button class="shadow bg-primary border-l-8 hover:bg-primary-dark border-primary-dark mb-2 p-2 md:w-1/4 mx-2" name="sudahacc" type="submit" value="Sudah ACC">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php counting_sudah_acc();?></div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        SUDAH ACC
                                    </a>
                                </div>
                            </button>
                            <button class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2" name="all" type="submit">
                                <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">
                                        <div class="angka"><?php prosentase_acc();?> %</div>
                                    </a>
                                    <a href="#" class="no-underline text-white text-lg">
                                        PROGRESS ACC
                                    </a>
                                </div>
                            </button>
                            
                            </form>
                        </div>
    
                        <!-- /STATS ACC Row Ends Here -->




    
                        <!--Solid Buttons-->
                        <div class="mb-2 mx-2 border-solid border-gray-300 rounded border shadow-sm w-full ">
                                <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b">
                                    Area
                                </div>
                                <form action="" method="post">
                                <div class="p-6">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="all" type="submit" value="All">
                                            All
                                    </button>    
                                    <button class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="PIMPINAN">
                                        Pimpinan
                                    </button>
                                    <button class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="HAKIM PENGAWAS BIDANG">
                                        Hakim Pengawas Bidang
                                    </button>
                                    <button class="bg-orange-500 hover:bg-orange-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="HAKIM">
                                        Hakim
                                    </button>
                                    <button class="bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="INTERNAL ASESOR">
                                        Internal Asesor
                                    </button>
                                    <button class="bg-gray-500 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="SURVEY KEPUASAN MASYARAKAT">
                                        Survey Kepuasan Masyarakat
                                    </button>
                                    <button class="bg-indigo-500 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="PANMUD HUKUM">
                                        Panmud Hukum
                                    </button>
                                    <button class="bg-teal-500 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="DOCUMENT CONTROL">
                                        Document Control
                                    </button>
                                    <button class="bg-purple-500 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="PANMUD PERMOHONAN">
                                        Panmud Permohonan
                                    </button>
                                    <button class="bg-pink-500 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="PANMUD GUGATAN">
                                        Panmud Gugatan
                                    </button>
                                    <button class="bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="JURUSITA">
                                        Jurusita
                                    </button>
                                    <button class="bg-orange-500 hover:bg-orange-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="KEPEGAWAIAN DAN ORGANISASI TATA LAKSANA">
                                        Kepegawaian dan Ortala
                                    </button>
                                    <button class="bg-gray-500 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="UMUM DAN KEUANGAN">
                                        Umum dan Keuangan
                                    </button>
                                    <button class="bg-yellow-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" name="subject" type="submit" value="PERENCANAAN, TI DAN PELAPORAN">
                                        Perencanaan TI dan Pelaporan
                                    </button>
                                    
                                </div>
                                </form>
                            </div>
                            <!--/Solid Buttons-->
    
                        <!--Grid Form-->
    
                        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
                                <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                                <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                                    TABEL BERKAS
                                </div>
                                <div class="p-3">
                                    <table class="">
                                        <thead>
                                          <tr>
                                            <th class="border px-4 py-2" style="width:3%">No.</th>
                                            <th class="border px-4 py-2" style="width:10%">Area</th>
                                            <th class="border px-4 py-2" style="width:50%">Nama Dokumen</th>
                                            <th class="border px-4 py-2" style="width:7%">Kriteria</th>
                                            <th class="border px-4 py-2" style="width:5%">Status</th>
                                            <th class="border px-4 py-2" style="width:5%">ACC</th>
                                            <th class="border px-4 py-2" style="width:20%">Actions</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php $sudah_belum = "";?>
                                        <?php $i=1;?>
                                        <?php foreach ($dokumen as $dok):?>
                                            <tr>
                                                <td class="border px-4 py-2" style="width:3%"><?php echo $dok["nomor"]; ?></td>
                                                <td class="border px-4 py-2" style="width:10%"><?php echo $dok ["area"]; ?></td>
                                                <td class="border px-4 py-2" style="width:50%"><?php echo $dok ["dokumen"]; ?></td>
                                                <td class="border px-4 py-2" style="width:7%"><?php echo $dok ["kriteria"]; ?></td>
                                                    <?php 
                                                    $sudah_belum = sudah_belum($dok["status"]);
                                                    ?>
                                                <td class="border px-4 py-2" style="width:5%">
                                                <?php if ($dok["status"] == "Sudah Upload") {?>
                                                    <i class="fas fa-check text-green-500 mx-2">
                                                <?php }
                                                    else { ?>
                                                    <i class="fas fa-times text-red-500 mx-2"></i>
                                                        <?php }?>
                                                    </i>
                                                </td>
                                                <td class="border px-4 py-2" style="width:5%">
                                                <?php if ($dok["acc"] == "Sudah ACC") {?>
                                                    <i class="fas fa-check text-green-500 mx-2">
                                                <?php }
                                                    else { ?>
                                                    <i class="fas fa-times text-red-500 mx-2"></i>
                                                        <?php }?>
                                                    </i>
                                                </td>
                                                
                                                <td class="border px-4 py-2" style="width:20%">
                                                <?php if ($dok["status"] == "Sudah Upload") {?>
                                                <a href="uploads/<?php echo $dok["filename"]; ?>" class="bg-blue-300 hover:bg-blue-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" download="<?php echo $dok["filename"]; ?>">Download</a>
                                                <a href="view.php?view=<?php echo $dok["filename"]; ?>" target = '_blank' class="bg-pink-300 hover:bg-pink-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" >View</a>
                                                
                                                <?php if ($dok["acc"] == "Sudah ACC") {?>
                                                <a href="cancelacc.php?id=<?php echo $dok["id"]?>" class = "bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Anda Yakin ?');">Batalkan</a></td>
                                                <?php }
                                                else { ?>
                                                <a href="acc.php?id=<?php echo $dok["id"]?>" class = "bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Anda Yakin ?');">ACC</a></td> <?php }?>
                                                <?php }
                                                else { ?><div class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">Belum Upload</div>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                            <?php $i++?>
                                            <?php endforeach?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/Grid Form-->
    
                        <!--Footer-->
                        <footer class="bg-grey-darkest text-white p-2">
                            <div class="flex flex-1 mx-auto">&copy; Copyright</div>
                            <div class="">Distributed by:   <a href="https://www.facebook.com/ambogarr/" target=" _blank"> Muhammad Naufal,S.T </a> & <a href="https://www.facebook.com/caketz/" target=" _blank"> Subhan,S.H </a></div>
                        </footer>
                        <!--/footer-->
        </div>
    </div>
    
    <?php }?>
    <!--==================================================================== END FOR ADUDITOR ==========================================================================================================-->
    

</body>

<?php }else{
	header("Location: index.php");
} ?>