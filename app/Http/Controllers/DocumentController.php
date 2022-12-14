<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    public function index() {
       
        return view('documents.index');
    }

	public function uploadFile(Request $request){
		
		$target_dir = $request->path . "/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		if(isset($_POST["submit"])) {
			// Check if file already exists
			if (file_exists($target_file)) {				
				$uploadOk = 0;
				return redirect()->route('document.index')->with(['status' => 'File already exists.', 'statusCode' => 1 ]);				
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 50000000) {				
				$uploadOk = 0;
				return redirect()->route('document.index')->with(['status' => 'File is too large.', 'statusCode' => 1 ]);
			}

			if ($uploadOk == 0) {
				return redirect()->route('document.index')->with(['status' => 'Unable to upload file.', 'statusCode' => 1 ]);
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					return redirect()->route('document.index')->with(['status' => 'File uploaded.', 'statusCode' => 0 ]);
				} else {
					return redirect()->route('document.index')->with(['status' => 'Unable to upload file.', 'statusCode' => 1 ]);
				}
			}

		}

		return redirect()->route('document.index')->with(['status' => 'Unable to upload file.', 'statusCode' => 1 ]);

	}

	public function deleteFile(Request $request){
		unlink($request->file);
		
		return redirect()->route('document.index')->with(['status' => 'File Deleted.', 'statusCode' => 0 ]);

	}

	public function createFolder(Request $request){

		$target_dir = $request->folderPath . "/";
		$target_file = $target_dir . $request->folderToCreate;
		$uploadOk = 1;
		
		if(isset($_POST["submit"])) {
			// Check if file already exists
			if (file_exists($target_file)) {				
				$uploadOk = 0;
				return redirect()->route('document.index')->with(['status' => 'Folder already exists.', 'statusCode' => 1 ]);				
			}

			if ($uploadOk == 0) {
				return redirect()->route('document.index')->with(['status' => 'Unable to create folder.', 'statusCode' => 1 ]);
			// if everything is ok, try to upload file
			} else {
				if (mkdir($target_file)) {
					return redirect()->route('document.index')->with(['status' => 'Folder Created.', 'statusCode' => 0 ]);
				} else {
					return redirect()->route('document.index')->with(['status' => 'Unable to create folder.', 'statusCode' => 1 ]);
				}
			}

		}

		return redirect()->route('document.index')->with(['status' => 'Unable to create folder.', 'statusCode' => 1 ]);		

	}

	public function deleteFolder(Request $request){
		$dir = $request->folder;

		$isDirEmpty = !(new \FilesystemIterator($dir))->valid();

		if ($isDirEmpty){
			rmdir ($dir);
			return redirect()->route('document.index')->with(['status' => 'Folder Deleted.', 'statusCode' => 0 ]);
		} else {
			return redirect()->route('document.index')->with(['status' => 'Folder is not Empty.', 'statusCode' => 1 ]);
		}
			
		
		

	}

    public function scan($dir) {

        $files = array();

        $files[] = array(
            "name" => 'files',
            "type" => "folder",
            "path" => $dir,
            "items" => self::recursiveScan($dir) 
        );

        return Response::json($files);
        
    }

    public function recursiveScan($dir) {
        
        $files = array();
        
		// Is there actually such a folder/file?
	
		if(file_exists($dir)){
            
			foreach(scandir($dir) as $f) {

				if(!$f || $f[0] == '.') {
					continue; // Ignore hidden files
				}

				if(is_dir($dir . '/' . $f)) {                       
					// The path is a folder
                    
					$files[] = array(
						"name" => $f,
						"type" => "folder",
						"path" => $dir . '/' . $f,
						"items" => self::recursiveScan($dir . '/' . $f) 
                    );
				}
				
				else {
                    
					// It is a file
	
					$files[] = array(
						"name" => $f,
						"type" => "file",
						"path" => $dir . '/' . $f,
						"size" => filesize($dir . '/' . $f) // Gets the size of this file
					);
				}
            }		
        }   

        return $files;
        
    }

    
}
