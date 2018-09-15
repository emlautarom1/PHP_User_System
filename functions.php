<?php 
    function echoUserList() {
        $data = readUserData();
        // Print user array as td
        if (!empty($data)) {
            // If $data is not empty, display table
            print('
            <table class="usertable">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Genero</th>
                    <th>E-mail</th>
                    <th>Direcci&oacute;n</th>
                    <th>Nickname</th>
                    <th>Tel&eacute;fono</th>
                </tr>');
            foreach ($data as $ln => $user) {
                print("<tr>");
                foreach ($user as $key => $value) {
                    print("<td>$value</td>");
                }
                print("</tr>");
            };
            print('</table>');
        } else {
            // Else, display error.
            print("
            <h1>¡Ha ocurrido un error!</h1>
            <h2>No hay usuarios que mostrar.</h2>
            ");
        }
    }

    // Sort function: Surname
    function sort_surname($a, $b) {
        return strnatcmp($a['surname'], $b['surname']);
    }

    function readUserData() {
        // Load user data f.
        $arch = array();
        $f = fopen("usuarios.txt", "r");
        if ($f) {
            while (($line = fgets($f)) !== false) {
                array_push($arch, $line);
            }
            fclose($f);
        } else {
            print("
            <h1>Ha ocurrido un error!</h1>
            <h2>No se ha podido leer el archivo de usuarios</h2>
            ");
            return null;
        }
        // Generate data array with users
        $data = array();
        $user = array();
        foreach ($arch as $lineNum => $content) {
            $temp = explode(",",$content);
            $user['name'] = $temp[0];
            $user['surname'] = $temp[1];
            $user['gender'] = $temp[2];
            $user['email'] = $temp[3];
            $user['address'] = $temp[4];
            $user['nickname'] = $temp[5];
            $user['tel'] = $temp[6];
            array_push($data, $user);
        }
        unset($user);
    
        //Sort user array
        uasort($data, 'sort_surname');
    
        return $data;
    }

    function echoUserDelete() {

        $data = readUserData();

        // Print user array as td
        if (!empty($data)) {
            // If $data is not empty, display delete table form
            print("<form method=\"post\" action=\"borrar.php\">");
            print('
            <table class="usertable">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Genero</th>
                    <th>E-mail</th>
                    <th>Direcci&oacute;n</th>
                    <th>Nickname</th>
                    <th>Tel&eacute;fono</th>
                    <th>Eliminar</th>
                </tr>');
            foreach ($data as $ln => $user) {
                print("<tr>");
                foreach ($user as $key => $value) {
                    print("<td>$value</td>");
                }
                // Prints checkbox to delete
                print("<td><input type=\"checkbox\" name=\"delete[]\" value=\"$ln\"></td>");
                print("</tr>");
            };
            print('
            </table>
            <button type="submit">Eliminar Usuarios</button>
            </form>');
        } else {
            // Else, display error.
            print("
            <h1>¡Ha ocurrido un error!</h1>
            <h2>No hay usuarios que mostrar.</h2>
            ");
        }
    }

    function getToDeleteArray() {
        $toDelete = array();
        if(!empty($_POST['delete'])) {
            foreach($_POST['delete'] as $selected){
                array_push($toDelete, $selected);
            }
            return $toDelete;
        } else {
            return null;
        }
    }

    function deleteUsers($toDelete) {
        $data = readUserData();

        // Removes all marked users
        foreach ($toDelete as $key => $lineNum) {
            unset($data[$lineNum]);
        }

        // Rewrites all users
        rewriteUsers($data);
    }

    function rewriteUsers($data) {
        // Deletes old file
        unlink("usuarios.txt");

        $arch = fopen("usuarios.txt", "a+");
        if ($arch) {
            // For each user in Data
            foreach ($data as $key => $user) {
                // Print user data in File
                $printLine = "";
                foreach ($user as $key => $value) {
                    $printLine = $printLine.$value.",";
                };
                // No use of PHP_EOL. Already in atribute
                $printLine = substr_replace($printLine ,"", -1);
                // Writes line to File
                fwrite($arch, $printLine);
            }
            // Close File.
            fclose($arch);
        } else {
        // Failed to rewrite.
        }
    }

    function clrInput($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }
    
    function getPostUser() {
        $userToAdd = array(
            "name" => $_POST['name'],
            "surname" => $_POST['surname'],
            "gender" => $_POST['gender'],
            "email" => $_POST['email'],
            "address" => $_POST['address'],
            "nickname" => $_POST['nickname'],
            "tel" => $_POST['tel']
        );
        return $userToAdd;
    }
    
    function emptyUser() {
        return array(
            "name" => "",
            "surname" => "",
            "gender" => "",
            "email" => "",
            "address" => "",
            "nickname" => "",
            "tel" => ""
        );
    }
        
    function emptyErrors() {
        return emptyUser();
    }

    function noErrorCheck($errorList) {
        return ($errorList['name']=="" && 
                $errorList['surname']=="" &&
                $errorList['gender']=="" &&
                $errorList['email']=="" &&
                $errorList['address']=="" &&
                $errorList['nickname']=="" &&
                $errorList['tel']=="");
    }
        
    function validateUser($user) {

        $errorList = emptyErrors();

        // Validate Name
        if (empty($user['name'])) {
        $errorList['name'] = "El nombre no puede ser vacío";
        } 
        else {
        // Check for ilegal chars
            if (!preg_match("/^[a-zA-Z]*$/", clrInput($user['name']))) {
            $errorList['name'] = "El nombre contiene caracteres inválidos"; 
            }
        }
        
        // Validate Surname
        if (empty($user['surname'])) {
        $errorList['surname'] = "El apellido no puede ser vacío";
        }
        else {
        // Check for ilegal chars
            if (!preg_match("/^[a-zA-Z]*$/", clrInput($user['surname']))) {
            $errorList['surname'] = "El apellido contiene caracteres inválidos"; 
            }
        }

        // Validate Gender
        if (empty($user['gender'])) {
            $errorList['gender'] = "El sexo no puede ser vacío";
            }
        
        // Validate Email
        if (empty($user['email'])) {
        $errorList['email'] = "El email no puede ser vacío";
        }
        else {
        // Check for email format
            if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errorList['email'] = "Formato de email inválido"; 
            }
        }
        
        // Validate Address
        if (empty($user['address'])) {
        $errorList['address'] = "La dirección no puede ser vacía";
        }
        else {
        // Check for address format
            if(!preg_match('/^[\w\s]+$/', clrInput($user['address']))){
                $errorList['address'] = "Formato de dirección inválido";
            }
        }
        
        // Validate Nickname
        if (empty($user['nickname'])) {
        $errorList['nickname'] = "El nickname no puede ser vacío";
        }
        else {
        // Check for Nickname format
            if(preg_match('/[^a-zA-Z0-9_-]/', $user['nickname'])){
                $errorList['nickname'] = "Formato de nickname inválido";
            }
        }
        
        // Validate Telephone
        if (empty($user['tel'])) {
        $errorList['tel'] = "El teléfono no puede ser vacío";
        }
        else {
        // Check for invalid chars
            if(!preg_match('/^[0-9\-\(\)\/\+\s]*$/', $user['tel'])){
            $errorList['tel'] = "Formato de teléfono inválido";
            }
        }

        return $errorList;
    }
    
    function addUser($user) {
        $arch = fopen('usuarios.txt','a+');
        // If File is open
        if ($arch) {
        $printLine = "";
            foreach ($user as $key => $value) {
            $printLine = $printLine.$value.",";
            };
            // Replace last ',' with EOL
            $printLine = substr_replace($printLine ,PHP_EOL, -1);
            // Writes line to File
            fwrite($arch, $printLine);
            // Close File.
            fclose($arch);
        } else {
        // Failed to open file.
        }
    }
?>