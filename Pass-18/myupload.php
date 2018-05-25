<?php
/** MyUpload.php
 ** A form Upload class, responsable for handling files upload.
 ** 
 ** The basic steps to upload are:
 **
 ** -> check if the file has been uploaded to your server tmp dir
 ** -> set the directory to upload to
 ** -> check if the type of file is accepted (extension of file only)
 ** -> check the size of the file
 ** -> check if file exists in upload dir (not mandatory)
 ** -> move the file to upload dir
 ** -> rename the uploaded file (not mandatory)
 **
 ** This class has been tested on: (send me an email if you have success
 ** on other server)
 ** - Apache/1.3.22 (rpm patched on 2002-06-30) on Linux Red Hat with PHP 4 >= 4.0.3
 ** 
 ** Modification:
 ** - 2002/07/06 Re-Wrote the class completely (see note below)
 ** - 2002/07/12 Add strtolower to checkExtension() (as submitted by jv63305533@gmx.netNOSPAM)
 **
 ** @author Pierre-Yves Lemaire (pylem_2000@yahoo.ca)
 ** @version 1.0 (August 2001)
 ** @version 2.0 (July 2002) (!not compatible with 1.0)
 ** 
 **
 ** NOTE:
 ** I decide to write the class entirely. It is now based on new function
 ** ONLY AVAILABLE on PHP 4 >= 4.0.3.
 **
 ** TO DO:
 ** - Program a sub class that will handle multiple uploads.
 ** - Test and adapt to other platform.
 ** - Program setter and getter fct for better OO style.
 ** - Analyze the script to improve the security.
 **
 ** DISCLAIMER:
 ** Distributed "as is", fell free to modify any part of this code.
 ** You can use this for any projects you want, commercial or not.
 ** It would be very kind to email me any suggestions you have or bugs you might find :)
 **
 **/

class MyUpload{    

  var $cls_upload_dir = "";         // Directory to upload to.
	var $cls_filename = "";           // Name of the upload file.
	var $cls_tmp_filename = "";       // TMP file Name (tmp name by php).
  var $cls_max_filesize = 33554432; // Max file size.
  var $cls_filesize ="";            // Actual file size.
  var $cls_arr_ext_accepted = array(
      ".doc", ".xls", ".txt", ".pdf", ".gif", ".jpg", ".zip", ".rar", ".7z",".ppt",
      ".html", ".xml", ".tiff", ".jpeg", ".png" );
  var $cls_file_exists = 0;         // Set to 1 to check if file exist before upload.
  var $cls_rename_file = 1;         // Set to 1 to rename file after upload.
  var $cls_file_rename_to = '';     // New name for the file after upload.
  var $cls_verbal = 0;              // Set to 1 to return an a string instead of an error code.

  /** constructor()
   **
   ** @para String File name
   ** @para String Temp file name
   ** @para Int File size
   ** @para String file rename to
  **/
  function MyUpload( $file_name, $tmp_file_name, $file_size, $file_rename_to = '' ){
  
    $this->cls_filename = $file_name;
    $this->cls_tmp_filename = $tmp_file_name;
    $this->cls_filesize = $file_size;
    $this->cls_file_rename_to = $file_rename_to;
  }

  /** isUploadedFile()
   **
   ** Method to wrap php 4.0.3 is_uploaded_file fct
   ** It will return an error code if the file has not been upload to /tmp on the web server
   ** (look with phpinfo() fct where php store tmp uploaded file)
   ** @returns string
  **/
  function isUploadedFile(){
    
    if( is_uploaded_file( $this->cls_tmp_filename ) != true ){
      return "IS_UPLOADED_FILE_FAILURE";
    } else {
      return 1;
    }
  }

  /** setDir()
   **
   ** Method to set the directory we will upload to. 
   ** It will return an error code if the dir is not writable.
   ** @para String name of directory we upload to
   ** @returns string
  **/
  function setDir( $dir ){
    
    if( !is_writable( $dir ) ){
      return "DIRECTORY_FAILURE";
    } else { 
      $this->cls_upload_dir = $dir;
      return 1;
    }
  }

  /** checkExtension()
   **
   ** Method to check if we accept the file extension.
   ** @returns string
  **/
  function checkExtension(){
    
    // Check if the extension is valid

    if( !in_array( strtolower( strrchr( $this->cls_filename, "." )), $this->cls_arr_ext_accepted )){
      return "EXTENSION_FAILURE";
    } else {
      return 1;
    }
  }

  /** checkSize()
   **
   ** Method to check if the file is not to big.
   ** @returns string
  **/
  function checkSize(){

    if( $this->cls_filesize > $this->cls_max_filesize ){
      return "FILE_SIZE_FAILURE";
    } else {
      return 1;
    }
  }

  /** move()
   **
   ** Method to wrap php 4.0.3 fct move_uploaded_file()
   ** @returns string
  **/
  function move(){
    
    if( move_uploaded_file( $this->cls_tmp_filename, $this->cls_upload_dir . $this->cls_filename ) == false ){
      return "MOVE_UPLOADED_FILE_FAILURE";
    } else {
      return 1;
    }

  }

  /** checkFileExists()
   **
   ** Method to check if a file with the same name exists in
   ** destination folder.
   ** @returns string
  **/
  function checkFileExists(){
    
    if( file_exists( $this->cls_upload_dir . $this->cls_filename ) ){
      return "FILE_EXISTS_FAILURE";
    } else {
      return 1;
    }
  }

  /** renameFile()
   **
   ** Method to rename the uploaded file.
   ** If no name was provided with the constructor, we use
   ** a random name.
   ** @returns string
  **/

  function renameFile(){

    // if no new name was provided, we use

    if( $this->cls_file_rename_to == '' ){

      $allchar = "abcdefghijklnmopqrstuvwxyz" ; 
      $this->cls_file_rename_to = "" ; 
      mt_srand (( double) microtime() * 1000000 ); 
      for ( $i = 0; $i<8 ; $i++ ){
        $this->cls_file_rename_to .= substr( $allchar, mt_rand (0,25), 1 ) ; 
      }
    }    
    
    // Remove the extension and put it back on the new file name
		
    $extension = strrchr( $this->cls_filename, "." );
    $this->cls_file_rename_to .= $extension;
    
    if( !rename( $this->cls_upload_dir . $this->cls_filename, $this->cls_upload_dir . $this->cls_file_rename_to )){
      return "RENAME_FAILURE";
    } else {
      return 1;
    }
  }
  
  /** upload()
   **
   ** Method to upload the file.
   ** This is the only method to call outside the class.
   ** @para String name of directory we upload to
   ** @returns void
  **/
  function upload( $dir ){
    
    $ret = $this->isUploadedFile();
    
    if( $ret != 1 ){
      return $this->resultUpload( $ret );
    }

    $ret = $this->setDir( $dir );
    if( $ret != 1 ){
      return $this->resultUpload( $ret );
    }

    $ret = $this->checkExtension();
    if( $ret != 1 ){
      return $this->resultUpload( $ret );
    }

    $ret = $this->checkSize();
    if( $ret != 1 ){
      return $this->resultUpload( $ret );    
    }
    
    // if flag to check if the file exists is set to 1
    
    if( $this->cls_file_exists == 1 ){
      
      $ret = $this->checkFileExists();
      if( $ret != 1 ){
        return $this->resultUpload( $ret );    
      }
    }

    // if we are here, we are ready to move the file to destination

    $ret = $this->move();
    if( $ret != 1 ){
      return $this->resultUpload( $ret );    
    }

    // check if we need to rename the file

    if( $this->cls_rename_file == 1 ){
      $ret = $this->renameFile();
      if( $ret != 1 ){
        return $this->resultUpload( $ret );    
      }
    }
    
    // if we are here, everything worked as planned :)

    return $this->resultUpload( "SUCCESS" );
  
  }

  /** resultUpload()
   **
   ** Method that returns the status of the upload
   ** (You should put cls_verbal to 1 during debugging...)
   ** @para String Status of the upload
   ** @returns mixed (int or string)
  **/
  function resultUpload( $flag ){

    switch( $flag ){
      case "IS_UPLOADED_FILE_FAILURE" : if( $this->cls_verbal == 0 ) return -1; else return "The file could not be uploaded to the tmp directory of the web server.";
        break;
      case "DIRECTORY_FAILURE"        : if( $this->cls_verbal == 0 ) return -2; else return "The file could not be uploaded, the directory is not writable.";
        break;
      case "EXTENSION_FAILURE"        : if( $this->cls_verbal == 0 ) return -3; else return "The file could not be uploaded, this type of file is not accepted.";
        break;
      case "FILE_SIZE_FAILURE"        : if( $this->cls_verbal == 0 ) return -4; else return "The file could not be uploaded, this file is too big.";
        break;
      case "FILE_EXISTS_FAILURE"      : if( $this->cls_verbal == 0 ) return -5; else return "The file could not be uploaded, a file with the same name already exists.";
        break;
      case "MOVE_UPLOADED_FILE_FAILURE" : if( $this->cls_verbal == 0 ) return -6; else return "The file could not be uploaded, the file could not be copied to destination directory.";
        break;
      case "RENAME_FAILURE"           : if( $this->cls_verbal == 0 ) return 2; else return "The file was uploaded but could not be renamed.";
        break;
      case "SUCCESS"                  : if( $this->cls_verbal == 0 ) return 1; else return "Upload was successful!";
        break;
      default : echo "OUPS!! We do not know what happen, you should fire the programmer ;)";
        break;
    }
  }

}; // end class

// exemple
/*

if( $_POST['submit'] != '' ){

  $u = new MyUpload( $_FILES['image']['name'], $_FILES['image']['tmp_name'], $_FILES['image']['size'], "thisname" );
  $result = $u->upload( "../image/upload/" );
  print $result;

}

print "<br><br>\n";
print "<form enctype='multipart/form-data' method='post' action='". $PHP_SELF ."'>\n";
print "<input type='hidden' name='MAX_FILE_SIZE' value='200000'>\n";
print "<input type='file' name='image'>\n";
print "<input type='submit' value='Upload' name='submit'>\n";
print "</form>\n";
*/
?>