<?php
//koneksi ke database
$conn = mysqli_connect("localhost","um29xl32_simona","batikhmakmal123","um29xl32_filemgr");

// ================================================ FOR USERS ============================================================

function query($query){
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[]= $row;
    }
    return $rows;
}

function upload ($a){
    global $conn;
    $select_area = mysqli_query($conn,"SELECT * FROM apm WHERE id=$a");
    $rows1 = [];
    while ($row = mysqli_fetch_assoc($select_area)){
        $rows1[]= $row;
    }
    $file_num = $rows1[0]["nomor"];
    $file_area = $rows1[0]["area"];
    $file_jenis = $rows1[0]["jenis"];

    if (isset($_POST['submit'])){
        $direktori = "uploads/";
        $file_name = $_FILES['dokumen']['name'];
        $file_type = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
        $new_file_name = $file_num.". ".$file_area." ".$file_jenis.".".$file_type;
        if($file_type != "pdf" && $file_type != "doc" && $file_type != "docx" ) {
            echo "
            <script>
                    alert('Harap Masukkan File pdf,doc atau docx');
                    document.location.href = '';
                </script>
            ";
            }
        else{
            move_uploaded_file ($_FILES['dokumen']['tmp_name'],$direktori.$new_file_name);
            mysqli_query($conn, "UPDATE apm SET filename='$new_file_name' WHERE id=$a" );
            mysqli_query($conn, "UPDATE apm SET status='Sudah Upload' WHERE id=$a" );
            echo "
                <script>
                    alert('Data Berhasil Ditambahkan');
                    document.location.href = 'home.php';
                </script>
            ";
        }

        
    }
    
}

function delete ($filename){
    global $conn;
    mysqli_query($conn, "UPDATE apm SET status='Belum Upload' WHERE filename='$filename'" );
}

function counting_belum (){
    global $conn;
    $belum = mysqli_query($conn,"SELECT status FROM apm WHERE status='Belum Upload'");
    $rows = [];
    while ($row = mysqli_fetch_assoc($belum)){
        $rows[]= $row;
    }
        echo count($rows);

}

function counting_sudah (){
    global $conn;
    $sudah = mysqli_query($conn,"SELECT status FROM apm WHERE status='Sudah Upload'");
    $rows2 = [];
    while ($row2 = mysqli_fetch_assoc($sudah)){
        $rows2[]= $row2;
    }
        echo count($rows2);

}

function counting_total (){
    global $conn;
    $all = mysqli_query($conn,"SELECT status FROM apm");
    $rows2 = [];
    while ($row2 = mysqli_fetch_assoc($all)){
        $rows2[]= $row2;
    }
        echo count($rows2);

}

function prosentase (){
    global $conn;
    $sudah = mysqli_query($conn,"SELECT status FROM apm WHERE status='Sudah Upload'");
    $rows2 = [];
    while ($row2 = mysqli_fetch_assoc($sudah)){
        $rows2[]= $row2;
    }

    $all = mysqli_query($conn,"SELECT status FROM apm");
    $rows3 = [];
    while ($row3 = mysqli_fetch_assoc($all)){
        $rows3[]= $row3;
    }
        $prosentase = count($rows2)/count($rows3)*100;
        echo number_format ($prosentase,2);

}

function sudah_belum ($a){
    global $conn;
    if ($a == "Belum Upload"){
        $b = "Belum_";
    }
    else{
        $b = "Sudah_";
    }

    return $b;

}

function filter ($cari){
    $query = "SELECT * FROM apm WHERE area = '$cari' ORDER BY status DESC, nomor,kriteria ASC";
    return query($query);
}

function dah_lom ($cari){
    $query = "SELECT * FROM apm WHERE status = '$cari' ORDER BY nomor,area,kriteria ASC";
    return query($query);
}


// ================================================ FOR ADMINS ============================================================


function downloadall(){
    $zip = new ZipArchive();
    $filename = "./SEMUABERKASAPM.zip";

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
      exit("cannot open <$filename>\n");
    }

    $dir = 'uploads/';

    // Create zip
    function createZip($zip,$dir){
        if (is_dir($dir)){
      
          if ($dh = opendir($dir)){
             while (($file = readdir($dh)) !== false){
       
               // If file
               if (is_file($dir.$file)) {
                  if($file != '' && $file != '.' && $file != '..'){
       
                     $zip->addFile($dir.$file);
                  }
               }else{
                  // If directory
                  if(is_dir($dir.$file) ){
      
                    if($file != '' && $file != '.' && $file != '..'){
      
                      // Add empty directory
                      $zip->addEmptyDir($dir.$file);
      
                      $folder = $dir.$file.'/';
       
                      // Read data of the folder
                      createZip($zip,$folder);
                    }
                  }
       
               }
       
             }
             closedir($dh);
           }
        }
      }

    
    createZip($zip,$dir);

    $zip->close();

    
      $filename = "SEMUABERKASAPM.zip";

    if (file_exists($filename)) {
         header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
         header('Content-Length: ' . filesize($filename));

         flush();
         readfile($filename);
      // delete file
      unlink($filename);
 
   }
}

function deleteall(){
    global $conn;
    $files = glob('uploads/*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file)) {
            unlink($file); // delete file
            mysqli_query($conn,"UPDATE apm SET status='Belum Upload' WHERE status='Sudah Upload'"); //change value databes

        }
    }
}

function resetall(){
    global $conn;
    mysqli_query($conn,"UPDATE apm SET acc='Belum ACC'"); //change value databes

}


// ================================================ FOR AUDITOR ============================================================

function counting_belum_acc (){
    global $conn;
    $belum = mysqli_query($conn,"SELECT acc FROM apm WHERE acc='Belum ACC' AND status='Sudah Upload'");
    $rows = [];
    while ($row = mysqli_fetch_assoc($belum)){
        $rows[]= $row;
    }
        echo count($rows);

}

function counting_sudah_acc (){
    global $conn;
    $sudah = mysqli_query($conn,"SELECT acc FROM apm WHERE acc='Sudah ACC' AND status='Sudah Upload'");
    $rows2 = [];
    while ($row2 = mysqli_fetch_assoc($sudah)){
        $rows2[]= $row2;
    }
        echo count($rows2);

}

function prosentase_acc (){
    global $conn;
    $sudah = mysqli_query($conn,"SELECT acc FROM apm WHERE acc='Sudah ACC' AND status='Sudah Upload'");
    $rows2 = [];
    while ($row2 = mysqli_fetch_assoc($sudah)){
        $rows2[]= $row2;
    }

    $all = mysqli_query($conn,"SELECT acc FROM apm WHERE status='Sudah Upload'");
    $rows3 = [];
    while ($row3 = mysqli_fetch_assoc($all)){
        $rows3[]= $row3;
    }
    if (count($rows3)==0){
        echo 0;
    }
    else{
        $prosentase = count($rows2)/count($rows3)*100;
        echo number_format ($prosentase,2);
    }
        

}

function dah_lom_acc ($cari){
    $query = "SELECT * FROM apm WHERE acc = '$cari' AND status='Sudah Upload' ORDER BY status DESC, nomor,area,kriteria ";
    return query($query);
}

 


?>
